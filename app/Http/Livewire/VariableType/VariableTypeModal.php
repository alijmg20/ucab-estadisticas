<?php

namespace App\Http\Livewire\VariableType;

use App\Models\Data;
use App\Models\File;
use App\Models\Frequency;
use App\Models\Sensibility;
use App\Models\Variable;
use App\Models\VariableOption;
use App\Models\VariableResponse;
use App\Models\Variabletype;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use voku\helper\StopWords;
use Illuminate\Support\Str;
use Sentiment\Analyzer;

class VariableTypeModal extends Component
{
    use WithPagination;
    public $file;
    protected $variables;
    public $openVariableTypeModal = false;

    public $searchVariableType = '';
    public $sortVariableType = 'id';
    public $directionVariableType = 'asc';
    public $entrysVariableType = [2, 5, 10, 20, 50, 100], $cantVariableType = '10';
    public $TypesVariable;
    public $variablesTypeCollect = [];
    public $readyToLoad = false;

    protected  $listeners = ['edit'];

    protected $queryString = [
        'cantVariableType' => ['except' => '10'],
        'sortVariableType'  => ['except' => 'id'],
        'directionVariableType'  => ['except' => 'asc'],
        'searchVariableType' => ['except' => '']
    ];

    protected $rules = [
        'variablesTypeCollect' => 'required|filled|array',
        'variablesTypeCollect.*' => 'required',
    ];


    public function updatingCantVariableType()
    {
        $this->resetPage('variablesTypePage');
    }

    public function updatingSearchVariableType()
    {
        $this->resetPage('variablesTypePage');
    }


