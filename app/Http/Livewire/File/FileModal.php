<?php

namespace App\Http\Livewire\File;

use App\Helpers\Tools;
use App\Models\Data;
use App\Models\File;
use App\Models\Frequency;
use App\Models\Register;
use App\Models\Variable;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use PhpOffice\PhpSpreadsheet\IOFactory;

class FileModal extends Component
{
    use WithFileUploads;
    public $open = false;

    public $project; //Variable del proyecto
    public $status = false, $name, $file_data;
    public $file; //Variable para edicion

    protected $variables = [];

    protected $listeners = ['edit'];

    protected $rules = [
        'name' => 'required',
        'file_data' => 'required',
        'status' => 'required',
    ];

    public function mount($project)
    {
        $this->project = $project;
    }

    public function render()
    {
        return view('livewire.file.file-modal');
    }

    public function spinner()
    {
        $this->emit('spinnerOn');
    }

    public function save()
    {
        $this->validate(
            $this->file && $this->file->url ?
                [
                    'name' => 'required',
                    'file_data' => '',
                    'status' => 'required',
                ] : $this->rules
        );
        set_time_limit(500);
        if ($this->file && $this->file->url) {
            $file_data = $this->file->url;
        } else {
            $file_data = $this->file_data->store('files');
        }

        $file = $this->project->files()->updateOrCreate([
            'id' => $this->file ? $this->file->id : '',
        ], [
            'name' => $this->name,
            'status' => $this->status ? '2' : '1',
            'url' => $file_data,
        ]);

        if (!$this->file) {

            $path = storage_path('app/public/' . $file_data);
            $sheet = IOFactory::load($path)->getActiveSheet();
            $filaVariable = $sheet->getRowIterator(1)->current();

            $variables = $this->addVariables($filaVariable, $file);
            $registers = $this->addRegisters($sheet, $file, $variables);
            $this->addData($sheet, $variables, $registers);
            $this->addFrequencies($variables);
        }
        $this->emit('fileAlert', 'terminado!', $this->file ? 'Archivo editado exitosamente' : 'Archivo creado exitosamente');
        $this->resetInputDefaults();
        $this->emitTo('file.file-controller', 'render');
    }

    private function addVariables($filaVariable, $file)
    {
        $variables = [];
        foreach ($filaVariable->getCellIterator() as $celdaCabecera) {
            $variables[] = Variable::create([
                'name' => $celdaCabecera->getValue(),
                'project_id' => $this->project->id,
                'file_id' => $file->id,
            ]);
        }
        return $variables;
    }

    private function addRegisters($sheet, $file, $variables)
    {
        $registers = [];
        foreach ($sheet->getRowIterator(2) as $row) {
            $datos = [];
            $i = 0;
            foreach ($row->getCellIterator() as $cell) {
                $datos[$variables[$i]->id] = $cell->getValue();
                $i++;
            }
            $registro = new Register();
            $registro->datos = $datos;
            $registro->project_id = $this->project->id;
            $registro->file_id = $file->id;
            $registro->save();
            $registers[] = $registro;
        }
        return $registers;
    }

    private function addData($sheet, $variables, $registers)
    {
        $registersTotal = 0;
        foreach ($sheet->getRowIterator(2) as $column) {
            $countColumn = 0;
            foreach ($column->getCellIterator() as $cell) {
                Data::create([
                    'value' => $cell->getValue(),
                    'variable_id' => $variables[$countColumn]->id,
                    'register_id' => $registers[$registersTotal]->id,
                ]);
                $countColumn++;
            }
            $registersTotal++;
        }
    }

    private function addFrequencies($variables)
    {
        foreach ($variables as $variable) {
            $variable_get = Data::select('value', DB::raw('count(*) as y'))
                ->where('variable_id', $variable->id)
                ->groupBy('value')
                ->havingRaw('COUNT(*) IS NOT NULL AND value IS NOT NULL')
                ->orderBy('value', 'asc')
                ->get();
            if (count($variable_get) < 15 /*15 corresponde a un numero maximo para mostrar en el grafico*/) {
                $i = 0;
                foreach ($variable_get as $group) {
                    Frequency::create([
                        'name'  => $group->value,
                        'value' => $group->y,
                        'position' => $i+1,
                        'variable_id' => $variable->id,
                    ]);
                    $i++;
                }
            }
        }
    }

    public function edit($id)
    {
        $this->reset(['name', 'file_data', 'status', 'file']);
        $this->file = File::find($id);
        $this->name = $this->file->name;
        $this->status = $this->file->status  == 2 ? true : false;
        $this->open = true;
    }

    public function openModal()
    {
        $this->reset(['name', 'file_data', 'status', 'file']);
        $this->open = true;
    }
    public function closeModal()
    {
        $this->resetInputDefaults();
    }

    public function resetInputDefaults()
    {
        $this->reset(['open', 'name', 'file_data', 'status', 'file']);
    }
}
