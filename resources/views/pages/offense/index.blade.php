<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data Jenis Pelanggaran') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Pelanggaran</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.offense.index') }}">Data Jenis Pelanggaran</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.main name="offense" :model="$off" />
    </div>
</x-app-layout>
