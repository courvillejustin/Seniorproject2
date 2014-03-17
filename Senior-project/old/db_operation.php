<?php
/* tracking file */
$myFile = $_SERVER['DOCUMENT_ROOT']."/tmp/testFile.txt";
$fh = fopen($myFile, 'r');
/* get current value - needed for preventing from repeated execution */
$theData = fread($fh, 5);
fclose($fh);

if (!$theData || $theData == 100):
for ($i=0;$i<=100;$i++)
{
   sleep(1);
   /* round to the lowest value */
   $progress_status = floor($i/100*100);
   /* write new value to file */
   $fh = fopen($myFile, 'w') or die("can't open file");
   fwrite($fh, $progress_status);
   fclose($fh);
}
else:
print 'Another process is running';
endif;
?>