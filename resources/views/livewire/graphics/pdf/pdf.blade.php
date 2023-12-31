<div class="">
    @section('title', $title)
    <div class="pb-4 mx-auto px-8 sm:px-8 flex items-center">

        <h1 class="justify-center inline-block w-full flex mt-4 text-3xl text-center dark:text-gray-400 ml-4 mr-4">
            <span class="ml-4">
                Reporte de {{ $file->name }}
            </span>
            <a class="ml-4 disabled:opacity-25 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                id="btnPrint" href="#">descargar PDF</a>
        </h1>
    </div>
    <div class="mt-4 container" id="content">
        @if (count($variablesActive) || count($correlations))
            @foreach ($variablesActive as $key => $variableActive)
                @switch($variableActive['variabletype_id'])
                    @case(1)
                        @livewire('graphics.qualitatives.variable-qualitative', ['variable' => $variableActive['id']], key($variableActive['id']))
                    @break

                    @case(2)
                        @livewire('graphics.multiple.graphic', ['variable' => $variableActive['id']], key($variableActive['id']))
                    @break

                    @case(3)
                        @livewire('graphics.checkbox.variable-checkbox', ['variable' => $variableActive['id']], key($variableActive['id']))
                    @break
                @endswitch
                <div style="page-break-before: always;"></div>
            @endforeach
            @if (count($correlations))
                @foreach ($correlations as $key => $correlation)
                    @livewire('graphics.correlation.variable-correlation', ['correlation' => $correlation['id']], key($correlation['id']))
                    @if ($key < count($correlations) - 1)
                        <div style="page-break-before: always;"></div>
                    @endif
                @endforeach
            @endif
        @else
            <div style="display: none">@livewire('graphics.qualitatives.variable-qualitative', ['variable' => 0])</div>
            <div style="display: none">@livewire('graphics.multiple.graphic', ['variable' => 0])</div>
            <div style="display: none">@livewire('graphics.checkbox.variable-checkbox', ['variable' => 0])</div>
            <div style="display: none">@livewire('graphics.correlation.variable-correlation', ['correlation' => 0])</div>
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
    <script>
        document.addEventListener('livewire:load', function() {
        });
        document.getElementById('btnPrint').addEventListener('click', function() {
            $("#btnPrint").css('display', 'none');
            window.print();
            $("#btnPrint").css('display', 'inline-flex');
        });
    </script>
</div>
