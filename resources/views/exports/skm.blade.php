<table border="1">
    <tr>
        <td colspan="10" align="center" style="font-size:12px;font-weight:bold;">Data SKM Per Tanggal {{ $tanggal_awal }} Sampai {{ $tanggal_akhir }}</td>
    </tr>
    <tr>
        <th style="text-align:center;font-size: 11px;font-weight: bold;">No</th>
        <th style="text-align:center;font-size: 11px;font-weight: bold;">Timestamp</th>
        <th style="text-align:center;font-size: 11px;font-weight: bold;">NAMA</th>
        <th style="text-align:center;font-size: 11px;font-weight: bold;">SEKOLAH / UNIVERSITAS / KOMUNITAS</th>
        <th style="text-align:center;font-size: 11px;font-weight: bold;">JENIS KELAMIN</th>
        <th style="text-align:center;font-size: 11px;font-weight: bold;">USIA</th>
        <th style="text-align:center;font-size: 11px;font-weight: bold;">PENDIDIKAN TERAKHIR</th>
        <th style="text-align:center;font-size: 11px;font-weight: bold;">PEKERJAAN</th>
        @foreach($kuisioner as $value)
            <th style="text-align:center;font-size: 11px;font-weight: bold;">{{ $value->soal }}</th>
        @endforeach
        <th style="text-align:center;font-size: 11px;font-weight: bold;">PELATIHAN APA YANG ANDA HARAPKAN ADA DI EJSC MALANG</th>
        <th style="text-align:center;font-size: 11px;font-weight: bold;">KRITIK DAN SARAN UNTUK PENINGKATAN LAYANAN DI EJSC MALANG</th>
        
        
    </tr>
    
    <tbody>
    @foreach($skm  as $key => $row)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $row['timetimes'] }}</td>
            <td>{{ $row['nama'] }}</td>
            <td>{{ $row['nama_instansi'] }}</td>
            <td>{{ $row['jenis_kelamin'] }}</td>
            <td>{{ $row['umur'] }}</td>
            <td>{{ $row['pendidikan_terkahir'] }}</td>
            <td>{{ $row['pekerjaan'] }}</td>
            @foreach($row['anggota_skm'] as $value)
                <td>{{ $value->jawaban_value }}</td>
            @endforeach
            <td>{{ $row['masukkan_pelatihan'] }}</td>
            <td>{{ $row['kritik_saran'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>