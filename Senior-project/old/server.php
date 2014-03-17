<?php 
/*set default number if user forgot to enter one. */
$num = 10000;
 if(isset($_REQUEST['num'])){
     $num = intval($_REQUEST['num']);
 } //create jason file and put default 0 values. we will update these values later 
 $filename = 'status1.json';
 $fp = fopen($filename, "w");
 $arr = array('total'=-->'0', 'current'=>'0');

fwrite($fp, json_encode($arr));

fclose($fp);


//update the total
$arr['total'] = $num;

//start our simple main logic, ie...start counting. we will start counting from 1 till the num+1. since I am using $i<$num, thats why i add +1 here.
for($i = 1; $i < $num+1; $i++){
    //here you can do some other work as well.    
  $arr['current'] = "$i";
    
  $fp = fopen($filename, "w");
    
  fwrite($fp, utf8_encode(json_encode($arr)));
    
  fclose($fp);
    
  //for safety we will make a copy and let client access the copy.    
  copy('status1.json', 'status.json');
 
} 
?>
