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
              <h4>Anggota</h4>
            </div>
            <div class="card-body">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Telp</th>
                    <th scope="col">Usia</th>
                    <th scope="col">Profesi</th>
                    <th scope="col">Kelamin</th>
                    {{-- <th scope="col">Action</th> --}}
                  </tr>
                </thead>
                <tbody>
                    @foreach($anggotas as $key => $row)
                    <tr>
                        <td>{{ $anggotas->count() * ($anggotas->currentPage() - 1) + $loop->iteration }}
                        </td>
                      <td>{{ $row->nama }}</td>
                      <td>{{ $row->telp }}</td>
                      <td>{{ $row->usia }}</td>
                      <td>{{ $row->profesi->nama_profesi }}</td>
                      <td>{{ ($row->jenis_kelamin == 'L') ? 'Laki - Laki' : 'Perempuan' }}</td>
                      {{--<td>
                         <div class="btn-group mb-3" role="group" aria-label="Basic example">
                          <a href="{{ route('anggota.edit',$row->id) }}" class="btn btn-info btn-sm">Update</a>
                          <form action="{{ route('anggota.destroy', $row->id) }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                          </form>
                        </div>                     
                      </td>--}}
                    </tr>
                    @endforeach
                </tbody>
              </table>
              {{ $anggotas->links() }}
            </div>
          </div>
            
          
        </div>
        
      </div>
    </div>
  </section>
@endsection