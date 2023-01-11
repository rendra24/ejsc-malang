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

<body style="background-color:#c3e4e9;">

    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <div class="card my-5">
                    <img src="banner.jpeg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h4>DAFTAR PENGUNJUNG EJSC MALANG</h4>
                        <p>Data isian pada form ini akan dikeola oleh tim East Java Super Corridor (EJSC) sebagai bahan evaluasi. Mohon data berikut diisi seusai dengan keadaan/kondisi dari setiap pengunjung EJSC. Data inputan pengunjung akan selamannya bersifat rahasia dan tidak dijadikan sebagai konsumsi publik. Terima kasih!</p>
                        
                        @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        @endif

                        <form action="{{ route('anggota.store') }}" method="post">
                        @csrf
                        <div class="mb-3 form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                            name="nama" placeholder="Nama" value="{{ old('nama') }}" >
                            @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3 form-group">
                            <label>Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" 
                            name="email" placeholder="Email" value="{{ old('email') }}" >
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3 form-group">
                            <label>Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" 
                            name="username" placeholder="Username" value="{{ old('username') }}" >
                            @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3 form-group">
                            <label>Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                            name="password" placeholder="Password" value="{{ old('password') }}" >
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label>Ulangi Password</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                            name="password_confirmation"  required>
                            @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="usia" class="form-label">Usia (Age)</label>
                            <select name="usia" id="" class="form-control @error('usia') is-invalid @enderror" id="usia">
                                <option value="">Pilih Usia</option>
                                @foreach($usia as $row)
                                <option value="{{ $row['value'] }}">{{ $row['text'] }}</option>
                                @endforeach
                            </select>
                            @error('usia')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kelamin">Jenis Kelamin</label><br>
                            <label><input type="radio" name="jenis_kelamin" value="L"> Laki - Laki
                                (Male)</label><br>
                            <label><input type="radio" name="jenis_kelamin" value="P"> Perempuan
                                (Female)</label>
                        </div>
                        <div class="mb-3">
                            <label for="telp" class="form-label">Nomor Hp (Phone Number)</label>
                            <input type="number" name="telp" class="form-control @error('telp') is-invalid @enderror" id="telp" placeholder="Telephone">
                            @error('telp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="sosial_media" class="form-label">Nama akun Sosial Media</label>
                            <input type="text" name="sosial_media" class="form-control @error('sosial_media') is-invalid @enderror" id="telp" placeholder="Nama Akun Sosial Media">
                            @error('sosial_media')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="profesi" class="form-label">Profesi</label>
                            <select name="profesi_id" id="" class="form-control @error('profesi_id') is-invalid @enderror" id="profesi">
                                <option value="">Pilih Profesi</option>
                                @foreach($profesi as $key => $value)
                                <option value="{{ $value->id }}">{{ $value->nama_profesi }}</option>
                                @endforeach
                            </select>
                            @error('profesi_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="domisili" class="form-label">Domisili</label>
                            <select name="domisili" id="" class="form-control select2 @error('domisili') is-invalid @enderror" id="domisili">
                                <option value="">Pilih Domisili</option>
                                @foreach($wilayah as $row)
                                                @if(old('domisili') == $row->kode)
                                                <option value="{{ $row->kode }}" selected>{{ $row->nama }}</option>
                                                @else
                                                <option value="{{ $row->kode }}">{{ $row->nama }}</option>
                                                @endif
                                            @endforeach
                            </select>
                            @error('domisili')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="mengetahui_ejsc" class="form-label">Dari siapa atau media apakah yang mengetahui
                                tentang EJSC
                                (East Java Super Corridor)</label>
                            <select name="mengetahui_ejsc" id="" class="form-control @error('mengetahui_ejsc') is-invalid @enderror" id="domisili">
                                <option value="">Mengetahui tentang EJSC</option>
                                <option value="1">Sosial Media: Instagram, Twitter , Facebook dan Sejenisnya</option>
                                <option value="2">Media Publikasi: Poster, Brosur, Pamflet, dan Sejenisnya</option>
                                <option value="3">Rekomendasi Teman</option>
                                <option value="4">Undangan</option>
                            </select>
                            @error('mengetahui_ejsc')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" class="btn btn-primary">Kirim / Daftar</button>
                            <hr>
                            <a href="{{ route('penggunjung') }}" type="button" class="btn btn-info text-white">Buku Penggunjung EJSC</a>
                        </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
    $('.select2').select2();
});
</script>
</body>

</html>