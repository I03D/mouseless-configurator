<?php
session_start();
if(!isset($_POST['page'])) {
	# $_SESSION["saved_data"] = $_POST["input_data"];
	$_POST['page'] = 'editor';
}

# Удаление по "?delete=allConfirmed":
if($_POST["delete"] == "allConfirmed") {
	$_SESSION['code'] = NULL;
}

# Code обычно отсутствует из-за новой сессии
# или из-за "?delete=allConfirmed":
if (!isset($_SESSION['code'])) {
	$filePath = 'scripts/config.yaml';
	
	$_SESSION['code'] = file($filePath);

}

# print_r($_SESSION['code']);
?>