@extends('layouts.main')

@section('container')
<section class="section">
    <div class="section-header">
      <h1>Survei Kepuasan Penggunjung</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item">Survei Kepuasan Penggunjung</div>
      </div>
    </div>

    <div class="section-body">
      
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">

          <div class="card">
            <div class="card-header">
              Survei Kepuasan Penggunjung
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($indikator as $key => $row)
                        <div class="col-12 col-md-4 col-lg-4">
                            <div class="card">
                            <div class="card-header" style="padding: 10px 8px;font-size:10px;line-height: 20px;min-height:81px;">
                                {{ ucfirst(strtolower($row->kuisioner->soal)) }}
                            </div>
                            <div class="card-body" style="padding: 5px;">
                                <canvas id="myChart{{ $key }}"></canvas>
                            </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
          </div>
            
          
        </div>
        
      </div>
    </div>
  </section>


  @push('custom-scripts')
  <script>
    @foreach($indikator as $key => $row)
var ctx = document.getElementById("myChart{{ $key }}").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    datasets: [{
      data: [
        {{ $row->total_jawaban_4 }},
        {{ $row->total_jawaban_2 }},
        {{ $row->total_jawaban_1 }},
        {{ $row->total_jawaban_3 }},
      ],
      backgroundColor: [
        
        '#63ed7a',
        '#ffa426',
        '#fc544b',
        '#6777ef',
      ],
      label: 'Dataset 1'
    }],
    labels: [
      '{{ ucfirst(strtolower($row->kuisioner->jawaban_4)) }}',
      '{{ ucfirst(strtolower($row->kuisioner->jawaban_2)) }}',
      '{{ ucfirst(strtolower($row->kuisioner->jawaban_1)) }}',
      '{{ ucfirst(strtolower($row->kuisioner->jawaban_3)) }}'
    ],
  },
  options: {
    responsive: true,
    legend: {
      position: 'bottom',
    },
  }
});
@endforeach
  </script>
  @endpush
@endsection