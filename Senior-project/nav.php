
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script type="text/javascript" src="js/jquery.form.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="progressBar.js"></script>

  
<script type="text/javascript">

$(document).ready(function() {
$(document).on('click', '.clickListen', function(){

  $('li.active').removeClass('active');
  $(this).parent().addClass("active")
    var myAccountId = $(this).attr('id');
    getPicture(myAccountId);
    return false;
});
});

function getPicture(myAccId)
{
$('#mainInfo').html('<div style="margin-top:50px;width:500px;" align="center" ><img src="loader.gif" /></div>');

var myData = 'accountID='+myAccId;
jQuery.ajax({
    url: "getMeterInfo.php",
    type: "GET",
    dataType:'html',
    data:myData,
    // target:   '#mainInfo'
    success:function(response)
    {
        $('#mainInfo').html(response);
    }
    });
}
</script>


<link href="style/style.css" rel="stylesheet" type="text/css">

    <title>Senior Project</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>


<!-- <nav>
    <a href="#">Home</a>
    <a href="index.php">Upload</a>
    <a href="reportAccount.php">Accounts</a>
</nav> -->
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Senior Project - Energy Database</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Home</a></li>
            <li><a href="index.php">Upload</a></li>
            <li><a href="dashboard.php">Accounts</a></li>
            
          </ul>
<!--           <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form> -->
        </div>
      </div>
    </div>
<?php
//Justin
?>