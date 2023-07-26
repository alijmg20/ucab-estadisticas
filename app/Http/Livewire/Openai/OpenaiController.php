<?php

namespace App\Http\Livewire\Openai;

use Livewire\Component;
use App\Services\OpenAIApi;
use Illuminate\Support\Facades\Session;
class OpenaiController extends Component
{
    public $message;
    public $messages = [];
    public $messagesApi = [];
    public function render()
    {
        return view('livewire.openai.openai-controller');
    }

    public function sendMessage()
    {
        // Agregar el mensaje actual al historial de mensajes
        $this->messages[] = ['agent'=> 'A','message' => $this->message];
        $this->messagesApi[] = ['role' => 'user','content' => $this->message];
        // Obtener la instancia de la API de OpenAI
        $openai = new OpenAIApi();

        // Obtener una respuesta de la API, pasando el historial de mensajes
        $response = $openai->completePrompt($this->message, $this->messagesApi);
        // Agregar la respuesta de la API al historial de mensajes
        $this->messages[] = ['agent'=> 'AI','message' => $response->original];
        $this->messagesApi[] = ['role' => 'assistant','content' => $response->original];
        // Limpiar el mensaje actual después de enviarlo
        $this->message = '';
    }

}
