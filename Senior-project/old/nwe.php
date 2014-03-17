<?php

//connect to the database
//$connect = mysql_connect("localhost","justin","428f448c01");
//mysql_select_db("seniorproject",$connect); //select the table
// 
require('connect.php');
require('nav.php');
if ($_FILES[csv][size] > 0) { 

    //get the csv file 
    //Set the file 
    $file = $_FILES[csv][tmp_name]; 
    // For mac formatted data, need to have this fix so it picks up on the newline
    //http://www.jamipietila.fi/easy-fix-to-fgetcsv-and-newline-character/
    ini_set('auto_detect_line_endings', true);
    $handle = fopen($file,"r"); 

     
    //loop through the csv file and insert into database 
    do { 
        if ($data[0]) { 
            mysql_query("INSERT INTO big_horn_proxy (coop_name, account, name, meter,srv_addr,srv_city,srv_st_zip,srv_desc,site_id,bill_date, start_date, end_date, kwh_usage,kw_demand,mail_addr1,mail_addr2,mail_city_st_zip,consumption_chg,base_rate_chg,total_chg) VALUES 
                ( 
                    '".addslashes($data[0])."', 
                    '".addslashes($data[1])."', 
                    '".addslashes($data[2])."',
                    '".addslashes($data[3])."',
                    '".addslashes($data[4])."',
                    '".addslashes($data[5])."',
                    '".addslashes($data[6])."',
                    '".addslashes($data[7])."',
                    '".addslashes($data[8])."',
                    '".addslashes($data[9])."',
                    '".addslashes($data[10])."',
                    '".addslashes($data[11])."',
                    '".addslashes($data[12])."',
                    '".addslashes($data[13])."',
                    '".addslashes($data[14])."',
                    '".addslashes($data[15])."',
                    '".addslashes($data[16])."',
                    '".addslashes($data[17])."',
                    '".addslashes($data[18])."',
                    '".addslashes($data[19])."'
                   
                ) 
            "); 
        } 
    } while ($data = fgetcsv($handle,1000,",",'"'));
    // 

    //redirect the success code 
    header('Location: bighorn.php?success=1'); die; 

} 

?> 



<?php if (!empty($_GET[success])) { echo "<b>Your file has been imported.</b><br><br>"; } //generic success notice ?> 

<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
  Choose your file: <br /> 
  <input name="csv" type="file" id="csv" /> 
  <input type="submit" name="Submit" value="Submit" /> 
</form> 

</body> 
</html> 
