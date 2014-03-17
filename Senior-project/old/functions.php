<?php
function identifyFile ($fileName)
{
	$fp = fopen($fileName, 'rb');
	$fileLength = strlen(fgets($fp));

	file_put_contents("upload/test.txt", "");
    //Open the temp file
    $file = fopen("upload/test.txt","w");

	if($length == 165)
	{
        $fieldArray = array("account","premisenumber","revenueYearMonth","billDate","effectiveDate","endDate","recordTypeCode","description","chargeQuantity","billAmount","fixChargeRate");
        $positionArray = array(1,8,25,33,43,53,61,65,126,133,148);
        $lengthArray = array(7,15,6,8,8,8,4,61,7,15,15);
        while ( ($line = fgets($fp)) !== false) 
        {

    	}


	}
}




?>