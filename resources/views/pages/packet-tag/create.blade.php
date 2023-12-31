<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Tambah Paket Baru') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Paket</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.packet-tag.index') }}">Tambah Paket Baru</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:packet-tag-form action="create"/>
    </div>
</x-app-layout>
