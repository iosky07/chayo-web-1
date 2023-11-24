<x-app-layout>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {!! session('success') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
        @if (session('destroy'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {!! session('destroy') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    <x-slot name="header_content">
        <h1>{{ __('Detail Poin Mahasiswa Baru') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Mahasiswa</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.student-detail.index') }}">Detail Poin Mahasiswa baru</a></div>
        </div>
    </x-slot>

    <div>
{{--        {{dd("bbb")}}--}}
{{--        <livewire:student-detail-form action="update" dataId="{{$id}}"/>--}}

        <div id="form-create" class=" card p-4">
{{--            {{dd($id)}}--}}
            <form action="{{route('admin.student-detail.update', $id)}}" method="post">
                @csrf
                @method('put')
                <div class="form-group col-span-6 sm:col-span-5">
                    <label>Pilih Pelanggaran</label>
                    <select class="mt-1 block w-full form-control shadow-none" name="logo">
                        <option value="">======= Pilih Opsi ========</option>
{{--                        <option value=1>1</option>--}}
{{--                        <option value=2>2</option>--}}
                    @foreach($offense_option as $op)
                        <option value="{{ $op->id }}">{{ $op->title }}</option>
                    @endforeach
                    </select>
                </div>
                <div class="form-group col-span-6 sm:col-span-5">
                    <label>Pilih Kepatuhan</label>
                    <select class="mt-1 block w-full form-control shadow-none" name="logi">
                        <option value="">======= Pilih Opsi ========</option>
{{--                        <option value=1>1</option>--}}
{{--                        <option value=2>2</option>--}}
                    @foreach($addition_option as $ap)
                        <option value="{{ $ap->id }}">{{ $ap->title }}</option>
                    @endforeach
                    </select>
                </div>
                <div class="form-group col-span-6 sm:col-span-5"></div>
                <button type="submit" id="submit" class="btn btn-primary">Submit</button>

            </form>
        </div>
        <div>
            <x-data-table>
                <x-slot name="head">
                    <tr>
                        <th><a>Pelanggaran</a></th>
                        <th><a>Poin Pengurangan</a></th>
                        <th><a>Kepatuhan</a></th>
                        <th><a>Poin Penambahan</a></th>
                        <th><a>Total Poin</a></th>
                        <th>Action</th>
                    </tr>
                </x-slot>
                <x-slot name="body">
{{--                    {{dd($details)}}--}}
                    @foreach ($details as $m)
                        <tr>
{{--                            {{dd($m->offense->title)}}--}}
                            <td>{{ ($m->offense != NULL)? $m->offense->title: '-'}}</td>
                            <td>{{ ($m->offense != NULL)? $m->offense->minus_point:'-' }}</td>
                            <td>{{ ($m->addition != NULL)? $m->addition->title:'-'}}</td>
                            <td>{{ ($m->addition !=NULL)?$m-> addition->plus_point :'-' }}</td>
                            <td>{{ $m->current_point }}</td>
                            <td class="whitespace-no-wrap row-action--icon">
                                <form action="{{route('admin.student-detail.destroy', $m->id)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="fa fa-16px fa-trash text-red-500"></button>
                                </form>
{{--                                <a role="button" href="{{route('admin.student-detail.destroy', $m->id)}}"><i class="fa fa-16px fa-trash text-red-500"></i></a>--}}
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-data-table>
        </div>
    </div>
</x-app-layout>
