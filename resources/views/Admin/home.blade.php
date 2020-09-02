@extends('adminlte::page')

@section('title', 'Panel')
@section('plugins.Chartjs', true)
@section('content_header')
<div class="row">
  <div class="col-md-6">
    <h1> Dashboard</h1>
  </div>
    <div class="col-md-6">
      <form method="GET">
         <select onChange="this.form.submit()" name="interval"class="float-md-right">
          <option {{$dateInterval == 30? 'selected="seleceted"': ''}} value="30">Lasts 30 days</option>
          <option {{$dateInterval == 60? 'selected="seleceted"': ''}} value="60">Lasts 60 days</option>
        </select>
      </form>
  </div>
</div>

@endsection

@section('content')

<div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$visits}}</h3>

                <p>Visits</p>
              </div>
              <div class="icon">
                <i class="far fa-fw fa-eye"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$onlineUsers}}</h3>

                <p>Online Users</p>
              </div>
              <div class="icon">
                <i class="far fa-fw fa-heart"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$pages}}</h3>

                <p>Pages</p>
              </div>
              <div class="icon">
                <i class="far fa-fw fa-sticky-note"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$users}}</h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="far fa-fw fa-user"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>

        <!-- Chart -->
        <div class="row">
            <div class="card card-primary col-6">
                <div class="card-header">
                    <h3 class="card-title">Pages more visted</h3>

                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                    <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 430px;" width="430" height="250" class="chartjs-render-monitor"></canvas>                    </div>
                </div>
                
                <!-- /.card-body -->
                </div>
                    <div class="card card-primary col-6">
                    <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">About System</h3>

                        <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                          <p> Lorem ipsum dolor sit amet, sit ea partem lucilius philosophia. Vel cu sale blandit, enim ignota omnesque qui ne, commodo numquam fabellas nam ei. Sea tractatos corrumpit definitiones eu. Eum ne augue populo, no est quodsi rationibus voluptatibus. Nusquam vituperata nam an, ei convenire principes referrentur quo.</p>

                          <p>Laudem aliquip officiis ad eos. Has latine gloriatur ea. Regione percipit eos ad. Mei nullam atomorum no. An tale ocurreret definitiones mel, prima autem nostrud sed et. Ut cum movet constituto.</p>

                          <p>Ad vero brute ornatus pri, et pri legimus detracto. Et congue prodesset vis. Per et legendos vulputate. Sea sale nullam sadipscing ex, an sed vidit debitis deterruisset. In commune oporteat constituto per, sea an munere euismod legendos, pro te omnis quaestio platonem. Eam viris verear luptatum ut, nec simul numquam similique in.</p>
                        </div>
                    </div>
                <!-- /.card-body -->
                </div>
        </div>
<script>
window.onload = function(){
    let ctx = document.getElementById('pieChart').getContext('2d');
    window.areaChart = new Chart(ctx,{
        type:'pie',
        data:{
            datasets:[{
                data:{{$pageValues}},
                backgroundColor: '#0000FF'
            }],
            labels:{!!$pageLabels!!}
        },
        options:{
            responsive:true,
            legend:{
                display:false
            }
        }
    });
}
</script>

@endsection