<?php
require('connect.php');
 
if(isset($_GET["accountID"]))
{
	$curAccountId = $_GET["accountID"];
}else{
	$curAccountId =1;
}

$sql = "select distinct ACCOUNT_CODE, METER_CODE, SOCKET_CODE from ACCOUNT_SOCKET_METER WHERE ACCOUNT_CODE = :account";

$pdoSelect = $db->prepare($sql);
$pdoSelect->execute(array(':account' => $curAccountId));
$Result= $pdoSelect->fetchAll();

$pdoSelect2 = $db->prepare($sql);
$pdoSelect2->execute(array(':account' => $curAccountId));
$Result2= $pdoSelect->fetch();

// echo '<h2>Account Details</h2>';
if($Result)
{
	
	    ?><h2 class="sub-header"><?php echo '<h3>Account: '.$curAccountId.'</h3>';?></h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
    
                  <th>Meter</th>
                  <th>Socket</th>
                
                </tr>
              </thead>
              <tbody>
              	<?php 	foreach($Result as $row)
	{
echo '<tr><td>'.$row['METER_CODE'].'</td>';
echo '<td>'.$row['SOCKET_CODE'].'</td></tr>';
		// echo '<p><strong>Meter:</strong> '.$row['METER_CODE'].'  <br><strong>Socket:</strong> '.$row['SOCKET_CODE'].'</p>';
	}
                
                //   <td>1,001</td>
                //   <td>Lorem</td>
                // </tr> 
                ?>
              </tbody>
            </table>
          </div>
<?php
}

else {
	echo '<p>Please select an account!</p>';
}
?>
