<div class="container-quiz">
    <div
        class="border-gray-300 container border-t-3 border-blue-500 mt-4 mb-6 bg-white dark:bg-gray-800 rounded-lg overflow-hidden transform sm:w-full">
        <div class="px-6 py-4">
            <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                <div class="container mt-4">
                    <div class="w-full form-control input-quiz border rounded-md p-2 overflow-hidden text-3xl">
                        {{ $quiz->name }}
                    </div>
                </div>
                <div class="container mt-4">
                    <div class="w-full form-control input-quiz border rounded-md p-2 overflow-hidden">
                        {{ $quiz->description }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($quiz->questions)
        @foreach ($quiz->questions as $question)
            <div class="border border-gray-300 container mt-4 mb-6 bg-white dark:bg-gray-800 rounded-lg overflow-hidden transform sm:w-full">
                <div class="px-6 py-4">
                    <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                        <div class="container mt-4 flex items-center">
                            <div
                                class="@if ($question->required == 2) required @endif w-full form-control shadow-none border-none rounded-md p-2 overflow-hidden text-xl">
                                {{ $question->name }}
                            </div>
                            <x-input-error class="w-full" for="answers.{{ $question->id }}" />
                        </div>
                        @if ($question->typequestion == 1)
                            <div class="container mt-4">
                                <x-input wire:model="answers.{{ $question->id }}"
                                    placeholder="Responde la pregunta aquí" id="question-{{ $question->id }}"
                                    type="text" class="w-full input-quiz" />
                            </div>
                        @elseif ($question->typequestion == 2)
                            @foreach ($question->choices as $choice)
                                <div class="flex items-center container mt-4">
                                    <input wire:model="answers.{{ $question->id }}"
                                        id="default-radio-{{ $question->id }}-{{ $choice->id }}" type="radio"
                                        value="{{ $choice->value }}" name="question-radio-{{ $question->id }}"
                                        class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="default-radio-{{ $question->id }}-{{ $choice->id }}"
                                        class="ml-2 dark:text-gray-300">{{ $choice->value }}</label>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    {{-- <div>answers {{ var_Export($answers) }}</div> --}}
    <div class="mb-6 rounded-lg overflow-hidden transform sm:w-full">
        <div class="flex flex-row justify-end py-4 text-right">
            <x-primary-button wire:click="submitAnswers()" wire:loading.attr='disabled' wire:target="submitAnswers"
                class="bg-blue-500 disabled:opacity-25">
                Enviar
            </x-primary-button>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('answerQuizAlert', (title, message) => {
                alert(title, message)
            });
        });
    </script>
</div>
