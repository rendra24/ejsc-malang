@extends('layouts.main')

@section('container')


  <section class="section">
    <div class="section-header">
      <h1>Dashboard</h1>
    </div>
      <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
              <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Talenta EJSC Malang</h4>
              </div>
              <div class="card-body">
                {{ $total_anggota }}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
              <i class="far fa-newspaper"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Input SKM</h4>
              </div>
              <div class="card-body">
                {{ $total_skm }}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
              <i class="far fa-file"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Penggunjung</h4>
              </div>
              <div class="card-body">
                {{ $total_pengunjung }}
              </div>
            </div>
          </div>
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
                          <div class="col-12 col-md-6 col-lg-6">
                              <div class="card">
                              <div class="card-header" style="padding: 10px 8px;font-size:10px;line-height: 20px;min-height:81px;">
                                  Indikator Profesi Penggunjung
                              </div>
                              <div class="card-body" style="padding: 5px;">
                                  <canvas id="myChart_profesi"></canvas>
                              </div>
                              </div>
                          </div>
                  </div>
              </div>
            </div>
            
          </div>
          
        </div>
      </div>
  </section>

  @push('custom-scripts')
  <script>
    
var ctx = document.getElementById("myChart_profesi").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    datasets: [{
      data: [
        @foreach($indikator_profesi as $row)
        {{ $row['total'] }},
        @endforeach
      ],
      backgroundColor: [
        @foreach($indikator_profesi as $row)
        '{{ $row['colors'] }}',
        @endforeach
      ],
      label: 'Dataset 1'
    }],
    labels: [
      @foreach($indikator_profesi as  $row)
      '{{ ucfirst(strtolower($row['profesi'])) }}',
      @endforeach
    ],
  },
  options: {
    responsive: true,
    legend: {
      position: 'bottom',
    },
  }
});
  </script>
  @endpush
  @endsection