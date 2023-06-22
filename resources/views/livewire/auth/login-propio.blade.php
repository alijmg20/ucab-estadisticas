<div>
    <h1 class="mt-4 text-center text-2xl text-slate-800 font-bold mb-4">{{ __('Bienvenido Investigador!') }} <i
            class="fas fa-search"></i></h1>

    <div class="space-y-4">
        <div>
            <x-label for="email" value="{{ __('Correo') }}" />
            <input
                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full"
                id="password" type="email" wire:model.defer="email" placeholder="correo..."
                wire:keydown.enter="login()">
        </div>
        <div>
            <x-label for="password" value="{{ __('Clave') }}" />
            <input
                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full"
                id="password" type="{{ $type_pass }}" wire:model.defer="password" placeholder="Contraseña..."
                wire:keydown.enter="login()" required="required" autocomplete="current-password">
        </div>
    </div>
    <div class="flex items-center justify-between mt-6">

        <div class="form-group clearfix">
            <label class="fancy-checkbox element-left">
                <input wire:click="showHidePass()" type="checkbox"@if ($type_pass == 'text') checked @endif>
                <span>Ver contraseña</span>
            </label>
        </div>
        <button wire:click="login()" wire:loading.attr="disabled"
            class="rounded w-full p-2 text-indigo-100 bg-indigo-500 hover:bg-indigo-700">
            <span wire:loading.remove>Iniciar Sesion</span>

            <span wire:loading>
                <span class="loading_p spinner-border spinner-border-sm" role="status"
                    style="font-size:8px; display:block; margin:auto;">
                    <span class="sr-only"></span>
                </span>
            </span>
        </button>
    </div>

    <x-validation-errors class="mt-4" />
    <div class="pt-5 mt-6 border-t border-slate-200">
        <div class="text-sm">
            {{ __('¿Aun no tienes una cuenta?') }} <a class="font-medium text-indigo-500 hover:text-indigo-600"
                href="{{ route('register') }}">{{ __('Registrarse') }}</a>
        </div>
        <!-- Warning -->
        {{-- <div class="mt-5">
            <div class="bg-amber-100 text-amber-600 px-3 py-2 rounded">
                <svg class="inline w-3 h-3 shrink-0 fill-current" viewBox="0 0 12 12">
                    <path
                        d="M10.28 1.28L3.989 7.575 1.695 5.28A1 1 0 00.28 6.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 1.28z" />
                </svg>
                <span class="text-sm">
                    Departamento de Centro de Estudios Regionales
                </span>
            </div>
        </div> --}}
    </div>

    <script>

        document.addEventListener('livewire:load', function() {
            Livewire.on('login_fail', i => {
                toastRight('warning', 'Contraseña incorecta!');
            });
            Livewire.on('no_register', i => {
                toastRight('warning', 'El CORREO ingresado no se encuentra registrado!');
            });
            Livewire.on('user_no_verificado', i => {
                alertMessage('No se ha confirmado el correo!!',
                    'Lo sentimos, el correo ingresado no ha sido validado, por favor revise su bandeja de entrada, a veces por accidente cae en SPAM, confirme su registro para poder acceder al sistema.',
                    'warning')
            });
        });
    </script>
</div>
