<!-- <!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NWE Uploader</title>
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/jquery.form.min.js"></script>
<script type="text/javascript" src="progressBar.js"></script>




<link href="style/style.css" rel="stylesheet" type="text/css">
</head>
	<body> -->
		<?php include('nav.php');?>
		<div id="upload-wrapper">
			<div align="center">
				<h3>Utility Data Uploader</h3>
				<span class="">File Type allowed: txt.</span>
				<form action="processupload.php" onSubmit="return false" method="post" enctype="multipart/form-data" id="MyUploadForm">
					<input name="file" id="imageInput" type="file" />
					<input type="submit"  id="submit-btn" value="Upload" />
					<img src="images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
				</form>
				<div id="progressbox" style="display:none;"><div id="progressbar"></div ><div id="statustxt">0%</div></div>
				<div id="output"></div>
			</div>
		</div>

	</body>
</html>