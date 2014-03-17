
<?php
//PHP script to take uploaded files and move them to the /uploads directory
//http://us1.php.net/manual/en/reserved.variables.files.php

  if ($_FILES["file"]["error"] > 0) //Check to see if there is a file error 
    {
    	// Print out the error code if there is one.
    	echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
    // If no error proceed with the script
  else 
	{
		// Print out the uploaded name, type, size, and temp file name
	    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
	    echo "Type: " . $_FILES["file"]["type"] . "<br>";
	    echo "Size: " . ($_FILES["file"]["size"] / 200000) . " kB<br>";
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
    echo "$length Length ";
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
    $ServiceCity = substr(fgets($fp),451,22);
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
    $TypeCode = substr(fgets($fp),566, 3);
    $AdjustmentCode = substr(fgets($fp),569, 5);
    $NumberOfDays = substr(fgets($fp),574,5);
    $PreviousReadDate = substr(fgets($fp),580, 10);
    $CurrentReadDate = substr(fgets($fp),590, 10);
    $ServiceCode = substr(fgets($fp),599, 10);

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
    echo "Additional Address: $AdditonalAddress <br>";
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


	
	//Iterate through the open file and count the lines in it
    while ( ($line = fgets($fp)) !== false) 
    {
      $i = $i + 1;
    }
    // Print out the number of lines in the file. 
    echo "$i Lines <br>";
   
?> 
   
   
   