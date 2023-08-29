<div>

    @if (count($variablesActive))
        @foreach ($variablesActive as $variableActive)
            @livewire('graphics.graphic', ['variable' => $variableActive['id']], key($variableActive['id']))
        @endforeach
    @else
        <div style="display: none">@livewire('graphics.graphic', ['variable' => 0])</div>
        <div class="container mt-4 mb-4">
            <x-alert-loading-danger>
                <x-slot name="title">Variables NO seleccionadas</x-slot>
                <x-slot name="subtitle">¡Debe seleccionar las variables que desea ver en la pestaña
                    <b>variables!</b>
                </x-slot>
            </x-alert-loading-danger>
        </div>
    @endif
    @livewire('graphics.multiple.score-modal')

    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('scoreAlert', (title, message) => {
                alert(title, message)
            });
        });
    </script>

</div>
