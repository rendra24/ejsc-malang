@extends('layouts.main')

@section('container')
<section class="section">
    <div class="section-header">
      <h1>Laporan Penggunjung</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item">Laporan Penggunjung</div>
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
              <h4>Penggunjung Hari Ini</h4>
            </div>
            <div class="card-body">

              <form action="{{ route('laporan.penggunjung') }}" method="GET">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label>Cari Penggunjung Per Tanggal</label>
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
                        <button class="btn btn-danger" onclick="window.location = '{{ route('laporan.penggunjung')}}'" type="button">Reset</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 text-right"><br>
                  @if(isset($tanggal_awal))
                    <a href="{{ route('export.penggunjung', ['tanggal_awal' => $tanggal_awal, 'tanggal_akhir' => $tanggal_akhir]); }}" class="btn btn-success mt-3">
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
                    <th scope="col">Tanggal Kunjungan</th>
                    <th scope="col">Nama Penggunjung</th>
                    <th scope="col">Profesi</th>
                    <th scope="col">Domisili</th>
                    <th scope="col">Tujuan / Keperluan</th>
                  </tr>
                </thead>
                <tbody>
                   @foreach($aktifitas as $key => $row)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $helper::changeDateTimeFormat($row['tanggal_kunjungan'], 'd M Y H:i') }}</td>
                            <td>{{ $row['nama_penggunjung'] }}</td>
                            <td>{{ $row['profesi'] }}</td>
                            <td>{{ $row['domisili'] }}</td>
                            <td>{{ $row['tujuan'] }}</td>
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