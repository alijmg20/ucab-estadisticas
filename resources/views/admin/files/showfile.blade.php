<x-admin-layout>
    @section('title','Administrador de Datos')
    @livewire('file.file-controller-show', ['file' => $file])
</x-admin-layout>