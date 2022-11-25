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
              <h4>Profesi</h4>
              <div class="card-header-action">
                <a href="/profesi/create" class="btn btn-primary">
                  Buat Profesi Baru
                </a>
              </div>
            </div>
            <div class="card-body">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Colors</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($profesi as $key => $row)
                    <tr>
                        <td>{{ $profesi->count() * ($profesi->currentPage() - 1) + $loop->iteration }}
                        </td>
                      <td>{{ $row->nama_profesi }}</td>
                      <td><span class="colorinput-color" style="background-color: {{ $row->colors }}"></span></td>
                      <td>
                         <div class="btn-group mb-3" role="group" aria-label="Basic example">
                          <a href="{{ route('profesi.edit',$row->id) }}" class="btn btn-info btn-sm">Ubah</a>
                          <form action="{{ route('profesi.destroy', $row->id) }}" method="post" class="d-inline">
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
              {{ $profesi->links() }}
            </div>
          </div>
            
          
        </div>
        
      </div>
    </div>
  </section>
@endsection