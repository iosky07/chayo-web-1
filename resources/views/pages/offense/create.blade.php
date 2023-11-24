<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Tambah Jenis Pelanggaran') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Pelanggaran</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.offense.index') }}">Tambah Jenis Pelanggaran</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:offense-form action="create"/>
    </div>
</x-app-layout>
