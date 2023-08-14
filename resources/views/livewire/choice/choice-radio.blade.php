<div>
    <div class="flex items-center mb-4">
        <input id="default-radio-{{ $choice->id }}" disabled type="radio" value="" name="radio-question"
            class="w-6 h-6 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
        <textarea placeholder="Opción" x-data x-ref="textarea" x-init="$refs.textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
        Livewire.on('updateTextareaHeight', function() {
            $refs.textarea.style.height = 'auto';
            $refs.textarea.style.height = ($refs.textarea.scrollHeight) + 'px';
        });"
            x-on:input.debounce.300ms="text = $event.target.value"
            class="w-full form-control input-quiz min-h-[3rem] max-h-[10rem] resize-none
        border rounded-md p-2 overflow-hidden text-md"
            cols="30" rows="1">{{ $value }}</textarea>
        <button wire:click=''
            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-green-500 rounded-lg dark:text-gray-400 focus:outline-none"
            aria-label="Add">
            <i class="fas fa-plus text-xl"></i>
        </button>
        <button wire:click="" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-red-500 rounded-lg dark:text-gray-400 focus:outline-none" aria-label="Delete">
            <i class="fas fa-trash-alt text-xl"></i>
        </button>
    </div>
</div>
