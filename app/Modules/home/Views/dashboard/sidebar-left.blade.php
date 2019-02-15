<?php
$claravel = new \MenuLibrary;
$menu =  $claravel->createMenu();          
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
	<div class="user-panel">
        <?php            
			if(file_exists("./packages/upload/photo/".session('user_id')."/".session('foto'))){
				$pict = session('user_id').'/'.session('foto');
			}else {
				$pict = "default.jpg";
			}            
        ?>
        <div class="pull-left image">
            <img alt="User Image" class="img-circle" src="{!!asset('packages/upload/photo/'.$pict)!!}">
        </div>
        <div class="pull-left info">
            <p>{{session('name')}}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> {{session('role')}}</a>
        </div>
    </div>
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
          {!!$menu!!}
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>