<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 2/6/14
 * Time: 1:06 PM
 */

//connect to the database
$dsn = "mysql:host=localhost;dbname=seniorproject";
$username = "root";
$password = "428f448c01!";
// $connect = mysql_connect("localhost","root","428f448c01!");
// mysql_select_db("seniorproject",$connect); //select the table
try 
{
	$db = new PDO($dsn, $username, $password);
} catch (PDOException $exc){
	$errorConnect = $exc->getMessage();
	echo "COULD NOT CONNECT TO DATABASE BECAUSE: ".$errorConnect;
}

?>