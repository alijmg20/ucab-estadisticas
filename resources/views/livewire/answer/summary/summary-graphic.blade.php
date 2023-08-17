<div wire:init='loadSummary'>
    @if ($question->typequestion == 1)
    <div x-data="{ open: false }">
        <div class="mt-4 mb-6 bg-white dark:bg-gray-800 rounded-lg overflow-hidden transform sm:w-full">
            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                <button @click="open = !open"
                class="text-xl text-left dark:text-gray-400 flex items-center justify-between w-full p-5 font-medium text-left text-gray-800 border border-gray-200 rounded-lg dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none">
                {{ $question->name }}
            </button>
            </div>
            @if (count($answers))
                @foreach ($answers as $answer)
                <div x-show="open">
                    <div class="px-6 py-4  border border-gray-300 overflow-hidden transform sm:w-full">
                        <div class="text-lg text-gray-600 dark:text-gray-400">
                            {{ $answer->answer }}
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
    @elseif ($question->typequestion == 2)
        <div id="{{ $question->id }}"></div>
        <script>
            document.addEventListener('livewire:load', function() {
                Livewire.on('summaryGraphicShow', (question, data) => {
                    console.log(question);
                    if (question.typequestion == 2) {
                        circle(question, data);
                    } else if (question.typequestion == 2) {
                        column(question, data);
                    } else if (question.typequestion == 2) {
                        bar(question, data);
                    }
                });
            });
        </script>
    @endif
</div>
