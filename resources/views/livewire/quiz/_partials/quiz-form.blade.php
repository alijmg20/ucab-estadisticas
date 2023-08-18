<div>
    <div
        class="border-t-3 border-blue-500 mt-4 mb-6 bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg transform sm:w-full">
        <div class="px-6 py-4">
            <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">

                <div class="container mt-4">
                    <x-input placeholder="Nombre de la encuesta" id="name" wire:model='name' type="text"
                        class="w-full input-quiz text-3xl" />
                    <x-input-error for="name" />
                </div>
                <div class="container mt-4">
                    <textarea placeholder="Descripción de la encuesta" wire:model.defer='description' 
                    x-data
                    x-ref="textarea"
                    x-init="
                        $refs.textarea.addEventListener('input', function() {
                            this.style.height = 'auto';
                            this.style.height = (this.scrollHeight) + 'px';
                        });
                        Livewire.on('updateTextareaHeight', function() {
                            $refs.textarea.style.height = 'auto';
                            $refs.textarea.style.height = ($refs.textarea.scrollHeight) + 'px';
                        });
                    "
                    x-on:input.debounce.300ms="text = $event.target.value"
                    class="w-full form-control input-quiz min-h-[3rem] max-h-[10rem]
                    border rounded-md p-2 overflow-hidden
                    "
                        cols="30" rows="1"></textarea>
                    <x-input-error for="description" />
                </div>

                <div class="container mt-4">
                    <x-label class="mb-4" value="Estado de publicación" />
                    <x-radio-group class="inline inline-flex">
                        <x-label for="No Publicado" class="mr-2" value="No Publicado" />
                        <x-input id="No Publicado" wire:model.def='status' type="radio" class="form-radio mr-2"
                            name="opcion" value="1" :checked="$status === 1" />
                        <x-label for="Publicado" class="mr-2" value="Publicado" />
                        <x-input id="Publicado" wire:model='status' type="radio" class="form-radio mr-2"
                            name="opcion" value="2" :checked="$status === 2" />
                    </x-radio-group>
                    <x-input-error for="status" />
                </div>
                <div class="flex flex-row justify-end px-6 py-4 text-right">
                    <x-secondary-button wire:click.debounce.100ms='back()' class="mr-2">
                        volver
                    </x-secondary-button>
                    <x-button
                    wire:click="save()" wire:loading.attr='disabled' wire:target="save"
                     class="bg-green-600 mr-2 disabled:opacity-25" >Actualizar</x-button>
                    @livewire('quiz.export-questions', ['quiz' => $quiz->id])
                    <x-primary-button wire:click.debounce.100ms='viewquiz' >
                        Compartir
                    </x-primary-button>
                </div>
            </div>
        </div>
    </div>
    {{-- Preguntas --}}
    @livewire('questions.questions-quiz', ['quiz' => $quiz->id])
</div>