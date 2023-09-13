<div wire:init='loadgraphic'>
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
        <div class="inline-block w-full overflow-hidden">
            <div id="download-pdf-graphics" x-data="{ activeTabVariable: 1 }">
                <div class=" mb-4 border-b border-gray-200 dark:border-gray-700">
                    <td class="px-4 py-3">
                        <div class="flex items-center space-x-4 mb-4 text-sm">
                            <div>
                                Opciones:
                            </div>
                            <a class="mr-2 disabled:opacity-25 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                                target="_blank" href="{{ route('admin.pdf.graphics', $file->id) }}">Reporte PDF</a>
                        </div>
                    </td>
                    <ul
                        class="border border-gray-300 bg-white rounded-lg 
                    overflow-hidden flex flex-wrap -mb-px text-sm font-medium 
                    text-center px-6">
                        <li wire:click="updateTab(1)" class="mr-2" role="presentation">
                            <a x-on:click.prevent="activeTabVariable = 1"
                                :class="{
                                    'inline-block p-4 border-b-2 rounded-t-lg text-blue-600 hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-500 border-blue-600 dark:border-blue-500': activeTabVariable ===
                                        1,
                                    'inline-block p-4 border-b-2 border-transparent rounded-t-lg dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300': activeTabVariable !==
                                        1
                                }"
                                href="#">Texto</a>
                        </li>
                        <li wire:click="updateTab(2)" class="mr-2" role="presentation">
                            <a x-on:click.prevent="activeTabVariable = 2"
                                :class="{
                                    'inline-block p-4 border-b-2 rounded-t-lg text-blue-600 hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-500 border-blue-600 dark:border-blue-500': activeTabVariable ===
                                        2,
                                    'inline-block p-4 border-b-2 border-transparent rounded-t-lg dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300': activeTabVariable !==
                                        2
                                }"
                                href="#">Selección simple</a>
                        </li>
                        <li wire:click="updateTab(3)" class="mr-2" role="presentation">
                            <a x-on:click.prevent="activeTabVariable = 3"
                                :class="{
                                    'inline-block p-4 border-b-2 rounded-t-lg text-blue-600 hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-500 border-blue-600 dark:border-blue-500': activeTabVariable ===
                                        3,
                                    'inline-block p-4 border-b-2 border-transparent rounded-t-lg dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300': activeTabVariable !==
                                        3
                                }"
                                href="#">opción multiple</a>
                        </li>
                        <li wire:click="updateTab(4)" class="mr-2" role="presentation">
                            <a x-on:click.prevent="activeTabVariable = 4"
                                :class="{
                                    'inline-block p-4 border-b-2 rounded-t-lg text-blue-600 hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-500 border-blue-600 dark:border-blue-500': activeTabVariable ===
                                        4,
                                    'inline-block p-4 border-b-2 border-transparent rounded-t-lg dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300': activeTabVariable !==
                                        4
                                }"
                                href="#">Correlacionar variables</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <div x-show="activeTabVariable === 1">
                        @livewire('graphics.qualitatives.qualitative-controller', ['file' => $file->id])
                    </div>
                    <div x-show="activeTabVariable === 2">
                        @livewire('graphics.multiple.multiple-controller', ['file' => $file->id])
                    </div>
                    <div x-show="activeTabVariable === 3">
                        @livewire('graphics.checkbox.checkbox-controller', ['file' => $file->id])
                    </div>
                    <div x-show="activeTabVariable === 4">
                        @livewire('graphics.correlation.correlation-controller', ['file' => $file->id])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
