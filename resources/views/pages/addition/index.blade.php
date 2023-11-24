<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data Jenis Kepatuhan') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Kepatuhan</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.addition.index') }}">Data Jenis Kepatuhan</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.main name="addition" :model="$add" />
    </div>
</x-app-layout>
