<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css" />
</head>
<body>
<?php
require_once('../login/config.php');

if (isset($_POST["numero_rue"])){
	$nom = $_POST["nom"];
	$num_rue = $_POST["numero_rue"];
	$addr = $_POST["nom_adresse"];
	$cp = $_POST["code_postal"];
	$ville = $_POST["ville"];
	$pays = $_POST["pays"];

	$data = [
		'numero_rue' => $num_rue,
		'nom_adresse' => $addr,
		'code_postal' => $cp,
		'ville' => $ville,
		'pays' => $pays
	];
	$query = "INSERT into adresses (numero_rue, nom_adresse, code_postal, ville, pays)
				VALUES (:numero_rue, :nom_adresse, :code_postal, :ville, :pays)";
	$createdId = db_insert($query, $data);

	$data = [
		'nom' => $nom,
		'adresse_id' => $createdId,
	];
	$query = "INSERT into boutiques (nom, adresse_id)
				VALUES (:nom, :adresse_id)";
	$res = db_insert($query, $data);
}
else {
	header('Location: ../index.php');
	exit;
}
	header('Location: ../pages/boutique.php');
