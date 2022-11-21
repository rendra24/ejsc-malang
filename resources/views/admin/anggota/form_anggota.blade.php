@extends('layouts.main')

@section('container')
<section class="section">
    <div class="section-header">
        <h1>Anggota</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Anggota</div>
        </div>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Buat Anggota</h4>
                    </div>
                    <div class="card-body">



                        <form action="{{ isset($anggota) ? route('anggota.update',$anggota->id) : "/anggota"  }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @if(isset($anggota))
                                @method('PUT')
                            @endif

                            <div class="row">
                                <div class="col-md-12 col-lg-6">

                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                        name="nama" value="{{ old('nama', $anggota->nama ?? '') }}" autofocus>
                                        @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>No Telp</label>
                                        <input type="number" class="form-control @error('telp') is-invalid @enderror" 
                                        name="telp" value="{{ old('telp', $anggota->telp ?? '') }}">
                                        @error('telp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                        name="alamat">{{ old('alamat', $anggota->alamat ?? '') }}</textarea>
                                        @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Jadwal Keberangkatan</label>
                                        <select name="jadwal_id" class="form-control @error('jadwal_id') is-invalid @enderror" name="jadwal_id">
                                            <option value="">Pilih Tanggal</option>
                                            @foreach($keberangkatan as $value)

                                            @if(old('jadwal_id', $anggota->jadwal_id ?? '') == $value['id'])
                                            <option value="{{ $value['id'] }}" selected>{{ $value['tgl_berangkat'] }}</option>
                                            @else
                                            <option value="{{ $value['id'] }}">{{ $value['tgl_berangkat'] }}</option>
                                            @endif

                                            @endforeach
                                        </select>

                                        @error('jadwal_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Cabang</label>
                                        <select name="cabang_id" id="" class="form-control form_cabang">
                                           <option value="">Pilih Cabang</option>
                                           @foreach($cabang as $row)

                                            @if(old('cabang_id', $anggota->cabang_id ?? '') == $row->id)
                                            <option value="{{ $row->id }}" selected>{{ $row->nama_cabang }}</option>
                                            @else
                                            <option value="{{ $row->id }}">{{ $row->nama_cabang }}</option>
                                            @endif

                                            @endforeach
                                        </select>

                                        @error('cabang_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                  


                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Provinsi</label>
                                        <select name="provinsi_id" id="" class="form-control" 
                                        onchange="get_wilayah($(this).val(), 'kabupaten', 'form_kota')">
                                            @foreach($provinsi as $prov)

                                            @if(old('provinsi_id', $provinsi_id ?? '') == $prov->kode)
                                            <option value="{{ $prov->kode }}" selected>{{ $prov->nama }}</option>
                                            @else
                                            <option value="{{ $prov->kode }}">{{ $prov->nama }}</option>
                                            @endif

                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>kabupaten / Kota</label>
                                        <select name="kota_id" id="" class="form-control form_kota" onchange="get_wilayah($(this).val(), 'kecamatan', 'form_kecamatan')">
                                           <option value="">Pilih Kab/Kota</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Kecamatan</label>
                                        <select name="kecamatan_id" id="" class="form-control form_kecamatan" onchange="get_wilayah($(this).val(), 'desa', 'form_kelurahan')">
                                           <option value="">Pilih Kecamatan</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Kelurahan</label>
                                        <select name="kelurahan_id" id="" class="form-control form_kelurahan @error('kelurahan_id') is-invalid @enderror">
                                           <option value="">Pilih Kelurahan</option>
                                        </select>
                                        @error('kelurahan_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>KTP</label>
                                            <input type="file" class="form-control @error('ktp') is-invalid @enderror" name="ktp">
                                          
                                          @error('ktp')
                                          <div class="invalid-feedback">
                                              {{ $message }}
                                          </div>
                                          @enderror
                                    </div>
                                    
                                    @if(isset($anggota->ktp))
                                        <img src="{{ assets($anggota->ktp) }}" alt="" style="width:200px;height:auto;">
                                    @endif
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Save & Publish</button>
                        </form>



                    </div>
                </div>


            </div>

        </div>
    </div>
</section>

@if(isset($provinsi_id))
<script>
    $(document).ready(function() {
         get_wilayah({{ $provinsi_id }}, 'kabupaten', 'form_kota', '{{ "$provinsi_id.$kota_id" }}');
         get_wilayah('{{ "$provinsi_id.$kota_id" }}', 'kecamatan', 'form_kecamatan', '{{ "$provinsi_id.$kota_id.$kecamatan_id" }}');
         get_wilayah('{{ "$provinsi_id.$kota_id.$kecamatan_id" }}', 'desa', 'form_kelurahan', '{{ "$provinsi_id.$kota_id.$kecamatan_id.$kelurahan_id" }}');

        

        
    })
</script>
@endif

@endsection
