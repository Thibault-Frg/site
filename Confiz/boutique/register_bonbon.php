<?php
session_start();
include_once 'header.php';
require_once('../login/config.php');

if (isset($_POST["nom"])){
	$nom = $_POST["nom"];
	$type = $_POST["type"];
	$prix = $_POST["prix"];

	$data = [
		'nom' => $nom,
		'type' => $type,
		'prix' => $prix,
	];
	$query = "INSERT into confiseries (nom, type, prix)
				VALUES (:nom, :type, :prix)";
	$createdId = db_insert($query, $data);
}
else {
	header('Location: ../index.php');
	exit;
}
	header('Location: ../pages/catalogue.php');


include_once 'footer.php';
