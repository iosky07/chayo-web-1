<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Tambah Mahasiswa Baru') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Mahasiswa</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.student.index') }}">Tambah Mahasiswa Baru</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:student-form action="create"/>
    </div>
</x-app-layout>
