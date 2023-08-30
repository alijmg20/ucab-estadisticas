@section('title', 'Mis estadisticas')
<div class="container">
    <div class="mt-4 text-3xl text-left dark:text-gray-400">
        <h1 class="mt-4 text-3xl text-left dark:text-gray-400">
            Mis estadisticas personales
        </h1>
    </div>
    <div class="mt-4 mb-6 bg-white dark:bg-gray-800 rounded-lg overflow-hidden transform sm:w-full">
        <div class="px-6 py-4">
            <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                <div class="container mt-4">
                    <x-label class="mb-4" value="Proyectos en progreso" />
                    <dl class="text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                        <div class="flex flex-col pb-3">
                            <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Email address</dt>
                            <dd class="text-lg font-semibold">yourname@flowbite.com</dd>
                        </div>
                        <div class="flex flex-col py-3">
                            <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Home address</dt>
                            <dd class="text-lg font-semibold">92 Miles Drive, Newark, NJ 07103, California, USA</dd>
                        </div>
                        <div class="flex flex-col pt-3">
                            <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Phone number</dt>
                            <dd class="text-lg font-semibold">+00 123 456 789 / +12 345 678</dd>
                        </div>
                    </dl>

                </div>
            </div>
        </div>
    </div>
</div>
