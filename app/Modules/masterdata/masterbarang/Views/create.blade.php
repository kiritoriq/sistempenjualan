<section class="content-header">
    <h1>
        Buat Masterbarang Baru<small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!!url()!!}"> Dashboard</a></li>
        <li><a href="#" id="back"> Masterbarang</a></li>
        <li class="active">Buat Masterbarang Baru</li>
    </ol>
</section>
<section class="content">
    <div class="box box-primary">
      <div class="row">
        <div class="col-md-12">
            {!! Form::open(array('url' => url("/masterdata/masterbarang/simpan"), 'method' => 'POST', 'class'=>'form-horizontal form-'.\Config::get('claravel::ajax'),'id'=>'simpan', 'enctype'=>'multipart/form-data')) !!}
            <div class="box-body">
                <div class="form-group">
					{!! Form::label('kd_barang', 'Kode Barang:', array('class' => 'col-sm-3 control-label')) !!}
					<div class="col-sm-7">
						{!! Form::text('kd_barang', null, array('class'=> 'form-control')) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('nm_barang', 'Nama Barang:', array('class' => 'col-sm-3 control-label')) !!}
					<div class="col-sm-7">
						{!! Form::text('nm_barang', null, array('class'=> 'form-control')) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('id_jns_brg', 'Jenis Barang:', array('class' => 'col-sm-3 control-label')) !!}
					<div class="col-sm-7">
						{!! combojenis('id_jns_brg') !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('hrg_beli', 'Harga Beli:', array('class' => 'col-sm-3 control-label')) !!}
					<div class="col-sm-7">
						{!! Form::text('hrg_beli', null, array('class'=> 'form-control')) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('qty', 'qty:', array('class' => 'col-sm-3 control-label')) !!}
					<div class="col-sm-7">
						{!! Form::text('qty', null, array('class'=> 'form-control')) !!}
					</div>
				</div>
                <div class="form-group">
                    {!! Form::label('id_satuan', 'Satuan:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! combosatuan('id_satuan') !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('hrgjual', 'Harga Jual:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! Form::text('hrgjual', null, array('class'=> 'form-control')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('foto', 'Foto Barang:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! Form::file('foto', null, array('class'=> 'form-control')) !!}
                    </div>
                </div>

            </div>
            <div class="box-footer">
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-7">
                        {!! ClaravelHelpers::btnSave() !!}
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
        $('#simpan').on('submit',function(e){
            var $this = $(this);
            var formData = new FormData(this);
            e.preventDefault();
            bootbox.confirm('Simpan data?',function(a){
                if (a == true){
                    $.ajax({
                        url : $this.attr('action'),
                        type : 'POST',
                        data:formData,                                              
                        cache:false,                                                
                        contentType: false,                                             
                        processData: false,
                        beforeSend: function(){
                            $('#loading-state').fadeIn("slow");
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
                        // success:function(html){
                        //     $('#loading-state').fadeOut("slow");
                        //     if(html=='1'){
                        //         notification('Berhasil Disimpan','success');
                        //         refresh_page();
                        //     }else{
                        //         notification(html,'danger');
                        //     }
                        // }
                    });
                }
            });
        });
        $('#foto').fileinput({                 
            showUpload:false,                   
            previewFileType:'image',                    
            allowedFileExtensions: ["png", "jpg", "jpeg", "PNG", "JPG", "JPEG"],                    
            maxFileSize: 1024 * 1 * 1 ,                 
            browseLabel: "",                    
            browseIcon: '<i class="fa fa-folder-open"></i>',                    
            removeLabel: " Hapus",                  
            removeIcon: '<i class="fa fa-times"></i>',                  
            layoutTemplates: {                  
                main1: "{preview}\n" +                  
                "<div class=\'input-group {class}\'>\n" +                   
                "   <div class=\'input-group-btn\'>\n" +                    
                "       {browse}\n" +                   
                "       {upload}\n" +                   
                "       {remove}\n" +                   
                "   </div>\n" +                 
                "   {caption}\n" +                  
                "</div>"                    
            }       
        });
    });
</script>
