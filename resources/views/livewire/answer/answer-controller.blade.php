<div>
    <div
        class="border-tab-pane-answer-top border border-gray-300 mt-4 bg-white dark:bg-gray-800 rounded-lg overflow-hidden transform sm:w-full">
        <div class="px-6 py-4">
            <div class="text-sm text-gray-600 dark:text-gray-400">
                <h2 class="text-xl text-left dark:text-gray-400">
                    {{ $answers->count() }} Respuestas
                </h2>
            </div>
        </div>
    </div>
    <div x-data="{ activeTabAnswers: 1 }">
        <div class=" mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="border-tab-pane-answer-bottom border border-gray-300 bg-white rounded-lg overflow-hidden flex flex-wrap -mb-px text-sm font-medium text-center justify-around">
                <li wire:click="$set('content',1)" class="mr-2" role="presentation">
                    <a x-on:click.prevent="activeTabAnswers = 1"
                        :class="{
                            'inline-block p-4 border-b-2 rounded-t-lg text-blue-600 hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-500 border-blue-600 dark:border-blue-500': activeTabAnswers ===
                                1,
                            'inline-block p-4 border-b-2 border-transparent rounded-t-lg dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300': activeTabAnswers !==
                                1
                        }"
                        href="#">Resumen</a>
                </li>
                <li wire:click="$set('content',2)" class="mr-2" role="presentation">
                    <a x-on:click.prevent="activeTabAnswers = 2"
                        :class="{
                            'inline-block p-4 border-b-2 rounded-t-lg text-blue-600 hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-500 border-blue-600 dark:border-blue-500': activeTabAnswers ===
                                2,
                            'inline-block p-4 border-b-2 border-transparent rounded-t-lg dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300': activeTabAnswers !==
                                2
                        }"
                        href="#">Preguntas</a>
                </li>
                <li wire:click="$set('content',3)" class="mr-2" role="presentation">
                    <a x-on:click.prevent="activeTabAnswers = 3"
                        :class="{
                            'inline-block p-4 border-b-2 rounded-t-lg text-blue-600 hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-500 border-blue-600 dark:border-blue-500': activeTabAnswers ===
                                3,
                            'inline-block p-4 border-b-2 border-transparent rounded-t-lg dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300': activeTabAnswers !==
                                3
                        }"
                        href="#">Individual</a>
                </li>
            </ul>
        </div>
        <div>
            <div x-show="activeTabAnswers === 1">
                @livewire('answer.summary.answer-summary', ['quiz' => $quiz->id])
            </div>
            <div x-show="activeTabAnswers === 2">
                @livewire('answer.question.answer-question', ['quiz' => $quiz->id])
            </div>
            <div x-show="activeTabAnswers === 3">
                @livewire('answer.individual.answer-individual', ['quiz' => $quiz->id])
            </div>
        </div>
    </div>
</div>
