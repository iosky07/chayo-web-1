<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Edit Member') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Member</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.member.index') }}">Edit Member</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:member-form action="update" dataId="{{$id}}"/>
    </div>
</x-app-layout>
