<?php
header('Access-Control-Allow-Origin: *');
error_reporting(0);
require_once('../../../includes/funcoes.php');
require_once('../../../database/config.database.php');
require_once('../../../database/config.php');

if (isset($_GET['Status'])) {
	$Query = DBUpdate('slide_produtos', ['status'=>$_GET['Status']], "id = '{$_GET['id']}'");
}