<?php

namespace App\Http\Livewire\Emails;

use App\Models\Email;
use Livewire\Component;
use Livewire\WithPagination;

class EmailController extends Component
{
    use WithPagination;

    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    

    public $entrys = [5, 10, 20, 50, 100], $cant = '10';
    public $readyToLoad = false;

    protected $emails = [];
    protected $listeners = ['render','delete'];

    protected $queryString = [
        'cant' => ['except' => '5'],
        'sort'  => ['except' => 'id'],
        'direction'  => ['except' => 'desc'],
        'search' => ['except' => '']
    ];

    public function loadEmails()
    {
        $this->readyToLoad = true;
    }

    public function updatingCant()
    {
        $this->resetPage('emailsPage');
    }

    public function updatingSearch()
    {
        $this->resetPage('emailsPage');
    }

    public function render()
    {
        if ($this->readyToLoad) {
            $emails = $this->emails = Email::where('id', 'like', '%' . $this->search . '%')
                ->orwhere('name', 'like', '%' . $this->search . '%')
                ->orwhere('email', 'like', '%' . $this->search . '%')
                ->orwhere('created_at', 'like', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant, ['*'], 'emailsPage');
        } else {
            $emails = [];
        }
        return view('livewire.emails.email-controller',compact('emails'));
    }

    public function order($sort)
    {
        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    
    public function delete($id)
    {
        $email = Email::find($id);
        $email->delete();
    }

}
