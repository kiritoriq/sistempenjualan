<section class="content-header">
    <h1>
        Create New Roles<small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!!url()!!}"> Dashboard</a></li>
        <li><a href="#" id="back"> Roles</a></li>
        <li class="active">Create New Roles</li>
    </ol>
</section>
<section class="content">
    <div class="box box-primary">
      <?php
        $rpos = strrpos(\Request::path(), '/'); 
        $uri = substr(\Request::path(), 0, $rpos);
      ?>
      <div class="row">
        <div class="col-md-12">
        	{!! Form::open(array('url' => \Request::path(), 'method' => 'POST', 'class'=>'form-horizontal form-'.\Config::get('claravel::ajax'),'id'=>'simpan')) !!}
        	<div class="box-body">
        		<div class="form-group">
					{!! Form::label('parent', 'Role Parent:', array('class' => 'col-sm-3 control-label')) !!}
					<div class="col-sm-5">
						{!! Form::select('parent', $role_parent, '0') !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('name', 'Name:', array('class' => 'col-sm-3 control-label')) !!}
					<div class="col-sm-5">
						{!! Form::text('name', null, array('class'=> 'form-control')) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('description', 'Description:', array('class' => 'col-sm-3 control-label')) !!}
					<div class="col-sm-5">
						{!! Form::text('description', null, array('class'=> 'form-control')) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('login_destination', 'Login Destination:', array('class' => 'col-sm-3 control-label')) !!}
					<div class="col-sm-5">
						{!! Form::text('login_destination', null, array('class'=> 'form-control')) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('status', 'Status:', array('class' => 'col-sm-3 control-label')) !!}
					<div class="col-sm-5">
						{!! Form::select('status', array('In Active' => 'In Active', 'Active' => 'Active'), 'Active') !!}
					</div>
				</div>
        	</div>
        	<div class="box-footer">
	            <div class="form-group">
	            	<div class="col-sm-offset-3 col-sm-7">
	                {!! ClaravelHelpers::btnSave()!!}
	                &nbsp;
	                &nbsp;{!! ClaravelHelpers::btnCancel()!!}
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
  	$('select').addClass('form-control');
    $('.icp-auto').iconpicker();
    $('#batalkan,#back').on('click',function(e){
        e.preventDefault();
        refresh_page();
    });
    $('#simpan').on('submit',function(e){
      var $this = $(this);
      e.preventDefault();
      bootbox.confirm('Simpan Role?',function(a){
        if (a == true){
          $.ajax({
            url : $this.attr('action'),
            type : 'POST',
            data : $this.serialize(),
            success:function(){
              notification('Context berhasil dibuat','success');
              refresh_page();
            }
          });
        }
      });
    });
  });
</script>