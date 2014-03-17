<?php
require('connect.php');


if(isset($_POST))
{
	//check if this is an ajax request
	if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
		die();
	}
	
	// check $_FILES['file'] not empty
	if(!isset($_FILES['file']) || !is_uploaded_file($_FILES['file']['tmp_name']))
	{
			die('Something wrong with uploaded file, something missing!'); // output error when above checks fail.
	}
	 if ($_FILES["file"]["error"] > 0) //Check to see if there is a file error 
    {
    	// Print out the error code if there is one.
    	echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
    // If no error proceed with the script
  else 
	{
		// Print out the uploaded name, type, size, and temp file name
	    echo '<h4>'."Upload: " . $_FILES["file"]["name"] . "<br>".'</h4>';
	    echo "Type: " . $_FILES["file"]["type"] . "<br>";
	    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

	    //Check to see if the file exists in the /upload/ directory
	    if (file_exists("upload/" . $_FILES["file"]["name"]))
	      {
	      	//if the file exists display an error message
	      echo $_FILES["file"]["name"] . " already exists. ";
	      }
	    //File doesnt exist, so go ahead and move it over to /upload
	    else
	      {
	      //http://us1.php.net/manual/en/function.move-uploaded-file.php
	      move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
	      //Print out the uploaded file path
	      echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
	      }
    }// End else
    // End of upload and move process of the script

    // Open the uploaded file from the global variable 
    // WILL NEED TO CHANGE WHEN THIS ISN'T ALL IN ONE FILE
    $fp = fopen("upload/" . $_FILES['file']['name'], 'rb');
    $i =0;
    $length = 0;
    //Clear the temp file
    file_put_contents("upload/test.txt", "");
    //Open the temp file
    $file = fopen("upload/test.txt","w");
    //Check the length of the first line and print it out
    $length = strlen(fgets($fp));
    echo "<br>$length Length <br>";
	if($length == 165)
	{
        while ( ($line = fgets($fp)) !== false) 
        {
		// echo "<br>Fix Charge File Current Format (2013-09 -- Present) <br>";
		// echo "Fix Charge File <br>";
        // $fieldArray = array("account","premisenumber","revenueYearMonth","billDate","effectiveDate","endDate","recordTypeCode","description","chargeQuantity","billAmount","fixChargeRate");
        // $positionArray = array(1,8,25,33,43,53,61,65,126,133,148);
        // $lengthArray = array(7,15,6,8,8,8,4,61,7,15,15);


        $filler_1 = substr($line,0,1);$account = substr($line,1,7);
        $premiseNumber = substr($line,8,15);$filler_2 = substr($line,23,2);
        $revenueYearMonth = substr($line,25,6);$filler_3 = substr($line,31,2);
        $billDate = substr($line,33,8);$filler_4 = substr($line,41,2);
        $effectiveDate = substr($line,43,8);$filler_5 = substr($line,51,2);
        $end_date = substr($line,53,8);$recordTypeCode = substr($line,61,4);
        $description = substr($line,65,61);$chargeQuantity = substr($line,126,7);
        $billAmount = substr($line,133,15);$fixChargeRate = substr($line,148,15);
        $info = ($account.','.$premiseNumber.','.$revenueYearMonth.','.$billDate.','.$effectiveDate.','.$end_date.','.$recordTypeCode.','.$description.',"'.$chargeQuantity.'",'.$billAmount.','.$fixChargeRate.':');
        fwrite($file,$info);
        }
        fclose($file);
        $insert_query = 'LOAD DATA  INFILE "../../www/upload/test.txt" INTO table FIX_CHARGE_TEMP FIELDS TERMINATED BY "," OPTIONALLY ENCLOSED BY "\"" LINES TERMINATED BY ":" ';
        //Try to insert the data into the database, if it doesn't work echo out the error
        $pdoInsert = $db->prepare($insert_query);
        $pdoInsert->execute();
        // if (!) {
        //     echo "Can't insert  record : " . mysql_error($connect);
        // } else {
        //     echo "You have successfully insert records into  table";
        // }
        //Close the connection so we aren't hanging the session
        // mysql_close($connect);    
	}
	if($length == 163)
	{
		echo "<br>Fix Charge File Old Format (2007-01 -- 2013-08) <br>";
	}
    //New Usage Only file format (2013-09 -- Present)
	if($length == 562)
	{
        //Go through the uploaded file and write the specific fields to a temp file delimited by commas
		while ( ($line = fgets($fp)) !== false) 
	    {
            $premiseNumber = substr($line,0,15);$filler = substr($line,15,1);$account = substr($line,16,7);
            $customerName = substr($line,23,30);$filler_2 = substr($line,53,2);$revenueYearMonth = substr($line,55,6);
            $utilityCode = substr($line,61,1);$filler_3 = substr($line,62,1);$serviceId = substr($line,63,20);
            $rate = substr($line,83,5);$meter = substr($line,88,10);$usage = substr($line,98,17);
            $additionalUsage = substr($line,115,17);$demandUsage = substr($line,132,19);$serviceAddress = substr($line,151,64);
            $additionalAddress = substr($line,215,200);$serviceCity = substr($line,415,22);$mailAddress = substr($line,437,64);
            $mailCity = substr($line,501,22);$mailStateCode = substr($line,523,2);$mailZipCode = substr($line,525,15);
            $previousReadDate = substr($line,540,10);$currentReadDate = substr($line,550,10);
            //Construct the line to write to the temp file to be able to use the LOAD INFILE MYSQL Command
            $info = ($premiseNumber.','.$account.','.$customerName.','.$revenueYearMonth.','.$utilityCode.','.$serviceId.','.$rate.','.$meter.',"'.$usage.'",'.$additionalUsage.','.$demandUsage.','.$serviceAddress.','.$additionalAddress.','.$serviceCity.','.$mailAddress.','.$mailCity.','.$mailStateCode.','.$mailZipCode.','.$previousReadDate.','.$currentReadDate.':');
            fwrite($file,$info);
        }//Close while loop

	fclose($file);
    //http://www.aip.de/~weber/doc/mysql/manual_SQL_Syntax.html
    //Took out all of the column names and it now works correctly
		$insert_query = 'LOAD DATA  INFILE "../../www/upload/test.txt" INTO table USAGE_ONLY_TEMP FIELDS TERMINATED BY "," OPTIONALLY ENCLOSED BY "\"" LINES TERMINATED BY ":" ';
        //Try to insert the data into the database, if it doesn't work echo out the error
                $pdoInsert = $db->prepare($insert_query);
        $pdoInsert->execute();
  //       if (!mysql_query($insert_query, $connect)) {
		// 	echo "Can't insert  record : " . mysql_error($connect);
		// } else {
		// 	echo "You have successfully insert records into  table";
		// }
  //       //Close the connection so we aren't hanging the session
  //       mysql_close($connect);
	}
	if($length == 345)
	{
		echo "<br>Usage Only File Old Format (2007-01 -- 2013-08) <br>";
	}
	if($length == 604)
	{
        $lineCount =0;
        while ( ($line = fgets($fp)) !== false) 
        {
		// echo "<br>Usage Dollar File Current Format (2013-09 -- Present) <br>";
		// echo "Usage Dollar Files <br>";
        $filler_1 = substr($line,0,1);
        $account = substr($line,1,7);
        $premiseNumber = substr($line,8,15);
        $customerName = substr($line,23,30);
        $mailAttention = substr($line,53,30);
        $mailAddress = substr($line,83,64);
        $mailCity = substr($line,147,22);
        $mailStateCode = substr($line,169,2);
        $mailZipCode = substr($line,171,15);
        $ServiceAddress = substr($line,186,64);
        $AdditionalAddress = substr($line,250,200);
        $ServiceCity = substr($line,450,22);
        $ServiceState = substr($line,472,2);
        $ServiceZip = substr($line,474,17);
        $RevenueYearMonth = substr($line,491,6);
        $UtilityCode = substr($line,497, 1);
        $Filler = substr($line,498,1);
        $ServiceID = substr($line,499, 20);
        $Rate = substr($line,519, 5);
        $Meter = substr($line,524,10);
        $Usage = substr($line,534,17);
        $Amount = substr($line,551, 17);
        $TypeCode = substr($line,568, 3);
        $AdjustmentCode = substr($line,571, 5);
        $NumberOfDays = substr($line,576,5);
        $PreviousReadDate = substr($line,581, 10);
        $CurrentReadDate = substr($line,591, 9);
        $ServiceCode = substr($line,600, 10);

        if (trim($Meter) == '')
        {
            $Meter = "-".trim($account);
            $UtilityCode = "L";
        }
        if (trim($TypeCode).trim($AdjustmentCode) == '')
        {
            $TypeCode = "OTH";
            $AdjustmentCode = "ER";
        }
        $info = ('"'.trim($account).'","'.trim($Meter).'","'.trim($UtilityCode).'","'.trim($ServiceID).'","'.trim($TypeCode).trim($AdjustmentCode).'","'.trim($RevenueYearMonth).'01","'.trim($PreviousReadDate).'","'.trim($CurrentReadDate).'","'.trim($Usage).'","'.STR_REPLACE('@','',STR_REPLACE('R','',trim($Amount))).'":');      fwrite($file,$info);
        
        // $info = ('"'.trim($account).'","'.trim($premiseNumber).'","'.trim($customerName).'","'.trim($mailAttention).'","'.trim($mailAddress).'","'.trim($mailCity).' '.trim($mailStateCode).'","'.trim($mailZipCode).'","'.trim($ServiceAddress).'","'.trim($AdditionalAddress).'","'.trim($ServiceCity).'","'.trim($ServiceState).'","'.trim($ServiceZip).'","'.trim($RevenueYearMonth).'","'.trim($UtilityCode).'","'.trim($ServiceID).'","'.trim($Rate).'","'.trim($Meter).'","'.trim($Usage).'","'.trim($Amount).'","'.trim($TypeCode).'","'.trim($AdjustmentCode).'","'.trim($NumberOfDays).'","'.trim($PreviousReadDate).'","'.trim($CurrentReadDate).'","'.trim($ServiceCode).'":');      fwrite($file,$info);
        $lineCount = $lineCount +1;
    }
    echo $lineCount." lines";
    fclose($file);
    //http://www.aip.de/~weber/doc/mysql/manual_SQL_Syntax.html
    //Took out all of the column names and it now works correctly
        $insert_query = 'LOAD DATA  INFILE "../../www/upload/test.txt" INTO table USAGE_DOLLAR_TEMP2 FIELDS TERMINATED BY "," OPTIONALLY ENCLOSED BY "\"" LINES TERMINATED BY ":" ';
        //Try to insert the data into the database, if it doesn't work echo out the error
        $pdoInsert = $db->prepare($insert_query);
        $pdoInsert->execute();
        // if (!mysql_query($insert_query, $connect)) {
        //     echo "Can't insert  record : " . mysql_error($connect);
        // } else {
        //     echo "You have successfully insert records into  table";
        // }
        // //Close the connection so we aren't hanging the session
        // mysql_close($connect);
	}
	if($length == 380)
	{
		echo "<br>Usage Dollar File Old Format (2010-06 -- 2013-08) <br>";
	}
	if($length == 378)
	{
		echo "<br>Usage Dollar File Old Format (2007-01 -- 2010-05) <br>";
	}


}