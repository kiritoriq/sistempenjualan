
<section class="content-header">
    <h1>
        Permissions<small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!!url()!!}"> Dashboard</a></li>
        <li class="active">Permissions</li>
    </ol>
</section>
<section class="content">
  <div class="box box-primary">
    <div class="box-header with-border">
      {!! ClaravelHelpers::btnCreate(); !!}
      <div class="box-tools pull-right">
        {!! Form::open(array('url' => \Request::path(), 'method' => 'GET', 'class' => 'form-'.\Config::get('claravel::ajax'),'id' => 'cari' )) !!}
        <div class="input-group" style="width: 200px;">
          <input type="text" class="form-control" name="search" value="{!! \Input::get('search')!!}">
          <span class="input-group-btn">
            <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span> Search</button>
          </span>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
    {!! Form::open(array('url' => \Request::path().'/delete', 'method' => 'POST', 'class' => 'form-'.\Config::get('claravel::ajax'),'id'=>'data' )) !!}
    <div class="table-responsive">
    <div class="box-body no-padding">
    <table class="table table-striped table-hover table-bordered table-condensed" id="tabel">
      <thead class='bg-primary'>
        <tr>
          <th><input type="checkbox" name="checkall" id="checkall" class="checkall" value="1" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Pilih Semua"></th>
          <th>Name</th>
          <th>Description</th>
          <th>Status</th>
          <th>Act.</th>
        </tr>
      </thead> 
      <tbody>
        @foreach ($permissionss as $permissions)
        <tr>
          <td><center>{!! ClaravelHelpers::ckDelete($permissions->id); !!}</center></td>   
          <td>{!!$permissions->name!!}</td>
          <td>{!!$permissions->description!!}</td>
          <td>{!!$permissions->status!!}</td>
          <td>
          {!! ClaravelHelpers::btnEdit($permissions->id); !!}
            &nbsp;
              {!! ClaravelHelpers::btnDelete($permissions->id); !!}
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>
    </div>
    <div class="box-footer clearfix">
      <div class="row">
        <div class="col-sm-5">
          {!! ClaravelHelpers::btnDeleteAll(); !!}
        </div>
        <div class="col-sm-7">
          <?php echo $permissionss->appends(array('search' => Input::get('search')))->render(); ?>
        </div>
      </div>
    </div>
    {!! Form::close() !!}
  </div>
</section>
<script type="text/javascript">
  $(document).ready(function(){
    $('.pagination').addClass('pagination-sm no-margin pull-right');
    $('.checkme,.checkall').on('change',function(){
      if($(this).is(':checked'))
        $('#deleteall').fadeIn(300);
      else
        $('#deleteall').fadeOut(300);
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

    $('#buat').on('click',function(e){
      e.preventDefault();
      $.ajax({
        url : $(this).attr('href'),
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
        bootbox.confirm('Hapus Permission?',function(a){
            if(a == true){
                $.ajax({
                    url : index_page + '/delete',
                    type : 'post',
                    data:'id=' + $this.attr('recid'),
                    beforeSend: function(){
                      $('#loading-state').fadeIn("slow");
                    },
                    success:function(html){
                        $('#loading-state').fadeOut("slow");
                        notification('Permission berhasil dihapus','success');
                        $this.closest('tr').fadeOut(300,function(){
                            $(this).remove();
                        });
                    }
                });
            }
        });
    });

    $('#tabel').on('click','#edit',function(e){
        e.preventDefault();
        var $this =$(this);
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
    });

    $('#data').on('submit',function(e){
      e.preventDefault();
      var iki = $(this);
      bootbox.confirm('Hapus beberapa Permissions?',function(r){
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
              notification('Permissions berhasil dihapus','success');
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