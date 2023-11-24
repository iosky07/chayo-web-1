<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Tambah Jenis Kepatuhan') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Kepatuhan</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.addition.index') }}">Tambah Jenis Kepatuhan</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:addition-form action="create"/>
    </div>
</x-app-layout>
