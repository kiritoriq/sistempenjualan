<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sipenmaru Poltekkes Kemenkes Semarang</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="{{ asset('packages/tugumuda/images/icon.png') }}" rel='icon' type='image/x-icon'/>
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{!!asset('packages/tugumuda/css/bootstrap.min.css')!!}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{!!asset('packages/tugumuda/css/font-awesome.min.css')!!}">
  <!-- Animate CSS -->
  <link rel="stylesheet" href="{!!asset('packages/tugumuda/css/animate.css')!!}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{!!asset('packages/tugumuda/css/ionicons.min.css')!!}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{!!asset('packages/tugumuda/css/AdminLTE.min.css')!!}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src='https://www.google.com/recaptcha/api.js?hl=id'></script>

  <style>
    html{      
      /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#fefcea+0,f95339+100 */
      background: #fefcea; /* Old browsers */
      background: -moz-linear-gradient(top,  #fefcea 0%, #f95339 100%); /* FF3.6-15 */
      background: -webkit-linear-gradient(top,  #fefcea 0%,#f95339 100%); /* Chrome10-25,Safari5.1-6 */
      background: linear-gradient(to bottom,  #fefcea 0%,#f95339 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
      filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fefcea', endColorstr='#f95339',GradientType=0 ); /* IE6-9 */      
    }
    body{
        padding-top: .62em;
        height: 100%;
        height: 100vh;
        background-color: transparent;        
        background-position: bottom center;
        background-repeat: repeat-x;
    }
    .login-logo{
      font-size: 23px;
      text-transform: uppercase;
      line-height: 1.1em;
      font-weight: 400;
      -webkit-animation-delay: .3s;
           -o-animation-delay: .3s;
              animation-delay: .3s;
    }
    .login-logo img{
      display: block;
      margin: 10px auto;
    }
    .login-box{
      margin: 4% auto;
    }
    .login-box-body{
      margin-bottom: 15px;
      -webkit-animation-delay: .6s;
           -o-animation-delay: .6s;
              animation-delay: .6s;
    }
    .login-box-body .form-group{
      -webkit-animation-delay: .9s;
           -o-animation-delay: .9s;
              animation-delay: .9s;
    }
    .login-box-body .form-group+.form-group{
      -webkit-animation-delay: 1.2s;
           -o-animation-delay: 1.2s;
              animation-delay: 1.2s;
    }
    .login-box-body .row{
      -webkit-animation-delay: 1.5s;
           -o-animation-delay: 1.5s;
              animation-delay: 1.5s;
    }
    .login-box p{
      -webkit-animation-delay: 1.8s;
           -o-animation-delay: 1.8s;
              animation-delay: 1.8s;
    }
    .login-box p a{
      color: inherit;
    }
  </style>
    
</head>