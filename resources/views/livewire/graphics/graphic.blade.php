<div>
    <div x-data="{ activeTab: 1 }" class="container mx-auto px-4 sm:px-8">
        <ul
            class="hidden text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg shadow sm:flex dark:divide-gray-700 dark:text-gray-400">
            <li wire:click="$set('content',1)" class="w-full">
                <a x-on:click.prevent="activeTab = 1"
                    :class="{
                        'inline-block w-full p-4 text-gray-900 bg-gray-100 rounded-l-lg active focus:outline-none dark:bg-gray-700 dark:text-white': activeTab ===
                            1,
                        'inline-block w-full p-4 bg-white hover:text-gray-700 hover:bg-gray-50 focus:outline-none dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700': activeTab !==
                            1
                    }"
                    href="#">General</a>
            </li>
      
            <li wire:click="$set('content',2)" class="w-full">
                <a x-on:click.prevent="activeTab = 2"
                    :class="{
                        'inline-block w-full p-4 text-gray-900 bg-gray-100 rounded-l-lg active focus:outline-none dark:bg-gray-700 dark:text-white': activeTab ===
                            3,
                        'inline-block w-full p-4 bg-white hover:text-gray-700 hover:bg-gray-50 focus:outline-none dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700': activeTab !==
                            3
                    }"
                    href="#">Detalle</a>
            </li>
        
        </ul>

        <div>
            <div x-show="activeTab === 1">general</div>
            <div class="mt-4 mb-4" x-show="activeTab === 2"> 
                @livewire('variable.variable-controller', ['file' => $file,'detalle'=>true])
            </div>
            
        </div>
    </div>
</div>
