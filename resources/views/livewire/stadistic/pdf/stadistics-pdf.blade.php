@section('title', 'Mis estadisticas PDF')
<div id="print-stadistics" class="container">
    <div class="flex justify-between mt-4 text-3xl text-left dark:text-gray-400">
        <h1 class=" text-3xl text-left dark:text-gray-400">
            Mis estadisticas personales
        </h1>
        <div>
        <a class="ml-4 disabled:opacity-25 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
        id="printBtn" onclick="printContent()" href="#">descargar PDF</a>
        {{-- <a class="ml-4 disabled:opacity-25 inline-flex items-center px-4 py-2 bg-indigo-500 dark:bg-indigo-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
        wire:click='goBack()'    href="#">Volver</a> --}}
        </div>
    </div>
    <div class="mt-4 bg-white dark:bg-gray-800 rounded-lg overflow-hidden transform sm:w-full">
        <div class="px-6 py-4">
            <div class="text-sm text-gray-600 dark:text-gray-400">
                <div class="">
                    <dl class="text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                        <div class="flex justify-between w-full pb-3">
                            <dt class="mb-1 text-black md:text-md dark:text-gray-400">Proyectos en progreso</dt>
                            <dt class="mb-1 text-black md:text-md dark:text-gray-400">
                                ......................................................................................................................................................................................................
                            </dt>
                            <dd class="text-md font-semibold">{{ $totalsProject['ProjectsProgress']->count() }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
        <div class="px-6 py-4 border-b-2 border-gray-300">
            <div class=" text-sm text-gray-600 dark:text-gray-400">
                <div class="">
                    <dl class="text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                        <div class="flex justify-between w-full pb-3">
                            <dt class="mb-1 text-black md:text-md dark:text-gray-400">Proyectos finalizados</dt>
                            <dt class="mb-1 text-black md:text-md dark:text-gray-400">
                                ......................................................................................................................................................................................................
                            </dt>
                            <dd class="text-md font-semibold">{{ $totalsProject['ProjectsEnded']->count() }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
        <div class="px-6 py-4">
            <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                <div class="mt-4">
                    <dl class="text-gray-900 dark:text-white ">
                        <div class="flex justify-between w-full pb-3">
                            <dd class="text-lg font-semibold">Proyectos Por Linea de invetigación</dd>
                        </div>
                        <ol class="text-black list-decimal list-inside dark:text-gray-400">
                            @foreach ($lines as $line)
                                <li class="text-lg">
                                    {{ $line->name }}
                                    <ul class="text-sm pl-5 mt-2 space-y-1 list-disc list-inside">
                                        @foreach ($projects as $project)
                                            @if ($project->line_id == $line->id)
                                                <li class="inline-flex justify-between w-full pb-3">
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
                                                        <span class="text-green-500"> FINALIZADO</span>
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
            $('#printBtn').css('display', 'none');
            window.print();
            $('#printBtn').css('display', 'inline-block');
        }
        </script>
</div>
