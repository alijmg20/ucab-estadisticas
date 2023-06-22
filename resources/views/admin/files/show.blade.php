<x-admin-layout>
    @section('title','Administrar Archivos')
    @livewire('file.file-controller', ['project' => $project])
</x-admin-layout>