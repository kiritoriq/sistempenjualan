{!!View::make('home::dashboard.header')!!}
{!!View::make('home::dashboard.sidebar-left')!!}

<script>
$(document).ready(function(){
    $('#loading-state').delay(1000).fadeOut();	
    
    $(function () {
        $('#container').highcharts({
            data: {
                table: 'datatable',
                endRow: 9
            },
            chart: {
                type: 'column'
            },
            title: {
                text: 'STATISTIK PORTAL '
            },
            yAxis: {
                allowDecimals: false,
                title: {
                    text: 'JUMLAH PENDAFTAR'
                }
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.series.name + '</b><br/>' +
                        this.point.y + ' ' + this.point.name.toLowerCase();
                }
            }
        });
    });
});
	
</script>

<style>
#chartdiv {
  width: 100%;
  height: 500px;
}	

#loading-state {
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,.7);
    position: fixed;
    z-index: 2000;
    display: nones;
}

.loadings {
    position: relative;
    /*left:46%; */
    top:45%;
    color: white;
}
</style>

<div id="loading-state">
    <p class='loadings' align='center'>
        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>            
    </p>
</div>
    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" id='utama'>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Version 2.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      

      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-fw fa-stethoscope"></i></span>

                <div class="info-box-content">
                  <span class="info-box-number">PROFESI BIDAN</span>
                  <span class="info-box-text">Pendaftar : <b>12</b></span>
                  <span class="info-box-text">Aktivasi : <b>12</b></span>
                </div>
                <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
                <span class="info-box-icon bg-aqua-active"><i class="fa fa-fw fa-stethoscope"></i></span>

                <div class="info-box-content">
                  <span class="info-box-number">PROFESI NERS</span>
                  <span class="info-box-text">Pendaftar : <b>12</b></span>
                  <span class="info-box-text">Aktivasi : <b>12</b></span>
                </div>
                <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
                <span class="info-box-icon bg-yellow-active"><i class="fa fa-fw fa-stethoscope"></i></span>

                <div class="info-box-content">
                  <span class="info-box-number">JALUR PMDP</span>
                  <span class="info-box-text">Pendaftar : <b>12</b></span>
                  <span class="info-box-text">Aktivasi : <b>12</b></span>
                </div>
                <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-fw fa-stethoscope"></i></span>

                <div class="info-box-content">
                  <span class="info-box-number">JALUR UMUM</span>
                  <span class="info-box-text">Pendaftar : <b>12</b></span>
                  <span class="info-box-text">Aktivasi : <b>12</b></span>
                </div>
                <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
        
        <div class="col-md-12">
<!--          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Tugumuda Framework 3 (Laravel 5.1)</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
             /.box-header 
            <div class="box-body">
                Main Content Here 				
               /.row 
            </div>
             ./box-body 

          </div>-->
		  <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Statistik Pendaftaran</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
                <div class="box-body">

                    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>            
                        <table id='datatable' class='table table-striped table-hover table-condensed sortable'>                
                            <thead class="bg-green">
                                <tr>
                                    <th align="left">JALUR PENDAFTARAN</th>
                                    <th class="text-center">PENDAFTAR</th>
                                    <th class="text-center">AKTIVASI</th>                                
                                </tr>
                            </thead>
                            <tbody>                                
                                <tr>
                                    <td>PROFESI BIDAN</td>
                                    <td class="text-center">7</td>
                                    <td class="text-center">12</td>                                    
                                </tr>                                                                
                                <tr>                                                                        
                                    <td>PROFESI NERS</td>
                                    <td class="text-center">2</td>
                                    <td class="text-center">5</td>                                    
                                </tr>                                                                
                                <tr>                                                                                                            
                                    <td>PMDP</td>
                                    <td class="text-center">8</td>
                                    <td class="text-center">10</td>                                    
                                </tr>                                                                
                                <tr>                                                                                                            
                                    <td>UMUM</td>
                                    <td class="text-center">5</td>
                                    <td class="text-center">8</td> 
                                </tr>                                                                
                                <tr>                                    
                                    <td>MANDIRI</td>
                                    <td class="text-center">8</td>
                                    <td class="text-center">9</td> 
                                </tr>
                                <tr>                                                                                                            
                                    <td>MAGISTER</td>
                                    <td class="text-center">1</td>
                                    <td class="text-center">2</td> 
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
              <!-- /.row -->
            </div>
            <!-- ./box-body -->

          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


{!!View::make('home::dashboard.footer')!!}


