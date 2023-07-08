<div id="section-lines" class="mb-4 sm:px-16 lg:px-24">
    <h1
        class="mb-8 text-center text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-3xl dark:text-white">
        {{ $title }}
    </h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

        @foreach ($lines as $line)
                <div
                    class="mx-auto h-auto max-w-full rounded-lg bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a href="{{route('lines.show',$line)}}">
                        <img class=" object-cover rounded-t-lg w-full h-16-25" src="{{ App\Helpers\Tools::StorageUrl($line->image->url) }}"
                            alt="{{ $line->name }}" />
                    </a>
                    <div class="p-5">
                        <a href="{{route('lines.show',$line)}}">
                            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $line->name }}</h5>
                        </a>
                        <p class="mb-3 truncate overflow-ellipsis font-normal text-gray-700 dark:text-gray-400">
                            {!! strip_tags($line->description) !!}
                        </p>
                        <a href="{{route('lines.show',$line)}}"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            {{ __('Leer más') }}
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
        @endforeach
    </div>
    @if (isset($needButton))
        <div class="container text-center mb-8 mt-8">
            <a href="{{route('lines.index')}}"
                class="inline-flex items-center px-3 py-3 text-md font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                @if (isset($titleButton))
                    {{ $titleButton }}
                @endif
            </a>
        </div>
    @endif
</div>
