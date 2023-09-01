@section('title', 'Mis estadisticas')
<div id="print-stadistics" class="container">
    <div class="flex justify-between mt-4 text-3xl text-left dark:text-gray-400">
        <h1 class=" mt-4 text-3xl text-left dark:text-gray-400">
            Mis estadisticas personales
        </h1>
        <div>
        <a class="ml-4 disabled:opacity-25 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
        target="_blank" href="{{route('admin.stadistics.pdf',compact('date_ini','date_end','line_id'))}}">vista previa PDF</a>
        </div>
    </div>
    <div class="mt-4 mb-6 bg-white dark:bg-gray-800 rounded-lg overflow-hidden transform sm:w-full">
        <div class="px-6 py-4">
            <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                <div class="mt-4">
                    <div class="flex items-center">
                        <div class="relative">
                            <span class="mr-4">
                                Filtro de tiempo desde
                            </span>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-black dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input type="date" wire:model='date_ini' name="date_ini"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Fecha de inicio" id="id_date_ini">
                        </div>
                        <span class="mx-4 text-black">hasta</span>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-black dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input type="date" wire:model='date_end' name="date_end"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Fecha de fin" id="id_date_end">
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center">
                        <x-label class="mr-4" for="line_id" value="lineas de investigación" />
                        <x-select-dropdown class="w-auto" wire:model.def='line_id'>
                            <option value="0">Todas las lineas</option>
                            @foreach ($lines as $line)
                                <option value="{{ $line->id }}">{{ $line->name }}</option>
                            @endforeach
                        </x-select-dropdown>
                    </div>
                </div>

            </div>
        </div>
        <div class="px-6 py-4">
            <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                <div class="mt-4">
                    <dl class="text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                        <div class="flex justify-between w-full pb-3">
                            <dt class="mb-1 text-black md:text-lg dark:text-gray-400">Proyectos en progreso</dt>
                            <dt class="mb-1 text-black md:text-lg dark:text-gray-400">
                                .......................................................................................................................................................................................
                            </dt>
                            <dd class="text-lg font-semibold">{{ $totalsProject['ProjectsProgress']->count() }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
        <div class="px-6 py-4">
            <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                <div class="mt-4">
                    <dl class="text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                        <div class="flex justify-between w-full pb-3">
                            <dt class="mb-1 text-black md:text-lg dark:text-gray-400">Proyectos finalizados</dt>
                            <dt class="mb-1 text-black md:text-lg dark:text-gray-400">
                                .......................................................................................................................................................................................
                            </dt>
                            <dd class="text-lg font-semibold">{{ $totalsProject['ProjectsEnded']->count() }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
        <hr class="border-t-2 border-gray-300 my-4">
        <div class="px-6 py-4">
            <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                <div class="mt-4">
                    <dl class="text-gray-900 dark:text-white ">
                        <div class="flex justify-between w-full pb-3">
                            <dd class="text-lg font-semibold">Proyectos Por Linea de invetigación</dd>
                        </div>
                        <ol class="space-y-4 text-black list-decimal list-inside dark:text-gray-400">
                            @foreach ($lines as $line)
                                <li class="text-lg">
                                    {{ $line->name }}
                                    <ul class="text-md pl-5 mt-2 space-y-1 list-disc list-inside">
                                        @foreach ($projects as $project)
                                            @if ($project->line_id == $line->id)
                                                <li class="flex justify-between w-full pb-3">
                                                    <span>
                                                        @if ($project->ended == 1)
                                                            <i class="far fa-check-square mr-2"></i>
                                                        @else
                                                            <i class="text-green-500 fas fa-check-square mr-2"></i>
                                                        @endif
                                                        {{ $project->name }}
                                                    </span>
                                                    @if ($project->ended == 1)
                                                        <span class="text-gray-500"> EN PROGRESO</span>
                                                    @else
                                                        <span class="text-green-500"> TERMINADO</span>
                                                    @endif
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ol>
                    </dl>
                </div>
            </div>
        </div>
    </div>
    <script>
        function printContent() {
            window.print();
        }
        </script>
</div>
