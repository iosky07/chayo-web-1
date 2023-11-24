<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Edit Mahasiswa') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Mahasiswa</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.student.index') }}">Edit Mahasiswa</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:student-form action="update" dataId="{{$id}}"/>
    </div>
</x-app-layout>
