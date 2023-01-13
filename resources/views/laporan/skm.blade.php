@extends('layouts.main')

@section('container')
<section class="section">
    <div class="section-header">
      <h1>Survei Kepuasan Penggunjung</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item">Survei Kepuasan Penggunjung</div>
      </div>
    </div>

    <div class="section-body">

      @if(session()->has('success'))
      <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
          <button class="close" data-dismiss="alert">
            <span>×</span>
          </button>
          {{ session('success') }}
        </div>
      </div>
      @endif
      

      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">

          <div class="card">
            <div class="card-header">
              <h4>Survei Kepuasan Penggunjung</h4>
            </div>
            <div class="card-body">

              <form action="{{ route('laporan.skm') }}" method="GET">
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label>Cari SKM Per Tanggal</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fas fa-calendar"></i>
                          </div>
                        </div>
                        <input type="text" name="tanggal" class="form-control daterange-cus">
                        <div class="input-group-append">
                          <button class="btn btn-primary" type="submit">Cari</button>
                        </div>
                        <div class="input-group-append">
                          <button class="btn btn-danger" onclick="window.location = '{{ route('laporan.skm')}}'" type="button">Reset</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 text-right"><br>
                    @if(isset($tanggal_awal))
                      <a href="{{ route('export.skm', ['tanggal_awal' => $tanggal_awal, 'tanggal_akhir' => $tanggal_akhir]); }}" class="btn btn-success mt-3">
                        <i class="fa-solid fa-file-excel"></i> Export Excel
                      </a>
                    
                    @endif
                  </div>
                </div>
                </form>


              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Nama</th>
                    <th scope="col">JK</th>
                    <th scope="col">Pendidikan</th>
                    <th scope="col">Sekolah / Universitas</th>
                    <th scope="col">Tujuan / Kegiatan</th>
                    {{-- <th scope="col">Action</th> --}}
                  </tr>
                </thead>
                <tbody>
                   @foreach($skm as $key => $row)
                        <tr>
                            <td>{{ $key + 1; }}</td>
                            <td>{{ date('d-m-Y', strtotime($row['created_at'])); }}</td>
                            <td>{{ $row['nama'] }}</td>
                            <td>{{ $row['jenis_kelamin'] }}</td>
                            <td>{{ $row['pendidikan_terkahir'] }}</td>
                            <td>{{ $row['nama_instansi'] }}</td>
                            <td>{{ $row['tujuan']['nama_tujuan'] }}</td>
                            {{-- <td>
                         <div class="btn-group mb-3" role="group" aria-label="Basic example">
                          <form action="{{ route('laporan.destroy_skm', $row->id) }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                          </form>
                        </div>                     
                      </td> --}}
                        </tr>
                   @endforeach
                </tbody>
              </table>
              
            </div>
          </div>
            
          
        </div>
        
      </div>
    </div>
  </section>

  @push('custom-scripts')
  <script>
    $('.daterange-cus').daterangepicker({
      locale: {format: 'YYYY-MM-DD'},
      drops: 'down',
      opens: 'right'
    });
  </script>
@endpush
@endsection