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
              <h4>Kuisioner</h4>
              <div class="card-header-action">
                <a href="/kuisioner/create" class="btn btn-primary">
                  Buat Kuisioner Baru
                </a>
              </div>
            </div>
            <div class="card-body">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Soal</th>
                    <th scope="col">Jawaban Pertama</th>
                    <th scope="col">Jawaban Kedua</th>
                    <th scope="col">Jawaban Ketiga</th>
                    <th scope="col">Jawaban Keempat</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($kuisioner as $key => $row)
                    <tr>
                        <td>{{ $kuisioner->count() * ($kuisioner->currentPage() - 1) + $loop->iteration }}
                        </td>
                      <td>{{ $row->soal }}</td>
                      <td>{{ $row->jawaban_1 }}</td>
                      <td>{{ $row->jawaban_2 }}</td>
                      <td>{{ $row->jawaban_3 }}</td>
                      <td>{{ $row->jawaban_4 }}</td>
                      <td>
                         <div class="btn-group mb-3" role="group" aria-label="Basic example">
                          <a href="{{ route('kuisioner.edit',$row->id) }}" class="btn btn-info btn-sm">Ubah</a>
                          {{-- <form action="{{ route('kuisioner.destroy', $row->id) }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                          </form> --}}
                        </div>                     
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              {{ $kuisioner->links() }}
            </div>
          </div>
            
          
        </div>
        
      </div>
    </div>
  </section>
@endsection