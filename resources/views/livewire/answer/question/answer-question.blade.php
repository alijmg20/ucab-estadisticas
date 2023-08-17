<div wire:init='loadAnswerQuestion'>
    <div
        class="border border-gray-300 mb-6 mt-4 bg-white dark:bg-gray-800 rounded-lg overflow-hidden transform sm:w-full">
        <div class="px-6 py-4">
            @if ($questions && count($questions) && $questions->hasPages())
                <div class="flex items-center justify-between mx-6">
                    <div class="mr-2">
                        <span class="mr-2">Ir a la pregunta:</span>
                        <input wire:model="pageAux" type="number" min="1" max="{{ $questions->lastPage() }}"
                            class="border rounded px-2 py-1">
                        <x-primary-button wire:click="gotoAnswer()" class="ml-2 bg-blue-500 disabled:opacity-25">
                            Ir
                        </x-primary-button>
                    </div>
                    <div>
                        <div class="mr-2 ">
                            <span class="mr-2">Pregunta {{$answerQuestionPage}} de </span>
                            <span class="mr-2">{{ $questions->lastPage() }}</span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    @if ($questions && count($questions) == 0)
        <tr>
            <td colspan="5" class="px-6 py-4 text-center">
                <div class="container mt-4 mb-4">
                    <x-alert-loading-danger>
                        <x-slot name="title">Pagina no existe</x-slot>
                        <x-slot name="subtitle">Puedes volver en el siguiente botón <x-primary-button
                                wire:click="resetAnswerPage()" class="ml-2 bg-blue-500 disabled:opacity-25">
                                Resetear
                            </x-primary-button></x-slot>
                    </x-alert-loading-danger>
                </div>
            </td>
        </tr>
    @elseif ($questions && count($questions))
        @foreach ($questions as $question)
            <div
                class="border border-gray-300 mb-6 mt-4 bg-white dark:bg-gray-800 rounded-lg overflow-hidden transform sm:w-full">
                <div class="px-6 py-4">
                    {{ $question->name }}
                </div>
            </div>
            
                @foreach (App\Models\Answer::where('question_id', $question->id)->select('answer', \DB::raw('COUNT(*) as count'))->groupBy('answer')->get() as $answer)
                @if ($question->typequestion == 1)
                <div class="block px-6  mb-4 border border-gray-300 mb-6 mt-4 bg-white dark:bg-gray-800 rounded-lg overflow-hidden transform sm:w-full">
                    <div
                        class="flex items-center">
                        <div class="px-4 py-4">
                            {{ $answer->answer }}
                        </div>
                    </div>
                    <div class="text-right w-full border-t-2 border-gray-200 text-md mt-4 px-4 py-4">
                        Respuestas asociadas {{ $answer->count }}
                    </div>
                </div>
                    @elseif ($question->typequestion == 2)
                    <div class="block px-6  mb-4 border border-gray-300 mb-6 mt-4 bg-white dark:bg-gray-800 rounded-lg overflow-hidden transform sm:w-full">
                        <div
                            class="flex items-center">
                            <input disabled type="radio" value="" name="radio-question"
                                class="w-6 h-6 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <div class="px-4 py-4">
                                {{ $answer->answer }}
                            </div>
                        </div>
                        <div class="text-right w-full border-t-2 border-gray-200 text-md mt-4 px-4 py-4">
                            {{ $answer->count }} Respuestas
                        </div>
                    </div>
                    @endif
                @endforeach
            
        @endforeach
    @endif
</div>
