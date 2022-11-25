@extends('layouts.main')

@section('container')
<section class="section">
    <div class="section-header">
        <h1>Profesi</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Profesi</div>
        </div>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Profesi</h4>
                    </div>
                    <div class="card-body">



                        <form action="{{ isset($profesi) ? route('profesi.update',$profesi->id) : route('profesi.store')  }}" method="post">
                            @csrf
                            @if(isset($profesi))
                                @method('PUT')
                            @endif

                            <div class="row">
                                <div class="col-md-12 col-lg-6">

                                    <div class="form-group">
                                        <label>Nama Profesi</label>
                                        <input type="text" class="form-control @error('nama_profesi') is-invalid @enderror" 
                                        name="nama_profesi" value="{{ old('nama_profesi', $profesi->nama_profesi ?? '') }}" autofocus>
                                        @error('nama_profesi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Colors</label>
                                        <div class="input-group colorpickerinput colorpicker-element" data-colorpicker-id="2">
                                          <input type="text" class="form-control" id="colorIp" name="colors">
                                          <div class="input-group-append">
                                            <div class="input-group-text">
                                              <i class="fas fa-fill-drip"></i>
                                            </div>
                                          </div>
                                        </div>
                                      </div>

                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>



                    </div>
                </div>


            </div>

        </div>
    </div>
</section>
@push('custom-scripts')
<script>
    $(".colorpickerinput").colorpicker({
        format: 'hex',
        component: '.input-group-append',
    });

    @if($profesi->colors)
    $("#colorIp").val("{{ $profesi->colors }}");
    $("#colorIp").trigger('change');
    @endif
    
</script>
@endpush
@endsection
