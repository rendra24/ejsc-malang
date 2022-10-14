<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
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
                                <option value="kurang_15">
                                    < 15 Tahun</option>
                                <option value="15_24">15 - 24 Tahun</option>
                                <option value="25_34">25 - 34 Tahun</option>
                                <option value="35_44">35 - 44 Tahun</option>
                                <option value="44_54">44 - 54 Tahun</option>
                                <option value="lebih_55">> 55 Tahun</option>
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
                            <select name="profesi" id="" class="form-control @error('profesi') is-invalid @enderror" id="profesi">
                                <option value="">Pilih Profesi</option>
                                <option value="1">Mahasiswa/Pelajar (Student)</option>
                                <option value="2">Aparatur Sipil Negara (Civil Servant/Civil Service Employee)</option>
                                <option value="3">Karyawan (Corporate Employee)</option>
                                <option value="4">Mentor EJSC/MJC</option>
                                <option value="5">Talenta MJC</option>
                                <option value="6">Wirausahawan/ Wiraswasta/ Usahawan (Enterpreneur)</option>
                                <option value="7">Umum (Citizen)</option>
                                <option value="8">UMKM</option>
                            </select>
                            @error('profesi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="domisili" class="form-label">Domisili</label>
                            <select name="domisili" id="" class="form-control @error('domisili') is-invalid @enderror" id="domisili">
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
                                <option value="1">Mengetahui tentang EJSC</option>
                                <option value="2">Sosial Media: Instagram, Twitter , Facebook dan Sejenisnya</option>
                                <option value="3">Media Publikasi: Poster, Brosur, Pamflet, dan Sejenisnya</option>
                                <option value="4">Rekomendasi Teman</option>
                                <option value="5">Undangan</option>
                            </select>
                            @error('mengetahui_ejsc')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-info">Kirim</button>
                        </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</body>

</html>