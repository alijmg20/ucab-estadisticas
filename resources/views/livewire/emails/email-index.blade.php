<div>
    <div class="mr-3 ml-3 mb-10  xl:mx-32 relative ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="overflow-hidden px-6 py-10">
                <div class="px-6 py-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="col-span-1 mx-auto">
                            <div class="mb-10">
                                <h2 class="text-4xl font-bold leading-tight lg:text-5xl mb-2">¡Escríbenos!</h2>
                                <div class="text-gray-600">Dejanos un mensaje y te responderemos a la brevedad</div>
                            </div>
                            <img src="{{ asset('img/frontbanner/ucab.png') }}" alt="img"
                                class="rounded-lg p-6 w-50 h-50 ">
                        </div>
                        <div class="col-span-1">
                            <div class="flex w-full overflow-hidden bg-white rounded-lg shadow-md">
                                <div class="flex-shrink-0 flex items-center justify-center w-12 bg-blue-500">
                                    <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z">
                                        </path>
                                    </svg>
                                </div>

                                <div class="px-4 py-2 -mx-3">
                                    <div class="mx-3">
                                        <span class="font-semibold text-blue-500">
                                            ¡Gracias por escribirnos!
                                        </span>
                                        <div class="text-sm text-gray-600">
                                            Este es un formulario de contácto, donde podremos aclarar dudas
                                            especificas y de gran relevancia.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form wire:submit.prevent="save()">

                                <div>
                                    <label for="name" class="text-sm font-bold">Nombre completo</label>
                                    <input
                                        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full"
                                        wire:model="name" type="text" placeholder="Nombre completo">
                                    @error('name')
                                        <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label class="text-sm font-bold">Email</label>
                                    <input wire:model="mail"
                                        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full"
                                        type="email" placeholder="Escriba aquí su correo electrónico">
                                    @error('mail')
                                        <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label class="text-sm font-bold">Asunto</label>
                                    <input wire:model="subject"
                                        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full"
                                        type="text" placeholder="Asunto">
                                    @error('subject')
                                        <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label class="text-sm font-bold">Mensaje</label>
                                    <div class="w-full">
                                        <textarea wire:model="message"
                                            class="
                                                  form-control
                                                  block
                                                  w-full
                                                  px-3
                                                  py-1.5
                                                  text-base
                                                  font-normal
                                                  text-gray-700
                                                  bg-white bg-clip-padding
                                                  border border-solid border-gray-300
                                                  rounded
                                                  transition
                                                  ease-in-out
                                                  m-0
                                                  focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
                                                "
                                            rows="3" placeholder="Escribe tu mensaje"></textarea>
                                        @error('message')
                                            <span class="text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    <label class="mt-2 text-sm font-bold my-5" onclick="alerta()">Verifica que no eres un robot: <b class="cursor-pointer" wire:click="change()">{{$cod}}</b><span
                                            class="font-bold"></span></label>
                                    <div class="w-full">
                                        <input wire:model="code"
                                            class="uppercase
                                                  form-control
                                                  block
                                                  w-full
                                                  px-3
                                                  py-1.5
                                                  text-base
                                                  font-normal
                                                  text-gray-700
                                                  bg-white bg-clip-padding
                                                  border border-solid border-gray-300
                                                  rounded
                                                  transition
                                                  ease-in-out
                                                  m-0
                                                  focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
                                                "
                                            rows="3" placeholder="Escribe el codigo" />
                                        @error('code')
                                            <span class="text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    <button
                                        class="mt-2 w-full p-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Enviar mensaje
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:load', function() {
            livewire.on('success', data => {
                toastRight('success', 'El mensaje ha sido enviado');
            })
            livewire.on('error', data => {
                toastRight('error', 'El codigo es incorrecto!');
            })
            livewire.on('change', data => {
                toastRight('warning', 'El codigo es incorrecto!');
            })
        });
    </script>
</div>
