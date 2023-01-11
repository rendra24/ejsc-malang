<table>
    <tr>
        <td colspan="7" align="center" style="font-size:12px;font-weight:bold;">Data Penggunjung Per Tanggal {{ $tanggal_awal }} Sampai {{ $tanggal_akhir }}</td>
    </tr>
    <tr>
        <th style="text-align:center;font-size: 11px;font-weight: bold;">No</th>
        <th style="text-align:center;font-size: 11px;font-weight: bold;">Tanggal</th>
        <th style="text-align:center;font-size: 11px;font-weight: bold;">Nama Penggunjung</th>
        <th style="text-align:center;font-size: 11px;font-weight: bold;">Dari siapa atau media apakah anda mengetahui tentang East Java Super Corridor (EJSC)?</th>
        <th style="text-align:center;font-size: 11px;font-weight: bold;">Nomor HP</th>
        <th style="text-align:center;font-size: 11px;font-weight: bold;">Sosial Media</th>
        <th style="text-align:center;font-size: 11px;font-weight: bold;">Bidang Keahlian / Profesi</th>
        <th style="text-align:center;font-size: 11px;font-weight: bold;">Domisili</th>
        <th style="text-align:center;font-size: 11px;font-weight: bold;">Jenis Kelamin</th>
        <th style="text-align:center;font-size: 11px;font-weight: bold;">Umur</th>
        <th style="text-align:center;font-size: 11px;font-weight: bold;">Tujuan</th>
        <th style="text-align:center;font-size: 11px;font-weight: bold;">Email</th>
    </tr>
    
    <tbody>
    @foreach($aktifitas  as $key => $row)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $row['tanggal_kunjungan'] }}</td>
            <td>{{ $row['nama_penggunjung'] }}</td>
            <td>{{ $row['menggetahui'] }}</td>
            <td>{{ $row['telp'] }}</td>
            <td>{{ $row['sosial_media'] }}</td>
            <td>{{ $row['profesi'] }}</td>
            <td>{{ $row['domisili'] }}</td>
            <td>{{ $row['jenis_kelamin'] }}</td>
            <td>{{ $row['umur'] }}</td>
            <td>{{ $row['tujuan'] }}</td>
            <td>{{ $row['email'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>