    public function render()
    {
        $variables = [];
        $this->TypesVariable = Variabletype::all();
        if ($this->file) {
            $variables = Variable::where('file_id', $this->file->id)
                ->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->searchVariableType . '%')
                        ->orWhere('id', 'like', '%' . $this->searchVariableType . '%');
                })
                ->orderBy($this->sortVariableType, $this->directionVariableType)
                ->paginate($this->cantVariableType, ['*'], 'variablesTypePage');
        } else {
            $variables = [];
        }
        $this->variables = $variables;
        return view('livewire.variable-type.variable-type-modal', compact('variables'));
    }

    public function edit($file)
    {
        $this->file = File::find($file);
        $this->readyToLoad = true;
        $this->openVariableTypeModal = true;
    }


    public function order($sort)
    {
        if ($this->sortVariableType == $sort) {
            if ($this->directionVariableType == 'desc') {
                $this->directionVariableType = 'asc';
            } else {
                $this->directionVariableType = 'desc';
            }
        } else {
            $this->sortVariableType = $sort;
            $this->directionVariableType = 'asc';
        }
    }

    public function save()
    {
        $this->validate();
        $vars = Variable::where('file_id', $this->file->id)->get();
        if (empty($this->variablesTypeCollect) || count($this->variablesTypeCollect) < $vars->count()) {
            $this->addError('VariablesEmpty', 'Faltan variables por seleccionar su tipo, verifica todas las páginas');
        } else {
            foreach ($this->variablesTypeCollect as $key => $value) {
                $variableTemp = Variable::find($key);
                $variableTemp->variabletype_id = $value;
                $variableTemp->save();
                switch ($variableTemp->variabletype_id) {
                    case 1:
                        $this->addWords($variableTemp);
                        $this->getAnalizeComplete($variableTemp);
                        break;
                    case 2:
                        $this->addFrequencies($variableTemp);
                        break;
                    case 3:
                        $this->addCheckbox($variableTemp);
                        break;
                }
            }
            $this->reset(['variablesTypeCollect', 'openVariableTypeModal']);
            $this->emitTo('file.file-controller', 'render', 'file');
            $this->emit('fileAlert', 'terminado!', 'Archivo creado exitosamente');
        }
    }

    /**
     * Añade las frecuencias individuales a la variable a analizar
     * En este caso aplica para las preguntas de los tipos
     * Tipo: Opción multiple
     */

    private function addFrequencies($variable)
    {
        $variable_get = Data::select('value', DB::raw('count(*) as y'))
            ->where('variable_id', $variable->id)
            ->groupBy('value')
            ->havingRaw('COUNT(*) IS NOT NULL AND value IS NOT NULL')
            ->orderBy('value', 'asc')
            ->get();
        // if (count($variable_get) < 15 /*15 corresponde a un numero maximo para mostrar en el grafico*/) {
        $i = 0;
        foreach ($variable_get as $group) {
            Frequency::create([
                'name'  => $group->value,
                'value' => $group->y,
                'position' => $i + 1,
                'variable_id' => $variable->id,
            ]);
            $i++;
        }
        // }
    }

    /**
     * Añade las palabras individuales a las variables del tipo texto
     * Tipo: Texto
     */


    private function addWords($variable)
    {
        $data = $variable->data;
        $this->clearData($data, $variable);
    }

    private function clearData($data, $variable)
    {
        $frequencies = [];

        foreach ($data as $datum) {
            // Quitar signos de puntuación y convertir a minúsculas
            $cleanedText = Str::lower(preg_replace('/[^\p{L}\p{N}\s]/u', '', $datum->value));

            // Dividir en palabras
            $words = str_word_count($cleanedText, 1);

            // Filtrar palabras de relleno
            $stopWords = new StopWords();
            $filteredWords = array_diff($words, $stopWords->getStopWordsFromLanguage('es'));

            // Realizar el conteo de palabras
            $wordCounts = array_count_values($filteredWords);

            // Acumular conteos en $frequencies
            foreach ($wordCounts as $word => $count) {
                if (isset($frequencies[$word])) {
                    $frequencies[$word]['count'] += $count;
                } else {
                    $frequencies[$word] = ['count' => $count, 'name' => $word];
                }
            }
        }

        // Ordenar por conteo descendente
        usort($frequencies, function ($a, $b) {
            return $b['count'] - $a['count'];
        });
        $frequent = [];
        foreach ($frequencies as $frequency) {
            // Verificar si el conteo es mayor a 6 antes de agregarlo a $frequent
            if ($frequency['count'] > 6) {
                $frequent[] = Frequency::create([
                    'name'  => $frequency['name'],
                    'value' => $frequency['count'],
                    'position' => count($frequent) + 1,
                    'variable_id' => $variable->id,
                ]);
            }
        }
    }

    /**
     * Obtiene el analisis de sentimientos desde el use Sentiment\Analyzer;
     * importacion de internet
     * Tipo: Texto
     */

    private function getAnalizeComplete($variable)
    {
        $data = $variable->data;
        $sensibility = [];
        $sensibility['positive'] = 0;
        $sensibility['negative'] = 0;
        $sensibility['neutral'] = 0;
        foreach ($data as $dat) {
            $sensibilityScore = $this->getAnalizeOne($dat->value);
            switch ($sensibilityScore['label']) {
                case "neg":
                    $sensibility['negative'] = $sensibility['negative'] + 1;
                    break;
                case "pos":
                    $sensibility['positive'] = $sensibility['positive'] + 1;
                    break;
                case "neu":
                    $sensibility['neutral'] = $sensibility['neutral'] + 1;
                    break;
            }
        }
        $sensibilityObject = Sensibility::create([
            'positive' => $sensibility['positive'],
            'negative' => $sensibility['negative'],
            'neutral' => $sensibility['neutral'],
            'count' => $variable->data->count(),
            'variable_id' => $variable->id,
        ]);
        return $sensibilityObject;
    }

    private function getAnalizeOne($data)
    {
        $analyzer = new Analyzer();
        $output_text = $analyzer->getSentiment($data);
        $state        = '';
        if ($output_text['neg'] > $output_text['pos'] && $output_text['neg'] > $output_text['neu']) {
            $state = ['label' => 'neg', $output_text];
        } elseif ($output_text['pos'] > $output_text['neg'] && $output_text['pos'] > $output_text['neu']) {
            $state = ['label' => 'pos', $output_text];
        } else {
            $state = ['label' => 'neu', $output_text];
        }
        return $state;
    }

    /**
     * Añade las variables del tipo texto
     * 
     */
    public function addCheckbox($variable)
    {
        $data = $variable->data;
        $options = [];

        foreach ($data as $datum) {
            $values = explode(',', $datum->value);

            foreach ($values as $value) {
                $cleanedValue = trim($value);  // Elimina espacios en blanco al principio y al final

                if ($cleanedValue !== '') {
                    if (array_key_exists($cleanedValue, $options)) {
                        $options[$cleanedValue]++;
                    } else {
                        $options[$cleanedValue] = 1;
                    }
                }
            }
        }

        $variableOptions = [];
        foreach ($options as $key => $value) {
            $variableOptions[] = [
                'name' => $key,
                'variable_id' => $variable->id,
                // Otros campos que desees establecer aquí
            ];
        }
        VariableOption::insert($variableOptions);


        $data = $variable->data;
        $options = $variable->options;
        $checkboxResponses = [];
        foreach ($data as $datum) {
            $values = explode(',', $datum->value);
            foreach ($values as $value) {
                foreach ($options as $option) {
                    if($option->name == $value){
                        $checkboxResponses[] = [
                            'variable_id' => $variable->id,
                            'register_id' => $datum->register_id,
                            'variable_option_id' => $option->id,
                            // Otros campos que desees establecer aquí
                        ];
                    }
                }
            }

        }
        VariableResponse::insert($checkboxResponses);



        // dd($options);
    }
}
