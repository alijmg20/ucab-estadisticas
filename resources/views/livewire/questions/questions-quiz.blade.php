<div wire:init='loadQuestionsQuizzes()'>
    @if ($questions && !count($questions))
        <div>No hay preguntas creadas</div>
    @elseif ($questions && count($questions))
        @foreach ($questions as $question)
            @livewire('questions.question', ['question' => $question->id], key($question->id))
        @endforeach
    @else
        <div>Cargando encuesta...</div>
    @endif

    @include('livewire.questions._partials.add-button')
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('questionAlert', (type, message) => {
                toastRight(type, message)
            });
            Livewire.on('questionDelete', (type, message) => {
                toastRight(type, message)
            });
        });
    </script>
</div>
