{!!View::make('home::login.header')!!}

<body class="hold-transition">
<div class="login-box">
  <div class="login-logo animated fadeInDown">
    <a href="{!!url()!!}">	  
      <!-- <img src="{!!asset('packages/tugumuda/images/logo.png')!!}" width="auto" height="120" alt="Poltekkes Kemenkes Semarang"> -->
      <b>TUGUMUDA</b><br>CMSWEB ADMINISTRATOR
    </a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body animated zoomIn">
    <p class="login-box-msg">LOGIN ADMIN</p>

    {!!Form::open(array('url' => url().'/login','id'=>'tampil', 'method' => 'POST'))!!}
      {!!csrf_field()!!}
	  @if(\Session::get('msgerr') != '')
      <div class='alert alert-danger'>{{\Session::get('msgerr')}}</div>
      @endif    
      <div class="form-group has-feedback animated zoomIn">
        <input type="text" name='username' id="username" class="form-control" required placeholder="Username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback animated zoomIn">
        <input type="password" name='password' class="form-control" required placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <!--<div class="form-group has-feedback animated zoomIn">
        <div class="g-recaptcha" data-theme="light" data-sitekey="6Lf7QiITAAAAANU67yhRw8ZfTZA0LCJzj5A4FyJW" style="transform:scale(1.06);-webkit-transform:scale(1.06);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
      </div>-->
      <div class="row animated zoomIn">
        <div class="col-xs-4">&nbsp;</div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
        </div>
          <div class="col-xs-4">
              <button type="reset" class="btn btn-default btn-block btn-flat">Reset</button>
          </div>
        <!-- /.col -->
      </div>
    {!!Form::close()!!}


  </div>
  <p class="text-center animated fadeInUp">&copy; 2017 Dinustek<br><b>Dian Nuswantoro Teknologi Informasi</b></a></p>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.0 -->
<script src="{!!asset('packages/tugumuda/plugins/jQuery/jQuery-2.2.0.min.js')!!}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{!!asset('packages/tugumuda/js/bootstrap.min.js')!!}"></script>
<!-- iCheck -->
<script>
$('#username').focus();
</script>
<style>
    #rc-imageselect {transform:scale(1.06);-webkit-transform:scale(1.06);transform-origin:0 0;-webkit-transform-origin:0 0;}

    @media screen and (max-height: 575px){
        #rc-imageselect, .g-recaptcha {transform:scale(1.06);-webkit-transform:scale(1.06);transform-origin:0 0;-webkit-transform-origin:0 0;}
    }
</style>
</body>
</html>
