<x-quiz-layout>
    @section('title','Encuesta Respondida')
    @livewire('answer.answered', ['quiz' => $quiz->id])
</x-quiz-layout>