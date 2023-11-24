<div>
    <div>
        <div class="search">
            <div class="search-bar">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                          <input wire:model="cari" class="col-lg-10 form-control" type="text" name="search" placeholder="Cari Nama atau NIM" >

{{--                            {{$content->count()}}--}}
                            <br>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
    @foreach($students as $c)
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch" >
                <div class="icon-box">
{{--                    <div class="image-preview"><img src="{{ asset('storage/img/student/'.$c->thumbnail) }}" class="img-fluid" alt="">--}}
{{--                    </div>--}}
{{--                    <h4><a href="{{ route('blog-show', $c->id) }}">{{ $c->title }}</a></h4>--}}
                    <h4><a href="{{ route('point-detail', [$c->id]) }}">{{ $c->name }}</a></h4>
                    <h5>{{ $c->nim }}</h5>
                    <br>
{{--                    <p>Poin {{ $c->point }}</p>--}}
                </div>
            </div>
    @endforeach

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 text-center">
                        {{$students->onEachSide(1)->links()}}
                    </div>
                </div>
            </div>

    </div>
</div>
