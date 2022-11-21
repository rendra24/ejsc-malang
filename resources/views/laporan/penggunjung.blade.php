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
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Profesi</th>
                    <th scope="col">Domisili</th>
                    <th scope="col">Tujuan / Keperluan</th>
                  </tr>
                </thead>
                <tbody>
                   @foreach($aktifitas as $key => $row)
                        <tr>
                            <td>{{ $aktifitas->count() * ($aktifitas->currentPage() - 1) + $loop->iteration }}</td>
                            <td>{{ $helper::changeDateTimeFormat($row->created_at, 'd M Y H:i') }}</td>
                            <td>{{ $row->anggota->nama }}</td>
                            <td>{{ $row->anggota->profesi->nama_profesi }}</td>
                            <td>{{ $helper::get_wilayah($row->anggota->domisili) }}</td>
                            <td>{{ $row->tujuan }}</td>
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
@endsection