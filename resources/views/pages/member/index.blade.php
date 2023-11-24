<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data Member Baru') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Member</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.member.index') }}">Data Member Baru</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.main name="member" :model="$mem" />
    </div>
</x-app-layout>
