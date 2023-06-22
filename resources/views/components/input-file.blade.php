<div class="relative">
    <input {{ $attributes->merge(['type' => 'file', 'class' => 'hidden']) }}>
    <label for="{{ $attributes['id'] }}"
        class="flex items-center justify-center w-full px-4 py-2 text-white bg-blue-500 rounded-md cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M5 7V3h10v4h3v10H2V7h3zm1-4a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v4H6V3zm-1 9h12v6H5v-6z"
                clip-rule="evenodd" />
        </svg>
        {{ $slot }}
    </label>
</div>
