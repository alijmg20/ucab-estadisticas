<div>
    <div class="px-6 py-4">
        <div
            class="text-2xl text-left dark:text-gray-400 flex items-center justify-between w-full p-5 
        font-medium text-left text-gray-800  focus:outline-none">
            Cuadro de variable
        </div>
        <div class="grid gap-6 mb-8 md:grid-cols-1 xl:grid-cols-1">
            <!-- Card -->
            <div class=" p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="container mt-4">
                    <p class="mb-2 text-md font-medium text-gray-600 dark:text-gray-400">
                        Frecuencias de palabras
                    </p>
                    <x-table>
                        <x-slot name="headers">
                            <th class="px-4 py-3">
                                Nombre
                            </th>
                            <th class="px-4 py-3">
                                frecuencia
                            </th>
                        </x-slot>
                        <x-slot name="body">
                            @foreach ($words as $word)
                                <tr class="text-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <td class="px-6 py-3 text-sm">
                                        {{ $word->name }}
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ $word->value }}
                                    </td>
                                </tr>
                            @endforeach
                        </x-slot>
                    </x-table>
                    @if (count($words) && $words->hasPages())
                        <div class="mt-4 px-6 py-3">
                            {{ $words->links() }}
                        </div>
                    @endif
                </div>
                <div class="container mt-4">
                    <p class="mb-2 text-md font-medium text-gray-600 dark:text-gray-400">
                        Analisis de sentimiento de la variable
                    </p>
                    <div class="grid gap-6 mb-8 md:grid-cols-3 xl:grid-cols-3">
                        <!-- Card -->
                        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <div class="p-3 mr-4 rounded-full">
                                <i class="fas fa-smile text-3xl text-green-500"></i>
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                    Impacto Positivo
                                </p>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                    {{ $sensibility['positive'] }} %
                                </p>
                            </div>
                        </div>
                        <!-- Card -->
                        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <div class="p-3 mr-4 rounded-full">
                                <i class="fas fa-frown text-3xl text-red-500"></i>
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                    Impacto Negativo
                                </p>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                    {{ $sensibility['negative'] }} %
                                </p>
                            </div>
                        </div>
                        <!-- Card -->
                        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <div class="p-3 mr-4 rounded-full">
                                <i class="fas fa-meh text-3xl text-gray-400"></i>
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                    Impacto Neutral
                                </p>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                    {{ $sensibility['neutral'] }} %
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
