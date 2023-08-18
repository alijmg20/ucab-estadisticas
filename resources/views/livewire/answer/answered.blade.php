<div class="container-quiz">
    <div
        class="container border-t-3 border-blue-500 mt-4 mb-6 bg-white dark:bg-gray-800 rounded-lg overflow-hidden transform sm:w-full">
        <div class="px-6 py-4">
            <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                <div class="container mt-4">
                    <div class="w-full border input-quiz rounded-md p-2 overflow-hidden text-4xl">
                        Encuesta respondida satisfactoriamente
                    </div>
                </div>
                <div class="container mt-4">
                    <div class="w-full form-control input-quiz border rounded-md p-2 overflow-hidden">
                        Si deseas volver a responder la encuesta, puedes hacer uso del botón
                    </div>
                </div>
                <div class="container mt-4 px-8 py-4">
                    <a 
                    class="bg-indigo-600 disabled:opacity-25 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                    href="{{ route('answer.index', $quiz) }}">Volver a realizar encuesta</a>
                </div>
            </div>
        </div>
    </div>
</div>