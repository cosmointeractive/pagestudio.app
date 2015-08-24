<?php

/* Values received via ajax */
$id     = $_POST['id'];
$title  = $_POST['title'];
$start  = $_POST['start'];
$end   = $_POST['end'];
//$allDay = $_POST['allDay'];

// connection to the database
try {
	$bdd = new PDO('mysql:host=localhost;dbname=projects_pagestudio_v2', 'jonah', 'jonah213');
} catch(Exception $e) {
	exit('Unable to connect to database.');
}
 // update the records
if($end !== 'Invalid date') {
    if($end !== '0000-00-00 00:00:00') {
        $sql = "UPDATE cimp_calendar SET title=?, start=?, end=? WHERE id=?";
        $q = $bdd->prepare($sql);
        $q->execute(array($title, $start, $end, $id));
    }
} else {
    $sql = "UPDATE cimp_calendar SET title=?, start=? WHERE id=?";
    $q = $bdd->prepare($sql);
    $q->execute(array($title, $start, $id));
}