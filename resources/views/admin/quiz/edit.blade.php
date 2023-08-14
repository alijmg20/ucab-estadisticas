<x-admin-layout>
    @section('title','Editar Encuesta')
    @livewire('quiz.quiz-edit',['quiz' => $quiz->id])
</x-admin-layout>