<div>
    <x-data-table :data="$data" :model="$customers">
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('id')" role="button" href="#">
                        ID
                        @include('components.sort-icon', ['field' => 'id'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('name')" role="button" href="#">
                        Nama
                        @include('components.sort-icon', ['field' => 'name'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                        Status
                        @include('components.sort-icon', ['field' => 'created_at'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('address')" role="button" href="#">
                        Alamat
                        @include('components.sort-icon', ['field' => 'address'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('location_picture')" role="button" href="#">
                        Tagihan
                        @include('components.sort-icon', ['field' => 'location_picture'])
                    </a></th>

                <th>Peta</th>

                <th>Action</th>

                <th>Pembayaran</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($customers as $m)
                <tr x-data="window.__controller.dataTableController({{ $m->id }})">
                    <td>{{ $m->id }}</td>
                    <td>{{ $m->name }}</td>
                    <td>
                        @if($m->status == 'paid')
                            <div class="badge badge-success">Lunas</div>
                        @endif
                        @if($m->status == 'unpaid')
                                <div class="badge badge-danger">Belum Lunas</div>
                            @endif
                    </td>
                    {{--                    <td>{{ \Carbon\Carbon::parse($m->created_at)->format('d-m-Y') }}</td>--}}
                    {{--                    <td>{{ date_diff(\Carbon\Carbon::now()->toDate(), DateTime::createFromFormat('Y-m-d', $m->registration_date))->format("%a Hari") }}</td>--}}
                    <td>{{ $m->address }}</td>
                    <td>
{{--                        <img src="{{ asset('storage/img/location_picture/'.$m->location_picture) }}" alt=""--}}
{{--                             style="width: 100px"></td>--}}
                        @if(($m->bill * $m->amount) == 0)
                            -
                        @endif
                        @if(($m->bill * $m->amount) > 0)
                            {{ $m->bill * $m->amount }} ({{$m->amount}})
                        @endif

                    <td>
                        <iframe width="300" height="100"
                                src="https://maps.google.com/maps?q={{$m->longitude}},{{$m->latitude}}&output=embed"
                                class="mr-3" target="_blank">
                        </iframe>
                    </td>

                    <td class="whitespace-no-wrap row-action--icon">
                        {{--                        <a role="button" href="https://maps.google.com/maps?q={{$m->latitude}},{{$m->longitude}}&output=embed" class="mr-3" target="_blank"><i class="fa fa-16px fa-map text-green-500"></i></a>--}}
                        <a role="button" href="https://wa.me/{{'62'.substr($m->phone_number, 1)}}" class="mr-3"
                           target="_blank"><i class="fa fa-16px fa-phone text-green-500"></i></a>
                        <a role="button" href="{{route('admin.customer.edit', $m->id)}}" class="mr-3"><i
                                class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#" class="mr-3"><i
                                class="fa fa-16px fa-trash text-red-500"></i></a>
                        {{--                        <a role="button" href="{{route('admin.student-detail.edit', $m->id)}}">edit-1<i class="fa fa-16px fa-user"></i></a>--}}
                    </td>
                    <td>
                        <a class="btn btn-success trigger--fire-modal-5" id="modal-5" href="{{route('admin.invoice', $m->id)}}">Tambah</a>
                        <a class="btn btn-primary trigger--fire-modal-5" id="modal-5" href="{{route('admin.payment', $m->id)}}">Bayar</a>
{{--                        <button wire.click="editModal()">--}}
{{--                            Bayar--}}
{{--                        </button>--}}
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
{{--    <x-jet-dialog-modal wire.model="editingModal">--}}
{{--        <x-slot name="title">--}}
{{--            BAYARANEEE--}}
{{--        </x-slot>--}}

{{--        <x-slot name="content">--}}
{{--            THIS IS CONTENT--}}
{{--        </x-slot>--}}

{{--        <x-slot name="footer">--}}
{{--            INI FOOTERNYA--}}
{{--        </x-slot>--}}
{{--    </x-jet-dialog-modal>--}}
</div>
