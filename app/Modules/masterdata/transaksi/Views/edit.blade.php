<?php
    $pelanggan = \DB::table('tb_pelanggan')
                ->select('nama_plg')
                ->where('no_plg',$transaksi->no_plg)
                ->first();

    $detail = \DB::table('tb_dtl_transaksi')
            ->select('kd_brg','nama_brg','hrg_satuan','qty','diskon','harga')
            ->where('kd_transk',$transaksi->kd_transk)
            ->get();

    // $no += 1;
?>
<section class="content-header">
    <h1>
        Detail Transaksi<small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!!url()!!}"> Dashboard</a></li>
        <li><a href="#" id="back"> Transaksi</a></li>
        <li class="active">Detail Transaksi</li>
    </ol>
</section>
<section class="content">
  <div class="box box-danger">
    <?php
      $rpos = strrpos(\Request::path(), '/'); 
      $uri = substr(\Request::path(), 0, $rpos);
    ?>
    <div class="row">
      <div class="col-md-12">
        {!! Form::model($transaksi, array('url' => $uri, 'method' => 'POST', 'class'=>'form-horizontal form-'.\Config::get('claravel::ajax') ,'id'=>'simpan')) !!}
        {!! Form::hidden('id', $transaksi->id) !!}
        <div class="box-body">
          <div class="form-group">
            {!! Form::label('tgl','Tanggal:',array('class'=>'col-sm-3 control-label')) !!}
            <div class="col-sm-4">
              {!! Form::text('tgl', $transaksi->tgl, array('class'=> 'form-control','readonly'=>'')) !!}
              <!-- {--{!! date_picker('tgl', $transaksi->tgl) !!}--} -->
            </div>
          </div>
          <hr class="no-padding" style="margin-top: 20px !important; margin-bottom: 10px !important;">
          <div class="row">
          <div class="col-md-6">
            <div class="form-group">
             {!! Form::label('kd_transk', 'Kode Transaksi:', array('class' => 'col-sm-3 control-label')) !!}
              <div class="col-sm-7">
                <!-- <select id="id_transk" class="transk"></select> -->
                {!! Form::text('kd_transk', $transaksi->kd_transk, array('class'=> 'form-control','readonly'=>'')) !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('kd_kasir', 'Kode Kasir:', array('class' => 'col-sm-3 control-label')) !!}
              <div class="col-sm-4">
                {!! Form::text('kd_kasir', $transaksi->kd_kasir, array('class'=> 'form-control','readonly'=>'')) !!}
              </div>
              <div class="col-sm-4">
                {!! Form::text('nama_kasir', $transaksi->nama_kasir, array('class'=> 'form-control','readonly'=>'')) !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('no_plg', 'Kode Pelanggan:', array('class' => 'col-sm-3 control-label')) !!}
              <div class="col-sm-4">
                {!! Form::text('no_plg', $transaksi->no_plg, array('class'=> 'form-control','readonly'=>'')) !!}
              </div>
              <div class="col-sm-4">
                {!! Form::text('nama_plg', $pelanggan->nama_plg, ['class'=>'form-control nama', 'readonly'=>'']) !!}
              </div>
            </div>    
        </div>
        <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('totalharga', 'Total:', array('class' => 'col-sm-3 control-label')) !!}
              <div class="col-sm-7">
                {!! Form::text('totalharga', $transaksi->totalharga, array('class'=>'form-control','readonly'=>'')) !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('totalbayar', 'Bayar:', array('class' => 'col-sm-3 control-label')) !!}
              <div class="col-sm-7">
                {!! Form::text('totalbayar', $transaksi->totalbayar, array('class'=>'form-control','readonly'=>'')) !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('kembali', 'Kembali:', array('class' => 'col-sm-3 control-label')) !!}
              <div class="col-sm-7">
                {!! Form::text('kembali', $transaksi->kembali, array('class'=>'form-control','readonly'=>'')) !!}
              </div>
            </div>
        </div>
      </div>
      <hr class="no-padding" style="margin-top: 20px !important; margin-bottom: 10px !important;">
      <div class="row">
        <div class="col-md-12" style="margin-top:10px">
            <table class="table table-striped table-hover table-condensed" id='tabel_rincian'>
                    <thead style="color:black;">
                    <tr>
                        <!-- <th style="text-align: center;">#</th> -->
                        <th style="text-align: center;">No.</th>
                        <th style="text-align: left;">Kode Barang</th>
                        <th style="text-align: left;">Nama Barang</th>
                        <!-- <th style="text-align: center;"></th> -->
                        <th style="text-align: center;">Harga Satuan</th>
                        <!-- <th style="text-align: center;"></th> -->
                        <th style="text-align: center;">Jumlah</th>
                        <th style="text-align: center;">Diskon (%)</th>
                        <th style="text-align: center;">Total</th>
                    </tr>
                    </thead>   
                    <tbody>
                      <?php
                        $no = 1;
                      ?>
                      @foreach($detail as $key=>$barang)
                        @if(!empty($barang->kd_brg))
                            <tr>
                            <!-- <td style="text-align: center;width: 25px">
                                <a class="text-danger delete_rincian" style="cursor:pointer"><i class="fa fa-times-circle"></i></a>
                                
                            </td> -->
                            <td style="text-align:right;" class="nomor_tabel">
                              {{$no}}
                              <input type="hidden" name="kode_barang[]" value="{{$barang->kd_brg}}">
                                <input type="hidden" name="nama_barang[]" value="{{$barang->nama_brg}}">
                                <!-- <input type="hidden" name="jumlah[]" value="{{$barang->qty}}"> -->
                                <input type="hidden" name="total[]" value="{{$barang->harga}}">
                            </td>
                            <td>{{$barang->kd_brg}}</td>
                            <td>{{$barang->nama_brg}}</td>
                            <td style="text-align:right"><span class="number">{{$barang->hrg_satuan}}</span>
                                <input type="hidden" name="hargasatuan[]" value="{{$barang->hrg_satuan}}">
                            </td>
                            <td style="text-align:center;"><span class="number">{{$barang->qty}}</span>
                              <input type="hidden" name="jumlah[]" class="biaya_jumlah" value="{{$barang->qty}}">
                          </td>
                          <td style="text-align: center;"><span class="number">{{$barang->diskon}}</span>
                            <input type="hidden" name="diskon[]" class="diskon" value="{{$barang->diskon}}">
                          </td>
                          <td style="text-align:right">
                            <span class="total number">{{$barang->harga}}</span>
                          </td>
                          <?php
                            $no++;
                          ?>
                            <!-- <input type="text" name="totalbayar" class="totalbayar"> -->
                        @endif
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="6" style="text-align: right;font-weight: bold">Total</td>
                        <td id="total_tabel" class="number" style="text-align: right;font-weight: bold">
                          {{$transaksi->totalharga}}
                        </td>
                        <input type="hidden" name="totals_tabel" id="totals_tabel" value="{{$transaksi->total}}">
                      </tr>
                    </tfoot>
                </table>
                <div class="col-sm-offset-10">
                    <a target="_blank" id="print" href="{{url()}}/masterdata/transaksi/cetak/{{$transaksi->kd_transk}}" class="btn btn-success"><i class="fa fa-print"></i> Cetak</a>
                </div>
        </div>
      </div>

  </div>
        <div class="box-footer">
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-7">
                    <!-- <button id="tombol_simpan" type="button" class="btn btn-success"><i class="fa fa-floppy-o"></i> Simpan</button> -->
                    &nbsp;
                    &nbsp;
                    <a class="btn btn-warning" id="batalkan" href=""><i class="fa fa-times-circle-o"></i> Kembali</a>
                    <!-- {--{!! ClaravelHelpers::btnCancelEdit() !!}--} -->
                </div>
            </div> 
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</section>
	
