
<?php
//connect to the database 
//$connect = mysql_connect("sinectcom1.ipagemysql.com","justin","428f448c01!"); 
//mysql_select_db("seniorproject11",$connect); //select the table 
//$database="seniorproject11";
//mysql_connect("sinectcom1.ipagemysql.com","justin","428f448c01!");
//@mysql_select_db($database) or die( "Unable to select database");
//
require('connect.php');
require('nav.php');
$query="SELECT * FROM big_horn_proxy";$result=mysql_query($query);
$num=mysql_numrows($result);mysql_close();?>
<table border="0" cellspacing="2" cellpadding="2">
<tr>
<td><font face="Arial, Helvetica, sans-serif">Value1</font></td>
<td>
<font face="Arial, Helvetica, sans-serif">Value2</font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif">Value3</font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif">Value4</font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif">Value5</font>
</td>
<td>Value6</td>
<td><font face="Arial, Helvetica, sans-serif">Value7</font></td>
<td><font face="Arial, Helvetica, sans-serif">Value8</font></td>
<td><font face="Arial, Helvetica, sans-serif">Value9</font></td>
<td><font face="Arial, Helvetica, sans-serif">Value10</font></td>
<td><font face="Arial, Helvetica, sans-serif">Value11</font></td>
<td><font face="Arial, Helvetica, sans-serif">Value12</font></td>
<td><font face="Arial, Helvetica, sans-serif">Value13</font></td>
<td><font face="Arial, Helvetica, sans-serif">Value14</font></td>
<td><font face="Arial, Helvetica, sans-serif">Value15</font></td>
<td><font face="Arial, Helvetica, sans-serif">Value16</font></td>
<td><font face="Arial, Helvetica, sans-serif">Value17</font></td>
<td><font face="Arial, Helvetica, sans-serif">Value18</font></td>
<td><font face="Arial, Helvetica, sans-serif">Value19</font></td>
<td><font face="Arial, Helvetica, sans-serif">Value20</font></td>

</tr>

<?php $i=0;while ($i < $num) {
$f1=mysql_result($result,$i,"coop_name");
$f2=mysql_result($result,$i,"account");$f3=mysql_result($result,$i,"name");
$f4=mysql_result($result,$i,"meter");$f5=mysql_result($result,$i,"srv_addr");
$f6=mysql_result($result,$i,"srv_city");$f7=mysql_result($result,$i,"srv_st_zip");
$f8=mysql_result($result,$i,"srv_desc");$f9=mysql_result($result,$i,"site_id");
$f10=mysql_result($result,$i,"bill_date");$f11=mysql_result($result,$i,"start_date");
$f12=mysql_result($result,$i,"end_date");$f13=mysql_result($result,$i,"kwh_usage");
$f14=mysql_result($result,$i,"kw_demand");$f15=mysql_result($result,$i,"mail_addr1");
$f16=mysql_result($result,$i,"mail_addr2");$f17=mysql_result($result,$i,"mail_city_st_zip");
$f18=mysql_result($result,$i,"consumption_chg");$f19=mysql_result($result,$i,"base_rate_chg");
$f20=mysql_result($result,$i,"total_chg");
	?>

<tr>
<td><?php echo $f1; ?></td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $f2; ?></font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $f3; ?></font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $f4; ?></font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $f5; ?></font>
</td>
<td><?php echo $f6; ?></td>
<td><?php echo $f7; ?></td>
<td><?php echo $f8; ?></td>
<td><?php echo $f9; ?></td>
<td><?php echo $f10; ?></td>
<td><?php echo $f11; ?></td>
<td><?php echo $f12; ?></td>
<td><?php echo $f13; ?></td>
<td><?php echo $f14; ?></td>
<td><?php echo $f15; ?></td>
<td><?php echo $f16; ?></td>
<td><?php echo $f17; ?></td>
<td><?php echo $f18; ?></td>
<td><?php echo $f19; ?></td>
<td><?php echo $f20; ?></td>
</tr>
<?php $i++; } ?>
</body>
</html>
