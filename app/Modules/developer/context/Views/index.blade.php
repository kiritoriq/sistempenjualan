<section class="content-header">
    <h1>
        Context<small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!!url()!!}"> Dashboard</a></li>
        <li class="active">Context</li>
    </ol>
</section>
<section class="content">
    <div class="box box-primary">
      <div class="box-header with-border">
        {!! ClaravelHelpers::btnCreate() !!}
        <div class="box-tools pull-right">
          
        </div>
      </div>
      {!! Form::open(array('url' => \Request::path().'/delete', 'method' => 'POST', 'class' => 'form-'.\Config::get('claravel::ajax'),'id'=>'data' )) !!}
      <div class="box-body no-padding">
        <div class="table-responsive">
          <div class="box-body no-padding">
            <table class="table table-condensed table-striped table-bordered table-hover" id="tabel">
              <thead class='bg-primary'>
                <tr>
                  <th><input type="checkbox" name="checkall" id="checkall" class="checkall" value="1" data-toggle="tooltip" data-placement="bottom" title="Pilih Semua"></th>
                  <th>Name</th>
                  <th>Path</th>
                  <th>Controller</th>
                  <th>Act.</th>
                </tr>
              </thead> 
              <tbody>
                @foreach ($contexts as $context)
                <tr>
                  <th>
                    <center>
                      @if ($context->modules->count() == 0)
                        {!! ClaravelHelpers::ckDelete($context->id); !!}
                      @endif
                    </center>
                  </th>   
                  <td>{!!$context->name!!}</td>
                  <td>{!!$context->path!!}</td>
                  <td>{!!$context->uses!!}</td>
                  <td>
                    {!! ClaravelHelpers::btnEdit($context->id); !!}
                    &nbsp;
                    @if ($context->modules->count() == 0)
                      {!! ClaravelHelpers::btnDelete($context->id); !!}
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="box-footer">
        {!! ClaravelHelpers::btnDeleteAll(); !!}
      </div>
      {!! Form::close() !!}
    </div>
</section>
<script type="text/javascript">
  $(document).ready(function(){

    $('.checkme,.checkall').on('change',function(){
      if($(this).is(':checked'))
        $('#deleteall').fadeIn(300);
      else
        $('#deleteall').fadeOut(300);
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
        bootbox.confirm('Hapus Context?',function(a){
            if(a == true){
                $.ajax({
                    url : index_page + '/delete',
                    type : 'post',
                    data: {'id' : $this.attr('recid'), '_token' : '{{csrf_token()}}'},
                    beforeSend: function(){
                      $('#loading-state').fadeIn("slow");
                    },
                    success:function(html){
						$('#loading-state').fadeOut("slow");
                        notification('Context berhasil dihapus','success');                        
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
      bootbox.confirm('Hapus beberapa context?',function(r){
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
              notification('Context berhasil dihapus','success');
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
