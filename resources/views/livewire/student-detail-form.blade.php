<div id="form-create" class=" card p-4">
{{--    {{dd("coba3")}}--}}
    <form wire:submit.prevent="{{ $action }}">

        <x-select :options="$offenseTypes" :selected="$student_detail['offense_id']" title="Pilih Pelangggaran" model="$studentDetail.offense_id"/>

        <x-select :options="$additionTypes" :selected="$student_detail['addition_id']" title="Pilih Kepatuhan" model="$studentDetail.addition_id"/>

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
                @foreach ($details as $m)
                    <tr>
                        <td>{{ $m->offense->title }}</td>
                        <td>{{ $m->offense->minus_point }}</td>
                        <td>{{ $m->addition->title }}</td>
                        <td>{{ $m->addition->plus_point }}</td>
                        <td>{{ $m->student->total }}</td>
                        <td class="whitespace-no-wrap row-action--icon">
                            <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="fa fa-16px fa-trash text-red-500"></i></a>
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-data-table>
    </div>

{{--Percobaan--}}
{{--@isset($details)--}}
{{--    <div>--}}
{{--        <x-data-table>--}}
{{--            <x-slot name="head">--}}
{{--                <tr>--}}
{{--                    <th><a>Pelanggaran</a></th>--}}
{{--                    <th><a>Poin Pengurangan</a></th>--}}
{{--                    <th><a>Kepatuhan</a></th>--}}
{{--                    <th><a>Poin Penambahan</a></th>--}}
{{--                    <th><a>Total Poin</a></th>--}}
{{--                    <th>Action</th>--}}
{{--                </tr>--}}
{{--            </x-slot>--}}
{{--            <x-slot name="body">--}}
{{--                @foreach ($details as $m)--}}
{{--                    <tr>--}}
{{--                        <td>{{ $m->offense->title }}</td>--}}
{{--                        <td>{{ $m->offense->minus_point }}</td>--}}
{{--                        <td>{{ $m->addition->title }}</td>--}}
{{--                        <td>{{ $m->addition->plus_point }}</td>--}}
{{--                        <td>{{ $m->student->total }}</td>--}}
{{--                        <td class="whitespace-no-wrap row-action--icon">--}}
{{--                            <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="fa fa-16px fa-trash text-red-500"></i></a>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
{{--            </x-slot>--}}
{{--        </x-data-table>--}}
{{--    </div>--}}
{{--@endisset--}}

{{--<script>--}}
{{--    document.addEventListener('livewire:load', function () {--}}
{{--        window.livewire.on('redirect', () => {--}}
{{--            setTimeout(function () {--}}
{{--                window.location.href = "{{route('admin.student-detail.edit')}}"; //will redirect to your blog page (an ex: blog.html)--}}
{{--            }, 2000); //will call the function after 2 secs.--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}
