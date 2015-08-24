<?php
/**
 * PageStudio
 *
 * A web application for managing website content. For use with PHP 5.4+
 * 
 * This application is based on the PHP framework, 
 * PIP http://gilbitron.github.io/PIP/. PIP has been greatly altered to 
 * work for the purposes of our development team. Additional resources 
 * and concepts have been borrowed from CodeIgniter,
 * http://codeigniter.com for further improvement and reliability. 
 *
 * @package     PageStudio
 * @author      Cosmo Mathieu <cosmo@cosmointeractive.co>   
 */
 
// ------------------------------------------------------------------------

/** 
 * method to retrieve an array of events from the database
 *
 * @source     http://fullcalendar.io/views/month/
 */ 
if ( ! defined('BASEPATH')) define('BASEPATH', 'Dummy');    // Getting rid of errors
if ( ! defined('APPPATH')) define('APPPATH', 'Dummy');      // Getting rid of errors

// Include core files
include_once "../../../config/config.php";
include_once "../../../../system/Config.php";
include_once "../../../../system/Database.php";
include_once "../../../helpers/functions_helper.php";

// List of events
$events = '';

// Query that retrieves events
$sql = "SELECT * FROM cimp_calendar ORDER BY id";

// $query = Database::getInstance()->query(
	// "SELECT * FROM cimp_pages WHERE page_slug = ?", array('name')
// );

// if( ! $query->count()) {
	// //echo 'No record found';
// } else {            
	// return $query->results();
// }

// connection to the database
try {
	$query = new PDO('mysql:host=localhost;dbname=projects_pagestudio_v2', 'jonah', 'jonah213');
} catch(Exception $e) {
	exit('Unable to connect to database.');
}
// Execute the query
$result = $query->query($sql) or die(print_r($query->errorInfo()));

// sending the encoded result to success page
echo json_encode($result->fetchAll(PDO::FETCH_ASSOC));
// echo '[{"id":"24","title":"Balling out","description":"Lorem ipsum asi dolor","start":"2015-07-14T21:54:41","end":"2015-07-14T21:54:41","url":"","allDay":"","repeat":"0","series_id":"0"}]';
?>