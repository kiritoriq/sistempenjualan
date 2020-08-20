<?php
    $sekarang = date('Y-m-d');

    // $barang = \DB::table('mast_barang')
    //         ->join('tb_barang_inout','mast_barang.kd_barang','tb_barang_inout.kd_brg')
    //         ->select('tb_barang_inout.masuk as beli','tb_barang_inout.tgl as tanggal','mast_barang.*')
    //         ->where('tb_barang_inout.tgl', $sekarang)
    //         ->get();
    $barang = \DB::table('tb_barang_inout')
            ->leftjoin('tb_dtl_transaksi','tb_barang_inout.kd_brg','=','tb_dtl_transaksi.kd_brg')
            ->select('tb_barang_inout.*','tb_dtl_transaksi.harga','tb_dtl_transaksi.nama_brg')
            // ->where('id_mast_barang')
            ->where('tb_barang_inout.id_mast_barang',null)
            ->where('tb_barang_inout.tgl', $sekarang)
            ->groupBy('tb_barang_inout.kd_brg')
            ->get();
    // $bulanini = month($barang->tgl);
?>
<section class="content-header">
    <h1>
        Laporanpenjualan<small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!!url()!!}"> Dashboard</a></li>
        <li class="active">Laporanpenjualan</li>
    </ol>
</section>
<section class="content">
    <div class="box nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab1">Harian</a></li>
            <li><a data-toggle="tab" href="#tab2">Bulanan</a></li>
        </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab1">
            <div class="table-responsive">
            <div class="box-body no-padding">
                <table class="table table-striped table-hover table-condensed table-bordered" id='tabel'>
                    <thead class="bg-primary">
                        <tr>
                            <th>Kode Transaksi</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Barang Keluar</th>
                            <th>Harga</th>
                            <th>Tanggal</th>
                    <!-- <th>user_id</th> -->

                        
                        </tr>
                    </thead>   
                    <tbody>
                    @foreach($barang as $b)
                    <?php
                        $nama = substr($b->nama_brg, 7);
                    ?>
                    <tr>
                        <td>{!!$b->kd_transk!!}</td>
                        <td>{!!$b->kd_brg!!}</td>
                        <td>{!!$nama!!}</td>
                        <td>{!!$b->keluar!!}</td>
                        <td>{!!$b->harga!!}</td>
                        <td>{!!$b->tgl!!}</td>

                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <p style="height: 50px;">&nbsp;</p>
            </div>
        </div>
        <div class="tab-pane" id="tab2">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('bulan','Pilih Bulan:',array('class'=>'col-sm-3 control-label')) !!}
                        <div class="col-sm-6">
                            {!! select_bulan('bulan') !!}
                        </div>
                        <div class="col-sm-3">
                            <button type="button" class="btn btn-primary" id="prosesbulan">Proses</button>
                        </div>
                    </div>
                </div>
            </div>
            <p style="height: 50px;">&nbsp;</p>
        <div class="row" id="result">
            
        </div>
        </div>
    </div>
    </div>
</section>         

<script>
    function refresh_page(){
        <?php
        echo 'var index_page=laravel_base + "/'.\Request::path().'";';
        ?>
        $.ajax({
            url : index_page,
            type : 'GET',
            beforeSend: function(){
                $('#loading-state').fadeIn("slow");
            },
            success:function(html){
                $('#loading-state').fadeOut("slow");
                $('#utama').html(html);
            }
        });
    }
    
    $(document).ready(function(){
        $('.pagination').addClass('pagination-sm no-margin pull-right');
        $('.checkme,.checkall').on('change',function(){
            if($(this).is(':checked'))
                $('#deleteall').fadeIn(300);
            else
                $('#deleteall').fadeOut(300);
        });

        $('#prosesbulan').on('click',function(e){
            e.preventDefault();
            var bulan = $('#bulan').val();
            // alert(bulan);
            $.ajax({
                url: '{{url()}}/laporan/laporanpenjualan/data',
                type: 'POST',
                data: { 'bulan': bulan,'_token':'{!!csrf_token()!!}'},
                success:function(html){
                    $('#result').html(html);
                }
            });
        });

        $('#buat').on('click',function(e){
            e.preventDefault();
            $.ajax({
                url : $(this).attr('href'),
                //url : laravel_base + '/' + $(this).attr('href'),
                type : 'get',
                beforeSend: function(){
                    $('#loading-state').fadeIn("slow");
                },
                success:function(html){
                    $('#loading-state').fadeOut("slow");
                    $('#utama').html(html);
                }
            });
        });

        <?php
        echo 'var index_page=laravel_base + "/'.\Request::path().'";';
        ?>

        $('#tabel').on('click','#hapus',function(e){
            e.preventDefault();
            var $this =$(this);
            bootbox.confirm('Hapus?',function(a){
                if(a == true){
                    $.ajax({
                        url : index_page + '/delete',
                        type : 'post',
                        data: {'id' : $this.attr('recid'), '_token' : '{!!csrf_token()!!}'},
                        beforeSend: function(){
                            $('#loading-state').fadeIn("slow");
                        },
                        success:function(html){
                            $('#loading-state').fadeOut("slow");
                            if(html=='9'){
                                notification('Berhasil Dihapus','success');
                                $this.closest('tr').fadeOut(300,function(){
                                    $(this).remove();
                                });
                            }else{
                                notification(html,'danger');
                            }
                        }
                    });
                }
            });
        });
        $('#tabel').on('click','#edit',function(e){
            e.preventDefault();
            var $this =$(this);
            bootbox.confirm('Edit?',function(a){
                if(a == true){
                    $.ajax({
                        url : index_page + '/edit',
                        type : 'get',
                        data:'id=' + $this.attr('recid'),
                        beforeSend: function(){
                            $('#loading-state').fadeIn("slow");
                        },
                        success:function(html){
                            $('#loading-state').fadeOut("slow");
                            $('#utama').html(html);
                        }
                    });
                }
            });
        });
        $('#cari').on('submit',function(e){
            e.preventDefault();
            $.ajax({
                url : $(this).attr('action'),
                data:$(this).serialize(),
                type : 'get',
                beforeSend: function(){
                    $('#loading-state').fadeIn("slow");
                },
                success:function(html){
                    $('#loading-state').fadeOut("slow");
                    $('#utama').html(html);
                }
            });
        });
        $('#data').on('submit',function(e){
            e.preventDefault();
            var iki = $(this);
            bootbox.confirm('Hapus?',function(r){
                if(r){
                    $.ajax({
                        url : iki.attr('action') + '/delete',
                        type : 'post',
                        data:iki.serialize(),
                        beforeSend: function(){
                            $('#loading-state').fadeIn("slow");
                        },
                        success:function(html){
                            $('#loading-state').fadeOut("slow");
                            notification(html,'success');
                            iki.find('input[type=checkbox]').each(function (t){
                                if($(this).is(':checked')){
                                    $(this).closest('tr').fadeOut(100)                                        
                                }
                            });
                            $('#deleteall').fadeOut(300);
                        }
                    });
                }
            });            
        });
    });
</script>
