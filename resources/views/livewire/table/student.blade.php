<div>
    <x-data-table :data="$data" :model="$students">
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
                <th><a wire:click.prevent="sortBy('division')" role="button" href="#">
                    NIM
                    @include('components.sort-icon', ['field' => 'nim'])
                </a></th>
                <th><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                    Kelompok
                    @include('components.sort-icon', ['field' => 'category'])
                </a></th>
{{--                <th><a wire:click.prevent="sortBy('position')" role="button" href="#">--}}
{{--                    Program Studi--}}
{{--                    @include('components.sort-icon', ['field' => 'study_program'])--}}
{{--                </a></th>--}}
                <th><a wire:click.prevent="sortBy('position')" role="button" href="#">
                    Total Poin
                    @include('components.sort-icon', ['field' => 'point'])
                </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($students as $m)
                <tr x-data="window.__controller.dataTableController({{ $m->id }})">
                    <td>{{ $m->id }}</td>
                    <td>{{ $m->name }}</td>
                    <td>{{ $m->nim }}</td>
                    <td>{{ $m->category }}</td>
                    <td>{{ $m->point }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="{{route('admin.student.edit', $m->id)}}" class="mr-3">edit<i class="fa fa-16px fa-pen"></i></a>
{{--                        <a role="button" x-on:click.prevent="deleteItem" href="#" class="mr-3"><i class="fa fa-16px fa-trash text-red-500"></i></a>--}}
                        <a role="button" href="{{route('admin.student-detail.edit', $m->id)}}">edit-1<i class="fa fa-16px fa-user"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
