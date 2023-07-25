<?php

namespace App\Http\Livewire\Attachment;

use App\Models\Attachment;
use App\Models\Project;
use Livewire\Component;
use Livewire\WithFileUploads;
class AttachmentModal extends Component
{
    use WithFileUploads;
    
    public $open = false;
    public $name, $file_attachment,$ext,$status = 0,$project;

    public $attachment; //Variable para editar

    protected $listeners = ['edit'];

    protected $rules = [
        'name' => 'required',
        'file_attachment' => 'required',
        'status' => 'required',
        'ext' => '',
        'project' =>'',
    ];

    public function mount($project){
        $this->project = Project::find($project);
    }

    public function render()
    {
        return view('livewire.attachment.attachment-modal');
    }

    public function edit($id)
    {
        $this->reset(['name', 'file_attachment','status', 'ext','attachment']);
        $this->attachment = Attachment::find($id);
        $this->name = $this->attachment->name;
        $this->status =  $this->attachment->status == 2 ? 1 : 0;
        $this->ext = $this->attachment->ext;
        $this->open = true;
    }

    public function openModal()
    {
        $this->reset(['name', 'file_attachment','status', 'ext','attachment']);
        $this->open = true;
    }

    public function closeModal()
    {
        $this->resetInputDefaults();
    }

    public function resetInputDefaults()
    {
        $this->reset(['open', 'name', 'file_attachment','status', 'ext','attachment']);
    }

    public function save(){
        $this->validate(
            $this->attachment && $this->attachment->url ? 
                [
                    'name' => 'required',
                    'file_attachment' => '',
                    'status' => 'required',
                    'ext' => '',
                    'project' =>'',
                ] : $this->rules
        );
        if ($this->attachment && $this->attachment->url) {
            $file_attachment = $this->attachment->url;
            $ext = $this->attachment->ext;
        } else {
            $file_attachment = $this->file_attachment->store('attachments');
            $ext = pathinfo($file_attachment,PATHINFO_EXTENSION);
        }

        $attachment = Attachment::updateOrCreate([
            'id' => $this->attachment ? $this->attachment->id : '',
        ], [
            'name' => $this->name,
            'status' => $this->status ? '2' : '1',
            'url' => $file_attachment,
            'ext' => $ext,
            'project_id' => $this->project->id,
        ]);
        $this->emit('attachmentAlert', 'terminado!', $this->attachment ? 'Archivo adjunto editado exitosamente' : 'Archivo adjunto creado exitosamente');
        $this->resetInputDefaults();
        $this->emitTo('attachment.attachment-controller', 'render');
    }

}
