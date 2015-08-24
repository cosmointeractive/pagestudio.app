<?php
/** 
 *
 * @author     Cosmo Mathieu <cosmo@cosmointeractive.co>
 * @source     http://fullcalendar.io/views/month/
 */ 
if ( ! defined('BASEPATH')) define('BASEPATH', 'Dummy');    // Getting rid of errors
if ( ! defined('APPPATH')) define('APPPATH', 'Dummy');      // Getting rid of errors

// Include core files
// include_once "../../../config/config.php";
// include_once "../../../../system/Config.php";
// include_once "../../../../system/Database.php";
// include_once "../../../helpers/functions_helper.php";

// List of events
$events = '';

// Query that retrieves events
$sql = "SELECT * FROM evenement ORDER BY id";

// connection to the database
try {
	$query = new PDO('mysql:host=localhost;dbname=projects_auto_draft', 'jonah', 'jonah213');
} catch(Exception $e) {
	exit('Unable to connect to database.');
}
// Execute the query
$result = $query->query($sql) or die(print_r($query->errorInfo()));

// sending the encoded result to success page
echo json_encode($result->fetchAll(PDO::FETCH_ASSOC));
// echo '[{"id":"24","title":"Balling out","description":"Lorem ipsum asi dolor","start":"2015-07-14T21:54:41","end":"2015-07-14T21:54:41","url":"","allDay":"","repeat":"0","series_id":"0"}]';

// while ($row = $result->fetch(PDO::FETCH_ASSOC))
// {
    // $events  = '{';
	// $events .= " id: " 			. "'" .$row['id'] . "',";	
    // $events .= " title: " 		. "'" .$row['title'] . "',";
    
    // if( ! empty($row['url'])) {
        // $events .= " url: " 		. "'" .$row['url'] . "',";
    // }
    
	// //$events .= " description: " . "'" .$row['description'] . "',";
    // $start = strtotime($row['start']);
    // if($row['allDay'] === 'true' || $row['end'] === '0000-00-00 00:00:00') {
        // $events .= " start: " 		. "'" . date('Y-m-d', $start) ."'";
    // } else {    
        // $events .= " start: " 		. "'" . date('Y-m-d', $start) . 'T' . date('H:i:s', $start) . "',";
    // }
    
    // if( ! empty($row['end'])) {
        // if($row['allDay'] !== 'true') {
            // if($row['end'] !== '0000-00-00 00:00:00') {
                // $end = strtotime($row['end']);
                // $events .= " end: " 		. "'" . date('Y-m-d', $end) . 'T' . date('H:i:s', $end) . "',";
            // }
        // }
    // }
    
    // if( ! empty($row['description'])) {
        // $events .= " description: " . "'" . $row['description'] . "',";
    // }
    
    
    
	// //$events .= " allDay: " 	    . "'" .$row['allDay'] . "',";
	// $events .= '},';	
    // echo $events;
// }
