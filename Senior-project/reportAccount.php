<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NWE Accounts</title>
<!-- <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/jquery.form.min.js"></script>
<script type="text/javascript" src="progressBar.js"></script> -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
$(".fill-div").live("click", function() {
	var myAccountId = $(this).attr('id');
	// var getImgId =  myPictureId.split("-");
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
<?php require('connect.php'); ?>



<link href="style/style.css" rel="stylesheet" type="text/css">
</head>
	<body>
		<?php include('nav.php');?>
		<div id="left-wrapper">
			<div align="center">
				<h3>Accounts</h3>
				<?php $sql = "select distinct ACCOUNT_CODE from ACCOUNT_SOCKET_METER limit 15";

				$pdoSelect = $db->prepare($sql);
				$pdoSelect->execute();
				$accounts = $pdoSelect->fetchAll();
				foreach($accounts as $row)
				{
					echo '<div id="my-div"><a href="#" id="'.$row['ACCOUNT_CODE'].'" class="fill-div">'.$row['ACCOUNT_CODE'].'</a></div>';
				}
				?>

			</div>
		</div>
		<div id="mainInfo">
		<?php
			$getInfo = file_get_contents("http://localhost/getMeterInfo.php");
			echo $getInfo;
?> 

		</div>

	</body>
</html>