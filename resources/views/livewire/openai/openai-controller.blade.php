<div>
    <x-loading/>
    <div class="flex h-screen antialiased text-gray-800">
        <div class="flex flex-row h-full w-full overflow-x-hidden">
            <div class="flex flex-col flex-auto h-full p-6">
                <div class="flex flex-col flex-auto flex-shrink-0 rounded-2xl bg-gray-100 h-full p-4">
                    <div class="flex flex-col h-full overflow-x-auto mb-4">
                        <div class="flex flex-col h-full">
                            <div class="grid grid-cols-12 gap-y-2">
                                @foreach ($messages as $mess)
                                    @if ($mess['agent'] == 'AI')
                                        <div class="col-start-1 col-end-8 p-3 rounded-lg">
                                            <div class="flex flex-row items-center">
                                                <div
                                                    class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0">
                                                    {{ $mess['agent'] }}
                                                </div>
                                                <div class="relative ml-3 text-sm bg-white py-2 px-4 shadow rounded-xl">
                                                    <div>{{ $mess['message'] }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-start-6 col-end-13 p-3 rounded-lg">
                                            <div class="flex items-center justify-start flex-row-reverse">
                                                <div
                                                    class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0">
                                                    {{ $mess['agent'] }}
                                                </div>
                                                <div
                                                    class="relative mr-3 text-sm bg-indigo-100 py-2 px-4 shadow rounded-xl">
                                                    <div>{{ $mess['message'] }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row items-center flex-grow ml-4 h-16 px-4">
                      <x-input-error for="message" />
                    </div>
                    <div class="flex flex-row items-center h-16 rounded-xl bg-white w-full px-4">
                        <div class="flex-grow ml-4">
                            <div class="relative w-full">
                                <input wire:model="message" wire:keydown.enter="spinner()" type="text"
                                    class="flex w-full border rounded-xl focus:outline-none focus:border-indigo-300 pl-4 h-10" />
                            </div>
                        </div>
                        <div class="ml-4">
                            <button wire:loading.attr='disabled' wire:target="sendMessage" wire:click="spinner()"
                                class="disabled:opacity-25 flex items-center justify-center bg-indigo-500 hover:bg-indigo-600 rounded-xl text-white px-4 py-1 flex-shrink-0 ">
                                <span>Send</span>
                                <span class="ml-2">
                                    <svg class="w-4 h-4 transform rotate-45 -mt-px" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function spinner() {
            $('.spinner').addClass('loading-spinner');
            $('.loading-overlay').removeClass('hidden');
            $('.spinner').addClass('flex');
            $('.loading-overlay').addClass('flex');
        }
        document.addEventListener('livewire:load', function() {
            Livewire.on('spinnerOn', () => {
                spinner();
                @this.sendMessage();
            });
        });
    </script>
</div>
