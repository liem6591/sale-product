<?php
$random = date("U") ;
file_get_contents("http://www.smarteseller.com/saleProduct/index.php/taskAsynAmazon/listOrders/5?".$random);