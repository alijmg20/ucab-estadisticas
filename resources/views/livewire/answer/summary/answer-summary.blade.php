<div>
    @foreach ($questions as $question)
        <div
            class="border border-gray-300 mb-6 mt-4 bg-white dark:bg-gray-800 rounded-lg overflow-hidden transform sm:w-full">
            <div class="px-6 py-4">
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    @livewire('answer.summary.summary-graphic', ['question' => $question->id], key($question->id))
                </div>
            </div>
        </div>
    @endforeach
</div>
