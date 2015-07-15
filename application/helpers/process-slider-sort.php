<?php 
/**
 * Sort images in slideshows
 * 
 * This script is called by a jQuery function. It receives an array via $_POST.
 * That array is then serialized and added to a table in the database. 
 * 
 * @author     Cosmo Mathieu <cosmo@cosmointeractive.co>
 */ 
if ( ! defined('BASEPATH')) define('BASEPATH', 'Dummy');    // Getting rid of errors
if ( ! defined('APPPATH')) define('APPPATH', 'Dummy');      // Getting rid of errors

// Include core files
include_once "../config/config.php";
include_once "../../system/Config.php";
include_once "../../system/Database.php";
include_once "../helpers/functions_helper.php";

/**
 * Get values from POST and add them to memory. 
 */
parse_str($_REQUEST['order'],$order); 
// var_dump( $order );

$count = 1;
foreach ($order as $key=>$value) {
	foreach ($value as $key=>$ID) {
		// Sanitize variable
		// $ID = escape_and_addslashes( $ID ); 
		
		// Run query       
        $query = Database::getInstance()->update(
            "cimp_pageslider_entries", $ID,  array(
                'sort_id' => $count
            ), 
            'photo_id'
        );    
        
		$count++;	
	}
} 