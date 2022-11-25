@extends('layouts.main')

@section('container')
<section class="section">
    <div class="section-header">
      <h1>Tujuan</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item">Tujuan</div>
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
              <h4>Tujuan</h4>
              <div class="card-header-action">
                <a href="/tujuan/create" class="btn btn-primary">
                  Buat Tujuan Baru
                </a>
              </div>
            </div>
            <div class="card-body">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($tujuan as $key => $row)
                    <tr>
                        <td>{{ $tujuan->count() * ($tujuan->currentPage() - 1) + $loop->iteration }}
                        </td>
                      <td>{{ $row->nama_tujuan }}</td>
                      <td>
                         <div class="btn-group mb-3" role="group" aria-label="Basic example">
                          <a href="{{ route('tujuan.edit',$row->id) }}" class="btn btn-info btn-sm">Ubah</a>
                          <form action="{{ route('tujuan.destroy', $row->id) }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                          </form>
                        </div>                     
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              {{ $tujuan->links() }}
            </div>
          </div>
            
          
        </div>
        
      </div>
    </div>
  </section>
@endsection