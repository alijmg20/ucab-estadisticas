<div>
    <div x-data="{ activeTab: 1 }" class="container mt-8 mx-6 mx-auto px-4 sm:px-8">
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
                    href="#">Preguntas</a>
            </li>
            <li wire:click="$set('content',2)" class="w-full">
                <a x-on:click.prevent="activeTab = 2"
                    :class="{
                        'inline-block w-full p-4 text-gray-900 bg-gray-100 rounded-l-lg active focus:outline-none dark:bg-gray-700 dark:text-white': activeTab ===
                            2,
                        'inline-block w-full p-4 bg-white hover:text-gray-700 hover:bg-gray-50 focus:outline-none dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700': activeTab !==
                            2
                    }"
                    href="#">Respuestas</a>
            </li>
        </ul>
        <div>
            <div x-show="activeTab === 1">
                @include('livewire.quiz._partials.quiz-form')
            </div>
            <div x-show="activeTab === 2">
                @livewire('answer.answer-controller', ['quiz' => $quiz->id])
            </div>
        </div>
    </div>
    @livewire('quiz.quiz-share-modal', ['quiz' => $quiz->id])
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('quizEditAlert', (title, message) => {
                alert(title, message)
            });
        });
    </script>
</div>
