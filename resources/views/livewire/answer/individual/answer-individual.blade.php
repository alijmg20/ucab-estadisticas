<div wire:init='loadAnswerIndividual'>
    <div
        class="border border-gray-300 mb-6 mt-4 bg-white dark:bg-gray-800 rounded-lg overflow-hidden transform sm:w-full">
        <div class="px-6 py-4">
            @if ($quizUsers && count($quizUsers) && $quizUsers->hasPages())
                <div class="flex items-center justify-between mx-6">
                    <div class="mr-2">
                        <span class="mr-2">Ir a la Respuesta:</span>
                        <input wire:model="pageAux" type="number" min="1" max="{{ $quizUsers->lastPage() }}"
                            class="border rounded px-2 py-1">
                        <x-primary-button wire:click="gotoAnswerIndividual()"
                            class="ml-2 bg-blue-500 disabled:opacity-25">
                            Ir
                        </x-primary-button>
                    </div>
                    <div>
                        <div class="mr-2 ">
                            <span class="mr-2">Respuesta {{$answerIndividualPage}} de </span>
                            <span class="mr-2">{{ $quizUsers->lastPage() }}</span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    @if ($quizUsers && count($quizUsers) == 0)
        <tr>
            <td colspan="5" class="px-6 py-4 text-center">
                <div class="container mt-4 mb-4">
                    <x-alert-loading-danger>
                        <x-slot name="title">Pagina no existe</x-slot>
                        <x-slot name="subtitle">Puedes volver en el siguiente botón <x-primary-button
                                wire:click="resetAnswerIndividualPage()" class="ml-2 bg-blue-500 disabled:opacity-25">
                                Resetear
                            </x-primary-button></x-slot>
                    </x-alert-loading-danger>
                </div>
            </td>
        </tr>
    @elseif ($quizUsers && count($quizUsers))
        @foreach ($quizUsers as $quizUser)
            <div
                class="container border-t-3 border-blue-500 mt-4 mb-6 bg-white dark:bg-gray-800 rounded-lg overflow-hidden transform sm:w-full">
                <div class="px-6 py-4">
                    <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                        <div class="container mt-4">
                            <div class="w-full form-control input-quiz border rounded-md p-2 overflow-hidden text-3xl">
                                {{ $quizUser->quiz->name }}
                            </div>
                        </div>
                        <div class="container mt-4">
                            <div class="w-full form-control input-quiz border rounded-md p-2 overflow-hidden">
                                {{ $quizUser->quiz->description }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @foreach (\App\Models\Answer::where('quiz_user_id', $quizUser->id)->get() as $answer)
                @if ($question = App\Models\Question::find($answer->question_id))
                    <div
                        class="border border-gray-300 mb-6 mt-4 bg-white dark:bg-gray-800 rounded-lg overflow-hidden transform sm:w-full">
                        <div class="px-6 py-4">
                            {{ $question->name }}
                        </div>
                        @if ($question->typequestion == 1)
                            <div class="container mt-4 mb-8">
                                <div class="w-full form-control input-quiz border rounded-md p-2 overflow-hidden">
                                    {{ $answer->answer }}
                                </div>
                            </div>
                        @elseif ($question->typequestion == 2)
                            @foreach ($question->choices as $choice)
                                <div class="flex items-center container mt-4 mb-8">
                                    <input disabled id="default-radio-{{ $question->id }}-{{ $choice->id }}"
                                        type="radio" @if ($choice->value == $answer->answer) checked @endif
                                        value="{{ $choice->value }}" name="question-radio-{{ $question->id }}"
                                        class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="default-radio-{{ $question->id }}-{{ $choice->id }}"
                                        class="ml-2 dark:text-gray-300">{{ $choice->value }}</label>
                                </div>
                            @endforeach
                        @endif
                    </div>
                @else
                    <div
                        class="border border-gray-300 mb-6 mt-4 bg-white dark:bg-gray-800 rounded-lg overflow-hidden transform sm:w-full">
                        <div class="px-6 py-4">
                            Pregunta eliminada.
                        </div>
                    </div>
                @endif
            @endforeach
        @endforeach
    @endif
</div>