<script>
  var biaya = {
    id : null,
    kode : null,
    nama: null,
    hargasatuan : null,
    diskon : null,
    jumlah : null,
    total : null,
    bayar : null,
    kembalian : null,
  };
  var temptotal=0;
  var total_tabel_countable=0;
  var total_tabel_persen=0;
  var tabel_diskon = 0;
    function refresh_page(){
        <?php
        $index_page = explode('/', \Request::path());
        $jum = count($index_page) -1;
        unset ($index_page[$jum]);
        $index = join('/', $index_page);
        echo 'var index_page=laravel_base + "/'.$index.'";';
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
        $('#batalkan,#back').on('click',function(e){
            e.preventDefault();
            refresh_page();
        });
        $('#simpan').validationEngine();
        $('#tombol_simpan').on('click',function(e){
            var $this = $('#simpan');
            e.preventDefault();
            if($this.validationEngine('validate')){
                bootbox.confirm('Simpan data?',function(a){
                    if (a == true){
                        $.ajax({
                            url : '{!! url()."/masterdata/transaksi/simpanedit" !!}',
                            type : 'POST',
                            data : $this.serialize()+"&total_tabel_countable="+total_tabel_countable,
                            beforeSend: function(){
                                preloader.on();
                            },
                            success:function(response){
                                if(response.success){
                                    notification(response.message,'success');
                                    refresh_page();
                                }else{
                                    notification(response.message,'danger');
                                }
                            },
                        complete: function(){
                            $('#loading-state').fadeOut("slow");   
                        }
                        });
                    }
                });
            }
        });
        $('#kd_barang').on('change',function(){
      // console.log($('option:selected',this).attr('dtvalue'));
      biaya.id += 1;
      biaya.kode = $('option:selected',this).attr('value');
      biaya.nama = $('option:selected',this).attr('title');
      biaya.hargasatuan = parseInt($('option:selected',this).attr('dtvalue')); 
      $('#hrgjual').val(biaya.hargasatuan);
    });
    $('select').select2();

    $('#jumlah').on('keyup',function(){
      biaya.jumlah = parseInt($(this).val());
      // console.log(biaya.jumlah);
      biaya.total = Math.round(biaya.jumlah*biaya.hargasatuan);
      $('.total').val(biaya.total);
    });

    $('#diskon').on('keyup',function(){
      if(isNaN($(this).val()) || $(this).val() < 0){
        biaya.diskon = null;
      }else{
        biaya.diskon = parseInt($(this).val());
        tabel_diskon = Math.round((biaya.diskon/100) * biaya.hargasatuan);
        console.log(tabel_diskon);
        biaya.hargasatuan = Math.round(biaya.hargasatuan - tabel_diskon);
        biaya.total = Math.round(biaya.jumlah*biaya.hargasatuan);
      }
      $('.total').val(biaya.total);
    });

    $('#btn_masukkan_daftar').click(function(e){
      if($('.total').val() != '' && !isNaN($('#jumlah').val())){
          $('#tabel_rincian tbody').append(
            '<tr>'
              +'<td style="text-align: center;width: 25px"><a class="text-danger delete_rincian" style="cursor:pointer"><i class="fa fa-times-circle"></i></a>'
                +'<input type="hidden" name="kode_barang[]" value="'+biaya.kode+'">'
                +'<input type="hidden" name="nama_barang[]" value="'+biaya.nama+'">'
                // +'<input type="hidden" name="jumlah[]" value="'+biaya.jumlah+'">'
                +'<input type="hidden" name="total[]" value="'+biaya.total+'">'
              +'</td>'
              +'<td style="text-align:right;" class="nomor_tabel">'+biaya.id+'</td>'
              +'<td>'+biaya.kode+'</td>'
                  +'<td>'+biaya.nama+'</td>'
                  // +'<td>'+biaya.nama+'</td>'
                  +'<td style="text-align:right"><span class="number">'+biaya.hargasatuan+'</span>'
                    +'<input type="hidden" name="hargasatuan[]" value="'+biaya.hargasatuan+'">'
                  +'</td>'
                  // +'<td>'+tabel_diskon+'</td>'
                  +'<td style="text-align:center;"><span class="number">'+biaya.jumlah+'</span>'
                    +'<input type="hidden" name="jumlah[]" class="biaya_jumlah" value="'+biaya.jumlah+'">'
                  +'</td>'
                  +'<td style="text-align: center;"><span class="number">'+biaya.diskon+'</span>'
                    +'<input type="hidden" name="diskon[]" class="diskon" value="'+biaya.diskon+'">'
                  +'</td>'
                  +'<td style="text-align:right">'
                    +'<span class="total number">'+biaya.total+'</span>'
                    +'<input type="hidden" name="totals[]" class="totals '+(biaya.hargasatuan=="%"?"persen":"countable")+'" value="'+biaya.total+'">'
                  +'</td>'
                  +'<input type="text" name="totalbayar" class="totalbayar">'
            +'</tr>'
                );
          renumber_tabel();
      }else{
        notification('Detail rincian tidak valid!','danger');
      }
    });

    $('#totalbayar').on('keyup',function(e){
      e.preventDefault();
      biaya.bayar = $(this).val();
      temptotal = $('#totalharga').val();
      // console.log(temptotal);
        biaya.kembalian = Math.round(biaya.bayar - temptotal);
        $('#kembali').val(biaya.kembalian);
      
    });

    function renumber_tabel() {
      var total_tabel_countable = 0;
      var total_tabel_persen = 0;
      var jum = 0;
        $("#tabel_rincian .nomor_tabel").each(function(index) {
            $(this).html(index+1);
        });

        $("#tabel_rincian").find('.totals').filter('.countable').each(function() {
          total_tabel_countable  += parseInt($(this).val());
          // console.log(total_tabel_countable);
        });

        $("#tabel_rincian").find('.totals').filter('.persen').each(function() {
          jum = Math.round($(this).closest('tr').find('.biaya_jumlah').val()*total_tabel_countable/100);
          $(this).prev().html(jum);
          $(this).val(jum);
          total_tabel_persen  += jum;
        });
        $('#total_tabel').html(total_tabel_countable+total_tabel_persen);
        $('#totals_tabel').val(total_tabel_countable+total_tabel_persen);
        $('#totalharga').val(total_tabel_countable+total_tabel_persen);
        $('.number').number(true, 0, ',', '.');
    }

    $('#tabel_rincian').on('click','.delete_rincian',function(){
    $(this).parent().parent().remove();
    renumber_tabel();
  });


    $('#no_plg').on('change', function(e){
      e.preventDefault();
      var id = $('#no_plg').val();
      console.log(id);
      $.ajax({
        url: '{{url()}}/masterdata/transaksi/caripelanggan',
        type: 'post',
        data: { 'no_plg': id,'_token':'{!!csrf_token()!!}'},
        success:function(response){
          var ret = $.parseJSON(response);
          $('.nama').val(ret.nama);
          
        }
      });
    }).trigger('change');

    });
</script>
