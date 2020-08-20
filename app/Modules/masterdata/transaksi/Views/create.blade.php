<section class="content-header">
  <h1>
    Buat Transaksi Baru<small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{!!url()!!}"> Dashboard</a></li>
    <li><a href="#" id="back"> Transaksi</a></li>
    <li class="active">Buat Transaksi Baru</li>
  </ol>
</section>
<section class="content">
  <div class="box box-danger">
    <div class="row">
      <div class="col-md-12">
        {!! Form::open(array('url' => \Request::path(), 'method' => 'POST', 'class'=>'form-horizontal form-'.\Config::get('claravel::ajax'),'id'=>'simpan')) !!}
        <div class="box-body">
          <div class="form-group">
            {!! Form::label('tgl','Tanggal:',array('class'=>'col-sm-3 control-label')) !!}
            <div class="col-sm-4">
              {!! date_picker('tgl', date('Y-m-d')) !!}
            </div>
          </div>
          <hr class="no-padding" style="margin-top: 20px !important; margin-bottom: 10px !important;">
          <div class="row">
          <div class="col-md-6">
            <div class="form-group">
             {!! Form::label('kd_transk', 'Kode Transaksi:', array('class' => 'col-sm-3 control-label')) !!}
              <div class="col-sm-7">
                <!-- <select id="id_transk" class="transk"></select> -->
                {!! Form::text('kd_transk', null, array('class'=> 'form-control')) !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('kd_kasir', 'Kode Kasir:', array('class' => 'col-sm-3 control-label')) !!}
              <div class="col-sm-4">
                {!! Form::text('kd_kasir', session::get('user_id'), array('class'=> 'form-control','readonly'=>'')) !!}
              </div>
              <div class="col-sm-4">
                {!! Form::text('nama_kasir', session::get('name'), array('class'=> 'form-control','readonly'=>'')) !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('no_plg', 'Kode Pelanggan:', array('class' => 'col-sm-3 control-label')) !!}
              <div class="col-sm-4">
                {!! Form::text('no_plg', null, array('class'=> 'form-control')) !!}
              </div>
              <div class="col-sm-4">
                {!! Form::text('nama_plg', null, ['class'=>'form-control nama', 'readonly'=>'']) !!}
              </div>
            </div>    
        </div>
        <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('totalharga', 'Total:', array('class' => 'col-sm-3 control-label')) !!}
              <div class="col-sm-7">
                {!! Form::text('totalharga', null, array('class'=>'form-control','readonly'=>'')) !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('totalbayar', 'Bayar:', array('class' => 'col-sm-3 control-label')) !!}
              <div class="col-sm-7">
                {!! Form::text('totalbayar', null, array('class'=>'form-control')) !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('kembali', 'Kembali:', array('class' => 'col-sm-3 control-label')) !!}
              <div class="col-sm-7">
                {!! Form::text('kembali', null, array('class'=>'form-control','readonly'=>'')) !!}
              </div>
            </div>
        </div>
      </div>
      <hr class="no-padding" style="margin-top: 20px !important; margin-bottom: 10px !important;">
      <div class="row">
        <div class="col-md-12">
            <h4 class="text-bold">Rincian Barang</h4>
        <br>
          <div class="form-group">
            {!! Form::label('kd_barang', 'Pilih Barang:', array('class' => 'col-sm-3 control-label')) !!}
              <div class="col-sm-7">
                {!! combobarang('kd_barang') !!}
                <!-- <select style="width:100%;" name="id_bahan[]" id="id_bahan" dtvalue="0"></select> -->
              </div>
          </div>
          <div class="form-group">
            {!! Form::label('hrgjual', 'Harga Satuan:', array('class' => 'col-sm-3 control-label')) !!}
              <div class="col-sm-7">
                {!! Form::text('hrgjual', null, array('class'=> 'harga uang form-control', 'readonly'=>'')) !!}
              </div>
          </div>
          <div class="form-group">
            {!! Form::label('jumlah', 'Jumlah Barang:', array('class' => 'col-sm-3 control-label')) !!}
              <div class="col-sm-7">
                {!! Form::text('jumlah', null, array('class'=> 'form-control jml')) !!}
              </div>
          </div>
          <div class="form-group">
            {!! Form::label('diskon', 'Diskon (%):', array('class' => 'col-sm-3 control-label')) !!}
              <div class="col-sm-8">
                <div class="col-sm-3">
                  {!! Form::text('diskon', null, array('class'=> 'form-control disk')) !!}
                </div>
                <div class="col-sm-5">
                  <div class="form-group">
                    {!! Form::label('total', 'Total:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                      {!! Form::text('total', null, array('class'=> 'form-control total','readonly'=>'')) !!}
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <div class="col-sm-3 col-sm-offset-3">
          <a id="btn_masukkan_daftar" class="btn btn-success">Masukkan ke Daftar >></a>
        </div>
        </div>
        <div class="col-md-12" style="margin-top:10px">
            <table class="table table-striped table-hover table-condensed table-bordered" id='tabel_rincian'>
                    <thead class="bg-primary">
                    <tr>
                        <th style="text-align: center;">#</th>
                        <th style="text-align: center;">No.</th>
                        <th style="text-align: center;">Kode Barang</th>
                        <th style="text-align: center;">Nama Barang</th>
                        <!-- <th style="text-align: center;"></th> -->
                        <th style="text-align: center;">Harga Satuan</th>
                        <!-- <th style="text-align: center;"></th> -->
                        <th style="text-align: center;">Jumlah</th>
                        <th style="text-align: center;">Diskon (%)</th>
                        <th style="text-align: center;">Total</th>
                    </tr>
                    </thead>   
                    <tbody>
                      
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="7" style="text-align: right;font-weight: bold">Total</td>
                        <td id="total_tabel" class="number" style="text-align: right;font-weight: bold"></td>
                        <input type="hidden" name="totals_tabel" id="totals_tabel">
                      </tr>
                    </tfoot>
                </table>
        </div>
      </div>

  </div>
  <div class="box-footer">
    <div class="form-group">
      <div class="col-sm-offset-3 col-sm-7">
        <button id="tombol_simpan" type="button" class="btn btn-success"><i class="fa fa-floppy-o"></i> Simpan</button>
        &nbsp;
        &nbsp;
        {!! ClaravelHelpers::btnCancel() !!}
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
                            url : '{!! url()."/masterdata/transaksi/simpan" !!}',
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
    // $('#tambah').on('click',function(e){
    //   e.preventDefault();
    //   e.stopImmediatePropagation();
    //   $('#konten_barang').append($('#temp').html());
    //   $('#konten_barang select').each(function(){
    //     autoComplete($(this), '{!!url()!!}/masterdata/transaksi/caribarang', '', '', '', '');
    //   });
    //   $('.jml').each(function(){
    //     $(this).on('keyup',function(r){
    //       if(r.keyCode == 38){
    //         r.preventDefault();
    //         r.stopImmediatePropagation();
    //         gethitung($(this).val());
    //       }
    //     });
    //   });
    //   $('#konten_barang #hapus,#konten_pelanggan #hapus').on('click',function(){
    //     $(this).closest('tr').remove();
    //   });
      
    // });

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
