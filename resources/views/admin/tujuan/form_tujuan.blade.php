@extends('layouts.main')

@section('container')
<section class="section">
    <div class="section-header">
        <h1>User</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">User</div>
        </div>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Tujuan</h4>
                    </div>
                    <div class="card-body">



                        <form action="{{ isset($tujuan) ? route('tujuan.update',$tujuan->id) : route('tujuan.store')  }}" method="post">
                            @csrf
                            @if(isset($tujuan))
                                @method('PUT')
                            @endif

                            <div class="row">
                                <div class="col-md-12 col-lg-6">

                                    <div class="form-group">
                                        <label>Nama Tujuan</label>
                                        <input type="text" class="form-control @error('nama_tujuan') is-invalid @enderror" 
                                        name="nama_tujuan" value="{{ old('nama_tujuan', $tujuan->nama_tujuan ?? '') }}" autofocus>
                                        @error('nama_tujuan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
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

@endsection
