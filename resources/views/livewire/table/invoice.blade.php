<div>
    <x-data-table :data="$data" :model="$invoices">
        {{ $getId = intval(substr(url()->current(), -12)) }}
{{--        {{ $customer_invoices = \App\Models\Invoice::whereCustomerId($getId)->get() }}--}}
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('id')" role="button" href="#">
                    Invoice ID
                    @include('components.sort-icon', ['field' => 'id'])
                </a></th>
                <th><a wire:click.prevent="sortBy('selected_date')" role="button" href="#">
                    Bulan
                    @include('components.sort-icon', ['field' => 'selected_date'])
                </a></th>
                <th><a wire:click.prevent="sortBy('status')" role="button" href="#">
                        Status
                        @include('components.sort-icon', ['field' => 'status'])
                    </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
                @foreach ($invoices as $i)
                    @if($i->customer_id == $getId)
                        <tr x-data="window.__controller.dataTableController({{ $i->id }})">
                            <td>{{ $i->id }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($i->selected_date)->translatedFormat('F') }}
                            </td>
                            <td>
                                @if($i->status == 'paid')
                                    <div class="badge badge-success">Lunas</div>
                                @endif
                                @if($i->status == 'unpaid')
                                    <div class="badge badge-danger">Belum Dibayar</div>
                                @endif
                            </td>
                            <td>
                                <a role="button" href="{{ route('admin.generate_invoice', $i->id) }}" class="btn btn-success" target="_blank"><i class="fa fa-16px fa-print"></i> Cetak</a>
                                <a role="button" x-on:click.prevent="deleteItem" href="#" class="btn btn-danger"><i class="fa fa-16px fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                    @endif

                @endforeach
        </x-slot>
    </x-data-table>
</div>
