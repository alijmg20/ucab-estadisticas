<div>
    <div class="sm:w-full mt-4 mx-6 mb-6 bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg transform">
        <div class="px-6 py-4">
            <div class="text-sm text-gray-600 dark:text-gray-400">
                <div class="container mt-4 grid md:grid-cols-2 gap-4 md:gap-8">
                    <div>
                        <textarea placeholder="Pregunta" wire:model.defer='name' x-data x-ref="textarea" x-init="$refs.textarea.addEventListener('input', function() {
                            this.style.height = 'auto';
                            this.style.height = (this.scrollHeight) + 'px';
                        });
                        Livewire.on('updateTextareaHeight', function() {
                            $refs.textarea.style.height = 'auto';
                            $refs.textarea.style.height = ($refs.textarea.scrollHeight) + 'px';
                        });"
                            x-on:input.debounce.300ms="text = $event.target.value"
                            class="w-full form-control input-quiz min-h-[3rem] max-h-[10rem] resize-none
                            border rounded-md p-2 overflow-hidden text-xl"
                            cols="30" rows="1"></textarea>
                    </div>
                    <div>
                        <x-select-dropdown class="w-full" wire:model.def='typequestion'>
                            @foreach ($entrysTypeQuestions as $entry)
                                <option value="{{ $entry['id'] }}">{{ $entry['type'] }}</option>
                            @endforeach
                        </x-select-dropdown>
                    </div>
                </div>
                <div class="container mt-4">
                    @if ($typequestion == 1)
                        <textarea disabled placeholder="Texto de respuesta larga"
                            class="w-full form-control input-quiz min-h-[3rem] max-h-[10rem] resize-none
                        border rounded-md p-2 overflow-hidden text-md"
                            cols="30" rows="1"></textarea>
                    @elseif($typequestion == 2)
                        @foreach ($choices as $choice)
                            @if($choice)
                                @livewire('choice.choice-radio', ['choice' => $choice->id], key($choice->id))
                            @endif
                        @endforeach
                    @endif
                </div>
                <div class="container text-right mt-4 justify-end inline-flex">
                    <div class="flex items-center space-x-4 text-sm">
                        <button wire:click='save({{ $question->id }})'
                            wire:loading.attr='disabled' 
                            wire:target="save"
                            class="flex items-center justify-between px-2 py-2 text-sm 
                            font-medium leading-5 text-green-500 rounded-lg dark:text-gray-400 
                            focus:outline-none
                            disabled:opacity-25"
                            aria-label="Save">
                            <i class="fas fa-save text-2xl"></i>
                        </button>
                        <button wire:click='delete({{ $question->id }})'
                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-red-500 rounded-lg dark:text-gray-400 focus:outline-none"
                            aria-label="Delete">
                            <i class="fas fa-trash-alt text-xl"></i>
                        </button>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="required" wire:model="required"
                                @if ($required == true) checked @endif class="sr-only peer">
                            <div
                                class="w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                            </div>
                            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Obligatorio</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
