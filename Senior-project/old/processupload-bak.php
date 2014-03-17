<?php
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
    //Check the length of the first line and print it out
    $length = strlen(fgets($fp));
    echo "<br>$length Length <br>";
	if($length == 165)
	{
		echo "<br>Fix Charge File Current Format (2013-09 -- Present) <br>";
		        echo "Fix Charge File <br>";
        $filler_1 = substr(fgets($fp),0,1);
        $account = substr(fgets($fp),1,7);
        $premiseNumber = substr(fgets($fp),8,15);
        $filler_2 = substr(fgets($fp),23,2);
        $revenueYearMonth = substr(fgets($fp),25,6);
        $filler_3 = substr(fgets($fp),31,2);
        $billDate = substr(fgets($fp),33,8);
        $filler_4 = substr(fgets($fp),41,2);
        $effectiveDate = substr(fgets($fp),43,8);
        $filler_5 = substr(fgets($fp),51,2);
        $end_date = substr(fgets($fp),53,8);
        $recordTypeCode = substr(fgets($fp),61,4);
        $description = substr(fgets($fp),65,61);
        $chargeQuantity = substr(fgets($fp),126,7);
        $billAmount = substr(fgets($fp),133,15);
        $fixChargeRate = substr(fgets($fp),148,15);

        echo "<br>Filler: $filler_1 <br>";
        echo "<br>Account: $account <br>";
        echo "<br>Premise Number: $premiseNumber <br>";
        echo "<br>Filler 2: $filler_2 <br>";
        echo "<br>Revenue Year Month: $revenueYearMonth <br>";
        echo "<br>Filler 3: $filler_3 <br>";
        echo "<br>Bill Date: $billDate <br>";
        echo "<br>Filler 4: $filler_4 <br>";
        echo "<br>Effective Date: $effectiveDate <br>";
        echo "<br>Filler 5: $filler_5 <br>";
        echo "<br>End Date: $end_date <br>";
        echo "<br>Record Type Code: $recordTypeCode <br>";
        echo "<br>Description: $description <br>";
        echo "<br>Charge Quantity: $chargeQuantity <br>";
        echo "<br>Bill Amount: $billAmount <br>";
        echo "<br>Fix Charge Rate: $fixChargeRate <br>";
	}
	if($length == 163)
	{
		echo "<br>Fix Charge File Old Format (2007-01 -- 2013-08) <br>";
	}
	if($length == 562)
	{
		echo "<br>Usage Only File Current Format (2013-09 -- Present) <br>";
		        echo "Usage Only File <br>";
        $premiseNumber = substr(fgets($fp),0,15);
        $filler = substr(fgets($fp),15,1);
        $account = substr(fgets($fp),16,7);
        $customerName = substr(fgets($fp),23,30);
        $filler_2 = substr(fgets($fp),53,2);
        $revenueYearMonth = substr(fgets($fp),55,6);
        $utilityCode = substr(fgets($fp),61,1);
        $filler_3 = substr(fgets($fp),62,1);
        $serviceId = substr(fgets($fp),63,20);
        $rate = substr(fgets($fp),83,5);
        $meter = substr(fgets($fp),88,10);
        $usage = substr(fgets($fp),98,17);
        $additionalUsage = substr(fgets($fp),115,17);
        $demandUsage = substr(fgets($fp),132,19);
        $serviceAddress = substr(fgets($fp),151,64);
        $additionalAddress = substr(fgets($fp),215,200);
        $serviceCity = substr(fgets($fp),415,22);
        $mailAddress = substr(fgets($fp),437,64);
        $mailCity = substr(fgets($fp),501,22);
        $mailStateCode = substr(fgets($fp),523,2);
        $mailZipCode = substr(fgets($fp),525,15);
        $previousReadDate = substr(fgets($fp),540,10);
        $currentReadDate = substr(fgets($fp),550,10);
        echo "<br>Premise Number: $premiseNumber <br>";
        echo "<br>Filler: $filler <br>";
        echo "<br>Customer Name: $customerName <br>";
        echo "<br>Filler 2: $filler_2 <br>";
        echo "<br>Revenue Year Month: $revenueYearMonth <br>";
        echo "<br>Utility Code: $utilityCode <br>";
        echo "<br>Filler: $filler_3 <br>";
        echo "<br>Service ID: $serviceId <br>";
        echo "<br>Rate: $rate <br>";
        echo "<br>Meter: $meter <br>";
        echo "<br>Usage: $usage <br>";
        echo "<br>Additional Usage: $additionalUsage <br>";
        echo "<br>Demand Usage: $demandUsage <br>";
        echo "<br>Service Address: $serviceAddress <br>";
        echo "<br>Additional Address: $additionalAddress <br>";
        echo "<br>Service City: $serviceCity <br>";
        echo "<br>Mail Address: $mailAddress <br>";
        echo "<br>Mail City: $mailCity <br>";
        echo "<br>Mail State: $mailStateCode <br>";
        echo "<br>Mail Zipcode: $mailZipCode <br>";
        echo "<br>Previous Read Date: $previousReadDate <br>";
        echo "<br>Current Read Date: $currentReadDate <br>";
	}
	if($length == 345)
	{
		echo "<br>Usage Only File Old Format (2007-01 -- 2013-08) <br>";
	}
	if($length == 604)
	{
		echo "<br>Usage Dollar File Current Format (2013-09 -- Present) <br>";
		echo "Usage Dollar Files <br>";
        $filler_1 = substr(fgets($fp),0,1);
        $account = substr(fgets($fp),1,7);
        $premiseNumber = substr(fgets($fp),8,15);
        $customerName = substr(fgets($fp),23,30);
        $mailAttention = substr(fgets($fp),53,30);
        $mailAddress = substr(fgets($fp),83,64);
        $mailCity = substr(fgets($fp),147,22);
        $mailStateCode = substr(fgets($fp),169,2);
        $mailZipCode = substr(fgets($fp),171,15);
        $ServiceAddress = substr(fgets($fp),186,64);
        $AdditionalAddress = substr(fgets($fp),250,200);
        $ServiceCity = substr(fgets($fp),450,22);
        $ServiceState = substr(fgets($fp),472,2);
        $ServiceZip = substr(fgets($fp),474,17);
        $RevenueYearMonth = substr(fgets($fp),491,6);
        $UtilityCode = substr(fgets($fp),497, 1);
        $Filler = substr(fgets($fp),498,1);
        $ServiceID = substr(fgets($fp),499, 20);
        $Rate = substr(fgets($fp),519, 5);
        $Meter = substr(fgets($fp),524,10);
        $Usage = substr(fgets($fp),534,17);
        $Amount = substr(fgets($fp),551, 17);
        $TypeCode = substr(fgets($fp),568, 3);
        $AdjustmentCode = substr(fgets($fp),571, 5);
        $NumberOfDays = substr(fgets($fp),576,5);
        $PreviousReadDate = substr(fgets($fp),581, 10);
        $CurrentReadDate = substr(fgets($fp),591, 9);
        $ServiceCode = substr(fgets($fp),600, 10);

        echo "<br>Filler: $filler_1 <br>";
        echo "Account: $account <br>";
        echo "Premise Number: $premiseNumber <br>";
        echo "Customer Name: $customerName <br>";
        echo "Mail Attention To: $mailAttention <br>";
        echo "Mail Address: $mailAddress <br>";
        echo "Mail City: $mailCity <br>";
        echo "Mail State Code: $mailStateCode <br>";
        echo "Mail Zip Code: $mailZipCode <br>";
        echo "Service Address: $ServiceAddress <br>";
        echo "Additional Address: $AdditionalAddress <br>";
        echo "Service City: $ServiceCity <br>";
        echo "Service State: $ServiceState <br>";
        echo "Service Zip: $ServiceZip <br>";
        echo "Revenue Y/M: $RevenueYearMonth <br>";
        echo "Utility Code: $UtilityCode <br>";
        echo "Filler: $Filler <br>";
        echo "Service ID: $ServiceID <br>";
        echo "Rate: $Rate <br>";
        echo "Meter: $Meter <br>";
        echo "Usage: $Usage <br>";
        echo "Amount: $Amount <br>";
        echo "Type Code: $TypeCode <br>";
        echo "Adjustment Code: $AdjustmentCode <br>";
        echo "Number of Days: $NumberOfDays <br>";
        echo "Previous Read Date: $PreviousReadDate <br>";
        echo "Current Read Date: $CurrentReadDate <br>";
        echo "Service Code: $ServiceCode <br>";
	}
	if($length == 380)
	{
		echo "<br>Usage Dollar File Old Format (2010-06 -- 2013-08) <br>";
	}
	if($length == 378)
	{
		echo "<br>Usage Dollar File Old Format (2007-01 -- 2010-05) <br>";
	}

	

    //header('Location: second_script.php'); // go to other




	// 	/*
	// 	// Insert info into database table!
	// 	mysql_query("INSERT INTO myImageTable (ImageName, ThumbName, ImgPath)
	// 	VALUES ($DestRandImageName, $thumb_DestRandImageName, 'uploads/')");
	// 	*/

}


