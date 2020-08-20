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
                text: ''
            },
            yAxis: {
                allowDecimals: false,
                title: {
                    text: 'JUMLAH TRANSAKSI'
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

<?php
  $barang = \DB::table('mast_barang')
          ->select('*')
          ->orderBy('kd_barang','asc')
          ->get();
  // foreach($barang as $b){
  //   $kode = $b->kd_barang;    
  // }        
  //   $hasil = $kode[0];

    $makanmasuk = \DB::table('tb_barang_inout')
          ->where('kd_brg', 'LIKE', 'BA%')
          ->sum('masuk');
    $makankeluar = \DB::table('tb_barang_inout')
          ->where('kd_brg', 'LIKE', 'BA%')
          ->sum('keluar');

    $minummasuk = \DB::table('tb_barang_inout')
          ->where('kd_brg', 'LIKE', 'BB%')
          ->sum('masuk');
    $minumkeluar = \DB::table('tb_barang_inout')
          ->where('kd_brg', 'LIKE', 'BB%')
          ->sum('keluar'); 

    $sembakomasuk = \DB::table('tb_barang_inout')
          ->where('kd_brg', 'LIKE', 'BC%')
          ->sum('masuk');
    $sembakokeluar = \DB::table('tb_barang_inout')
          ->where('kd_brg', 'LIKE', 'BC%')
          ->sum('keluar');   
      // foreach($stokmakan as $stok)
      // {
      //   $jml = $stok->masuk;
      // }
    // $hasil = $jml;
?>

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
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-fw fa-cutlery"></i></span>

                <div class="info-box-content">
                  <span class="info-box-number">Makanan</span>
                  <span class="info-box-text">Pembelian : <b>{{$makanmasuk}}</b></span>
                  <span class="info-box-text">Penjualan : <b>{{$makankeluar}}</b></span>
                </div>
                <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
                <span class="info-box-icon bg-aqua-active"><i class="fa fa-fw fa-glass"></i></span>

                <div class="info-box-content">
                  <span class="info-box-number">Minuman</span>
                  <span class="info-box-text">Pembelian : <b>{{$minummasuk}}</b></span>
                  <span class="info-box-text">Penjualan : <b>{{$minumkeluar}}</b></span>
                </div>
                <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
                <span class="info-box-icon bg-yellow-active"><i class="fa fa-fw fa-balance-scale"></i></span>

                <div class="info-box-content">
                  <span class="info-box-number">Sembako</span>
                  <span class="info-box-text">Pembelian : <b>{{$sembakomasuk}}</b></span>
                  <span class="info-box-text">Penjualan : <b>{{$sembakokeluar}}</b></span>
                </div>
                <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>
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
		  <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Statistik Transaksi</h3>

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
                                    <th align="left">Jenis Barang</th>
                                    <th class="text-center">PEMBELIAN</th>
                                    <th class="text-center">PENJUALAN</th>                                
                                </tr>
                            </thead>
                            <tbody>                                
                                <tr>
                                    <td>MAKANAN</td>
                                    <td class="text-center">{{$makanmasuk}}</td>
                                    <td class="text-center">{{$makankeluar}}</td>                                    
                                </tr>                                                                
                                <tr>
                                    <td>MINUMAN</td>
                                    <td class="text-center">{{$minummasuk}}</td>
                                    <td class="text-center">{{$minumkeluar}}</td>                                    
                                </tr>                                                                
                                <tr>
                                    <td>SEMBAKO</td>
                                    <td class="text-center">{{$sembakomasuk}}</td>
                                    <td class="text-center">{{$sembakokeluar}}</td>                                    
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


