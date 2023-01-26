@extends('layouts.main')

@section('container')
<section class="section">
    <div class="section-header">
        <h1>Kuisioner</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Kuisioner</div>
        </div>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Kuisioner</h4>
                    </div>
                    <div class="card-body">



                        <form action="{{ isset($kuisioner) ? route('kuisioner.update',$kuisioner->id) : route('kuisioner.store')  }}" method="post">
                            @csrf
                            @if(isset($kuisioner))
                                @method('PUT')
                            @endif

                            <div class="row">
                                <div class="col-md-12 col-lg-6">

                                    <div class="form-group">
                                        <label>Soal</label>
                                        <textarea  class="form-control @error('soal') is-invalid @enderror" 
                                        name="soal">{{ old('soal', $kuisioner->soal ?? '') }}</textarea>
                                        @error('soal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Jawaban Pertama</label>
                                        <input type="text" class="form-control @error('jawaban_1') is-invalid @enderror" 
                                        name="jawaban_1" value="{{ old('jawaban_1', $kuisioner->jawaban_1 ?? '') }}">
                                        @error('jawaban_1')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Jawaban Kedua</label>
                                        <input type="text" class="form-control @error('jawaban_2') is-invalid @enderror" 
                                        name="jawaban_2" value="{{ old('jawaban_2', $kuisioner->jawaban_2 ?? '') }}">
                                        @error('jawaban_2')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Jawaban Ketiga</label>
                                        <input type="text" class="form-control @error('jawaban_3') is-invalid @enderror" 
                                        name="jawaban_3" value="{{ old('jawaban_3', $kuisioner->jawaban_3 ?? '') }}">
                                        @error('jawaban_3')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Jawaban Keempat</label>
                                        <input type="text" class="form-control @error('jawaban_4') is-invalid @enderror" 
                                        name="jawaban_4" value="{{ old('jawaban_4', $kuisioner->jawaban_4 ?? '') }}">
                                        @error('jawaban_4')
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
