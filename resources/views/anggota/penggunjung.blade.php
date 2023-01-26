<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pendaftaran Member EJSC Malang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .select2-container--default .select2-selection--single
    {
    height: 38px;
    padding: 5px 5px;
    border: 1px solid #ced4da;
    }
</style>
</head>

<body style="background-color: #c3e4e9;">
    <section class="vh-100" >
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
              <div class="card shadow-2-strong" style="border-radius: 1rem;">
                <img src="banner.jpeg" class="card-img-top" alt="...">
                <div class="card-body p-5">
                  @if(session()->has('success'))
                  <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                      {{ session('success') }}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  @endif
      
                  @if(session()->has('error'))
                  <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                      {{ session('error') }}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  @endif
                <form action="{{ route('anggota.penggunjung') }}" method="post">
                    @csrf
                  <h3 class="mb-4 text-center">Form Penggunjung</h3>
      
                  <div class="form-outline mb-2">
                      <label class="form-label" for="username">Username</label>
                      <input type="text" name="username" id="username" class="form-control" />
                  </div>
      
                  <div class="form-outline mb-2">
                      <label class="form-label" for="typePasswordX-2">Password</label>
                    <input type="password" name="password" id="typePasswordX-2" class="form-control" />
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label" for="tujuan-2">Tujuan</label>
                    <select name="tujuan_id" id="tujuan-2" class="form-control">
                        <option value="">Pilih Tujuan</option>
                        @foreach($tujuan as $row)
                            <option value="{{ $row->id }}">{{ $row->nama_tujuan }}</option>
                        @endforeach
                    </select>
                  </div>

                  @foreach($kuisioner as $key => $row)
                            
                  <div class="mb-3 form-group">
                      <label class="mb-3">{{ $row->soal }}</label>
                      <div class="form-check">
                      <label>
                          <input type="radio" class="form-check-input" name="soal_{{$loop->iteration}}" value="jawaban_1" id="jawaban_1{{ $loop->iteration }}">
                          <label class="form-check-label" for="jawaban_1{{ $loop->iteration }}">
                              {{ $row->jawaban_1 }}
                            </label>
                      </label>
                      </div>
                      <div class="form-check">
                          <label>
                              <input type="radio" class="form-check-input" name="soal_{{$loop->iteration}}" value="jawaban_2" id="jawaban_2{{ $loop->iteration }}">
                              <label class="form-check-label" for="jawaban_2{{ $loop->iteration }}">
                                  {{ $row->jawaban_2 }}
                                </label>
                          </label>
                      </div>

                      <div class="form-check">
                          <label>
                              <input type="radio" class="form-check-input" name="soal_{{$loop->iteration}}" value="jawaban_3" id="jawaban_3{{ $loop->iteration }}">
                              <label class="form-check-label" for="jawaban_3{{ $loop->iteration }}">
                                  {{ $row->jawaban_3 }}
                                </label>
                          </label>
                      </div>

                      <div class="form-check">
                          <label>
                              <input type="radio" class="form-check-input" name="soal_{{$loop->iteration}}" value="jawaban_4" id="jawaban_4{{ $loop->iteration }}" {{ (old('soal_'.$loop->iteration) == $row->jawaban_4) ? 'checked' : '' }}>
                              <label class="form-check-label" for="jawaban_4{{ $loop->iteration }}">
                                  {{ $row->jawaban_4 }}
                                </label>
                          </label>
                      </div>

                      @error('soal_'.$loop->iteration)
                      <p class="text-danger">
                          {{ $message }}
                      </p>
                      @enderror
                  </div>

                  @endforeach
                
                <div class="d-grid gap-2">
                    <button class="btn btn-primary" type="submit">Kirim</button>
                    <hr>
                    <a href="{{ route('daftar') }}" type="button" class="btn btn-info text-white">Register Penggunjung</a>
                </div>

            </form>

          
      
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
</body>

</html>