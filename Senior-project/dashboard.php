<!--  -->

    
<?php require('connect.php'); include('nav.php');?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class=""><a href="#">Accounts</a></li>
          <?php $sql = "select distinct ACCOUNT_CODE from ACCOUNT_SOCKET_METER limit 15";

            $pdoSelect = $db->prepare($sql);
            $pdoSelect->execute();
            $accounts = $pdoSelect->fetchAll();
            if(isset($_GET["accountID"]))
            {
              $curAccountId = $_GET["accountID"];
            }else{
              $curAccountId = 1;
            }
            foreach($accounts as $row)
            {
             echo '<li><a id="'.$row['ACCOUNT_CODE'].'" href="#" class="clickListen">'.$row['ACCOUNT_CODE'].'</a></li>';
              
            }
            ?>

          </ul>
          
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Account Information</h1>
              <div id="mainInfo">   <?php
              $getInfo = file_get_contents("http://localhost/getMeterInfo.php");
                echo $getInfo;?> 
              </div>
          <div class="row placeholders">
            <div class="col-xs-6 col-sm-3 placeholder">

            </div>
    
          </div>


        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/docs.min.js"></script>
  </body>
</html>
