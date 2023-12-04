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
            $this->emitTo('variable-type.variable-type-modal','edit',$file->id);
            $this->resetInputDefaults();
        }else{
            $this->emit('fileAlert', 'terminado!','Archivo editado exitosamente');
            $this->resetInputDefaults();
            $this->emitTo('file.file-controller', 'render');
        }
    }

    private function addVariables($filaVariable, $file)
    {
        $variables = [];
        foreach ($filaVariable->getCellIterator() as $celdaCabecera) {
            $value = $celdaCabecera->getValue();
            if ($value !== null) {
                $variables[] = Variable::create([
                    'name' => $value,
                    'file_id' => $file->id,
                ]);
            }
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
                if ($variables[$i]) { // Verifica si la variable no es nula
                    $datos[$variables[$i]->id] = $cell->getValue();
                }
                $i++;
            }
            if (count($datos) > 0) { // Verifica que al menos una variable tenga un valor no nulo
                $registro = new Register();
                $registro->file_id = $file->id;
                $registro->save();
                $registers[] = $registro;
            }
        }
        return $registers;
    }
    
    private function addData($sheet, $variables, $registers)
    {
        $registersTotal = 0;
        foreach ($sheet->getRowIterator(2) as $column) {
            $countColumn = 0;
            foreach ($column->getCellIterator() as $cell) {
                if ($variables[$countColumn]) { // Verifica si la variable no es nula
                    Data::create([
                        'value' => $cell->getValue(),
                        'variable_id' => $variables[$countColumn]->id,
                        'register_id' => $registers[$registersTotal]->id,
                    ]);
                }
                $countColumn++;
            }
            $registersTotal++;
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
