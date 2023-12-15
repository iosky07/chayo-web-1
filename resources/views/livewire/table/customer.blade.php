<div>
    <x-data-table :data="$data" :model="$customers">
{{--        {{ dd($customers) }}--}}
{{--        {{ $unpaid = \App\Models\Invoice::whereCustomerId($m->id)->whereStatus('unpaid')->count() }}--}}
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
{{--                             style="width: 100px"></td>--}}{{--                        {{ dd($m->bill) }}--}}
                        @if(($m->bill * \App\Models\Invoice::whereCustomerId($m->id)->whereStatus('unpaid')->count()) == 0)
                            -
                        @elseif(($m->bill * \App\Models\Invoice::whereCustomerId($m->id)->whereStatus('unpaid')->count()) > 0)
                            {{ $m->bill * \App\Models\Invoice::whereCustomerId($m->id)->whereStatus('unpaid')->count() }} ({{\App\Models\Invoice::whereCustomerId($m->id)->whereStatus('unpaid')->count()}})
                        @endif

                    <td>
                        <iframe width="300" height="100"
                                src="https://maps.google.com/maps?q={{$m->longitude}},{{$m->latitude}}&output=embed"
                                class="mr-3" target="_blank">
                        </iframe>
                    </td>

                    <td>
                        <ul class="navbar-nav navbar-right">
                            <li class="dropdown"><a href="#" data-turbolinks="false" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                    <div class="d-sm-none d-lg-inline-block"><i class="fa fa-16px fa-user"></i></div></a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="https://wa.me/{{'62'.substr($m->phone_number, 1)}}" class="dropdown-item has-icon" target="_blank"><i class="fa fa-16px fa-phone"> </i> Whatsapp</a>
                                    <a href="{{route('admin.customer.edit', $m->id)}}" class="dropdown-item has-icon"><i class="fa fa-16px fa-pen"></i> Edit</a>
                                    <a x-on:click.prevent="deleteItem" href="#" class="dropdown-item has-icon"><i class="fa fa-16px fa-trash"></i> Hapus</a>
                                </div>
                            </li>
                        </ul>
                    </td>
                    <td>
                        <a class="btn btn-success trigger--fire-modal-5" href="{{ route('admin.index_with_id', $m->id) }}">Invoice</a>
                        <a class="btn btn-primary trigger--fire-modal-5" x-on:click.prevent="addPayment" href="#">Bayar</a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
