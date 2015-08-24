<?php
$id = $_POST['id'];
try {
	$bdd = new PDO('mysql:host=localhost;dbname=projects_pagestudio_v2', 'jonah', 'jonah213');
} catch(Exception $e) {
	exit('Unable to connect to database.');
}
$sql = "DELETE FROM cimp_calendar WHERE id=".$id;
$q = $bdd->prepare($sql);
$q->execute();
?>
