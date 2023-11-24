<div id="form-create" class=" card p-4">
    <form wire:submit.prevent="{{ $action }}">

        <x-input type="text" title="Nama" model="student.name"/>

        <x-input type="text" title="NIM" model="student.nim"/>

        <x-input type="text" title="Tahun Masuk" model="student.entry_year"/>

        <x-select :options="$optionStudy" :selected="$student['study_program']" title="Program Studi" model="student.study_program"/>

        <x-input type="text" title="Kelompok" model="student.category"/>

        <x-input type="number" title="Poin" model="student.point"/>

        <div class="form-group col-span-6 sm:col-span-5"></div>
        <button type="submit" id="submit" class="btn btn-primary">Submit</button>

    </form>
</div>

<script>
    document.addEventListener('livewire:load', function () {
        window.livewire.on('redirect', () => {
            setTimeout(function () {
                window.location.href = "{{route('admin.student.index')}}"; //will redirect to your blog page (an ex: blog.html)
            }, 2000); //will call the function after 2 secs.
        });
    });
</script>
