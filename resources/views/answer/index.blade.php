<x-quiz-layout>
    @section('title','Responder Encuesta')
    @livewire('answer.answer-quiz', ['quiz' => $quiz->id])
</x-quiz-layout>