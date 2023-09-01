<div>
    @if (count($variablesActive))
    @foreach ($variablesActive as $variableActive)
        @livewire('graphics.checkbox.variable-checkbox', ['variable' => $variableActive['id']], key($variableActive['id']))
    @endforeach
@else
    <div style="display: none">@livewire('graphics.checkbox.variable-checkbox', ['variable' => 0])</div>
    <div class="container mt-4 mb-4">
        <x-alert-loading-danger>
            <x-slot name="title">Variables NO seleccionadas</x-slot>
            <x-slot name="subtitle">¡Debe seleccionar las variables que desea ver en la pestaña
                <b>variables!</b>
            </x-slot>
        </x-alert-loading-danger>
    </div>
@endif
</div>
