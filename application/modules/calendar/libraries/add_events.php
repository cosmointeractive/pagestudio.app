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

/**
 * Remove AM/PM from string 
 *
 * @param        string $string (Required) The string to be processed
 *
 * @return       string
 */
if( ! function_exists('remove_am_pm')) {    
	function remove_am_pm($string) {
		$array = array(
			'AM' => '',
			'PM' => ''
		);

		return $string = trim(strtr( $string, $array ));
	}
}

// Values received via ajax
$title  	  = $_POST['event_title'];
$description  = $_POST['event_description'];
$start  	  = $_POST['event_start'];
$end    	  = $_POST['event_end'];
$start 		  = date('Y-m-d H:i:s', strtotime(remove_am_pm($start)));
$end 		  = date('Y-m-d H:i:s', strtotime(remove_am_pm($end)));

// connection to the database
try {
	$bdd = new PDO('mysql:host=localhost;dbname=projects_pagestudio_v2', 'jonah', 'jonah213');
} catch(Exception $e) {
	exit('Unable to connect to database.');
}

// insert the records
$sql = "INSERT INTO cimp_calendar (title, description, start, end) VALUES (:title, :description, :start, :end )";
$q = $bdd->prepare($sql);
$q->execute(array(':title'=>$title, 'description'=>$description, ':start'=>$start, ':end'=>$end));
?>