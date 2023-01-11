<?php
  namespace App\Helpers;
  use Illuminate\Support\Facades\DB;

  class GlobalHelper {

    public static function changeDateFormate($date,$date_format)
    {

        setlocale(LC_ALL, 'IND');
        return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format($date_format);    
    }

    public static function changeDateTimeFormat($date,$date_format)
    {

        setlocale(LC_ALL, 'IND');
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format($date_format);    
    }

    public static function currency_IDR($value, $satuan)
    {
      return $satuan . number_format($value, 0, '.', '.');
    }

    public static function formatActive($value)
    {
        if($value == '1'){
            $status = '<span class="badge badge-primary">Aktif</span>';
        }else{
            $status = '<span class="badge badge-light">Non Aktif</span>';
        }

        return $status;
    }

    



    public static function get_wilayah( $kode )
    {
        $data = DB::table('wilayah')

        ->where('kode', $kode )->first();

        return $data->nama;

    }

    public static function get_mengetahui($id){
        $data = [
            1 => 'Sosial Media: Instagram, Twitter , Facebook dan Sejenisnya',
            2 => 'Media Publikasi: Poster, Brosur, Pamflet, dan Sejenisnya',
            3 => 'Rekomendasi Teman',
            4 => 'Undangan'
        ][$id];

        return $data;
    }
 
}