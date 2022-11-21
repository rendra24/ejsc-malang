@extends('layouts.main')

@section('container')
<section class="section">
    <div class="section-header">
      <h1>Laporan Kritik & Saran</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item">Laporan Kritik & Saran</div>
      </div>
    </div>

    <div class="section-body">
      

      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">

          <div class="card">
            <div class="card-header">
              <h4>Laporan Kritik & Saran</h4>
            </div>
            <div class="card-body">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tahun</th>
                    <th scope="col">Sekolah / Universitas</th>
                    <th scope="col">Kritik dan Saran</th>
                    <th scope="col">Pelatihan yang di harapakan</th>
                  </tr>
                </thead>
                <tbody>
                   @foreach($skm as $key => $row)
                        <tr>
                            <td>{{ $skm->count() * ($skm->currentPage() - 1) + $loop->iteration }}</td>
                            <td>{{ $helper::changeDateTimeFormat($row->created_at, 'M Y') }}</td>
                            <td>{{ $row->pendidikan_terkahir }}</td>
                            <td>{{ $row->kritik_saran }}</td>
                            <td>{{ $row->masukkan_pelatihan }}</td>
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