<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Edit Kepatuhan') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Kepatuhan</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.addition.index') }}">Edit Kepatuhan</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:addition-form action="update" dataId="{{$id}}"/>
    </div>
</x-app-layout>
