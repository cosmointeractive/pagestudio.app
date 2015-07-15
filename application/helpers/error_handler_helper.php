<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
 * @author      Cosmo Mathieu <cosmo@cimwebdesigns.com>   
 */
 
// ------------------------------------------------------------------------

/**
 * Custom error handler
 * 
 * Provides a method to log errors to a log file when the development 
 * environment is set to production or testing.
 * 
 * @author     thanosb
 * @author     ddonahue
 * @author     Cosmo Mathieu <cosmo@cosmointeractive.co>
 * @version    0.0.4
 * 
 * @param      $errno Error level
 * @param      $errstr Error message
 * @param      $errfile File in which the error was raised
 * @param      $errline Line at which the error occurred
 *
 * @note	   Future consideration calls to turn this function into a class. 
 *             Resources to consider: 
 * 			   http://www.phpclasses.org/package/3890-PHP-Handle-PHP-scripts-execution-errors.html
 * @note       Error levels http://www.w3schools.com/php/php_error.asp
 */ 
function my_error_handler($errno, $errstr, $errfile, $errline)
{  
    // FORMAT Server date to [11-Nov-2011 20:54:23]
	$date_1     = date("d-M-Y G:i:s", time ()); 
    // FORMAT server date to [Fri 2:35pm]
	$date_2     = date("D g:i:s a", time ()); 	
	$TIME_STAMP = '['.$date_1.'] ['.$date_2.']';
    $error_log  = APPPATH . 'logs/' . Config::get('logs/error');

	switch ($errno) 
	{
		case E_USER_ERROR:
			// Send an e-mail to the administrator
			error_log("Error: $errstr \n Fatal error on line $errline in file $errfile \n", 
                1, 
                'cosmo@cimwebdesigns.com'
            );

			// Write the error to our log file
			error_log("Error: $errstr \n Fatal error on line $errline in file $errfile \n", 
                3, 
                $error_log
            );
		break;

		case E_USER_WARNING:
			// Write the error to our log file
			error_log("Warning: $errstr \n in $errfile on line $errline \n", 
                3, 
                $error_log
            );
			break;

		case E_USER_NOTICE:
			// Write the error to our log file
			error_log("Notice: $errstr \n in $errfile on line $errline \n", 
                3, 
                $error_log
            );
		break;
	
		default:
			// Write the error to our log file
			error_log($TIME_STAMP." Unknown error [#$errno]: $errstr in $errfile on line $errline \n", 
                3,
                $error_log
            );
		break;
	}
 
    // Don't execute PHP's internal error handler
    return true;
}

/**
 * Use set_error_handler() to tell PHP to use our method
 */
if(defined('ENVIRONMENT')) {
    switch ( ENVIRONMENT ) 
    {
        case 'development':
            error_reporting(E_ALL);
            ini_set("display_errors", 1);
        break;
            
        case 'testing':
		case 'production':
            error_reporting(0);
            ini_set("display_errors", 0);
            set_error_handler("my_error_handler");
        break;
    }	
}

function log_message($key, $item, $file = null, $line = null) {
    my_error_handler($key, $item, $file, $line);
}

/* End of file error_handler_helper.php */
/* Location: ./application/helpers/error_handler_helper.php */