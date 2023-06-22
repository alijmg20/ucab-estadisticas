<div class="py-12">
    <div class="w-full pt-4 pb-4 px-4 sm:px-6 borders-testimonial">
        <div class="lg:text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl text-center">
                {{__('Experiencias de los Investigadores')}}
            </h2>
            <p class="mt-4 w-full text-xl text-gray-500 lg:mx-auto text-center">
                {{__('Aquí les mostramos las experiencias que han tenido los investigadores durante sus proyectos')}}
            </p>
        </div>

        <div class="mt-10">
        <div id="controls-carousel" class="relative w-full" data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                <!-- Item 1 -->
                @foreach ($testimonials as $testimonial)
                <div class="duration-700 ease-in-out absolute inset-0 transition-transform transform translate-x-full z-10 hidden" data-carousel-item="">
                    <div class="sm:px-16 lg:px-48 h-full bg-white rounded-lg overflow-hidden shadow-md absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                        <div class="px-6 py-8 relative">
                            <img src="{{ $testimonial->user->profile_photo_url }}" alt="Perfil" class="rounded-full w-24 h-24 mx-auto mb-4 block">
                            <div class="text-center">
                                <div class="font-bold text-xl mb-2">
                                    {{$testimonial->user->name}}
                                </div>
                            </div>
                            <p class="text-gray-700 text-base">
                                {!!$testimonial->message!!}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- Slider controls -->
            <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev="">
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 hover:bg-gray-100 dark:hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg aria-hidden="true" class="w-6 h-6 text-black dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next="">
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 hover:bg-gray-100 dark:hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg aria-hidden="true" class="w-6 h-6 text-black dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>
        </div>
    </div>
    
</div>