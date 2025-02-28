<?php
$db = "(DESCRIPTION =
    (ADDRESS = (PROTOCOL = TCP)(HOST = 10.10.2.136)(PORT = 1521))
    (CONNECT_DATA =
      (SERVER = DEDICATED)
      (SERVICE_NAME =  YRU)
    )
  )";
	$objConnect = oci_connect("eduservice","dv'[ibdki",$db, "AL32UTF8");
		if($objConnect)
		{
		//	echo "<font color='green'>Connected....<br></font>";
		}
		else
		{
			echo "<font color='red'>Can't connect to Server<br></font>";
		}
?>