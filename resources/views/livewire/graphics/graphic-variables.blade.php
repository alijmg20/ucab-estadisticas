<div wire:init='loadgraphicvariables'>
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4">
        <div class="bg-white w-full shadow rounded-lg p-3">
            <div class="grid grid-cols-2 md:grid-cols-3">
                @foreach ($variables as $variable)
                    <div id="variable-{{$variable->id}}"class="hover:bg-gray-300 rounded-md hover:shadow-lg border border-gray-100">
                        <div class="flex  p-2 justify-between">
                            <div>
                                <input id="default-checkbox-{{ $variable->id }}" type="checkbox" value="" @if ($variable->status == 2) checked @endif wire:click="status({{ $variable->id }})" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="default-checkbox-{{ $variable->id }}" class="ml-2 text-sm text-left font-medium text-gray-900  dark:text-gray-300">{{ $variable->name }}</label>
                            </div>
                            <div class="flex items-right text-sm">
                                <button wire:click='$emitTo("variable.variable-modal","edit",{{ $variable->id }})'
                                    class="flex mr-2 items-center  text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                    aria-label="Edit">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button wire:click='$emit("variableDelete",{{ $variable->id }})'
                                    class="flex items-center  text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                    aria-label="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
                @livewire('variable.variable-modal')
            </div>
        </div>
    </div>
</div>
