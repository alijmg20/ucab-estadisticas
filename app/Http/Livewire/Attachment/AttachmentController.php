<?php

namespace App\Http\Livewire\Attachment;

use App\Helpers\Tools;
use App\Models\Attachment;
use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class AttachmentController extends Component
{

    use WithPagination;
    public $searchAttachment = '';
    public $sortAttachment = 'id';
    public $directionAttachment = 'desc';
    public $entrysAttachment = [2,5,10,20,50,100], $cantAttachment = '10';
    public $readyToLoad = false;

    public $project; // Proyecto que contiene el id para el adjunto

    protected $listeners = ['render','delete'];

    protected $attachments = [];

    protected $queryString = [
        'cantAttachment' => ['except' => '10'], 
        'sortAttachment'  => ['except' => 'id'],
        'directionAttachment'  => ['except' => 'desc'],
        'searchAttachment' => ['except' => '']
    ];

    public function loadAttachment(){
        $this->readyToLoad = true;
    }

    public function updatingCantAttachment(){
        $this->resetPage('AttachmentsPage');
    }

    public function updatingSearchAttachment()
    {
        $this->resetPage('AttachmentsPage');
    }

    public function mount($project){
        $this->project = Project::find($project);
    }
    public function render()
    {
        if($this->readyToLoad){
            $attachments = Attachment::where('project_id', $this->project->id)
            ->where(function ($query) {
                $query->Where('id', 'like', '%' . $this->searchAttachment . '%')
                    ->orWhere('name', 'like', '%' . $this->searchAttachment . '%')
                    ->orWhere('ext', 'like', '%' . $this->searchAttachment . '%')
                    ->orWhere('created_at', 'like', '%' . $this->searchAttachment . '%');
            })
            ->orderBy($this->sortAttachment, $this->directionAttachment)
            ->paginate($this->cantAttachment, ['*'], 'AttachmentsPage');
        }else{
            $attachments = [];
        }
        $this->attachments = $attachments;
        return view('livewire.attachment.attachment-controller',compact('attachments'));
    }

    public function order($sort)
    {
        if ($this->sortAttachment == $sort) {
            if ($this->directionAttachment == 'desc') {
                $this->directionAttachment = 'asc';
            } else {
                $this->directionAttachment = 'desc';
            }
        } else {
            $this->sortAttachment = $sort;
            $this->directionAttachment = 'asc';
        }
    }

    public function delete($id){
        $attachment = Attachment::find($id);
        Tools::DeleteStorageUrl($attachment->url); 
        $attachment->delete();
    }

}
