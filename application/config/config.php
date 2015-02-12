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
 * Application Configuration
 *
 * This is the new method to register our config
 *
 *-------------------------------------------------------------------------
 * Explanation of variables
 *-------------------------------------------------------------------------
 * [base_url]           URL to your application root including trailing slash
 *                      e.g. http://example.com/ or http://localhost/
 *                      If this is not set the application will throw an error
 *
 * [default_controller] Default controller to load
 * [error_controller]   Controller used for errors (e.g. 404, 500 etc)
 * [host]               Database host (e.g. localhost)
 * [db]                 Database to access
 * [remember]           Array of $_COOKIE variables
 * [cookie_name]
 * [cookie_expiry]      Lifespan of cookie variables
 * [session]            Array of $_SESSION variables
 * [session_id]
 * [session_name]   
 * [session_token]   
 * [token_salt]   
 *
 * @source     https://www.youtube.com/watch?v=JQkfAdZbAJE
 * @global     mixed $GLOBALS['config'] Holder of all configuration variables
 */
$GLOBALS['config'] = array(    
    'base_url' => 'http://localhost/projects/pagestudio_v2.0/',
    'default_controller' => 'main',    
    'admin_controller' => 'admin',    
    'error_controller' => 'error',    
    'mysql' => array(
        'host'      => 'localhost',
        'db'        => 'projects_pagestudio_v2',
        'username'  => 'jonah',
        'password'  => 'jonah213'
    ), 
    'remember' => array(
        'cookie_name'   => 'hash',
        'cookie_expiry' => 604800,
        'cookie_path' => ''
    ),
    'session' => array(
        'session_id'    => '',
        'session_name'  => 'user',
        'session_token' => 'token',
        'user_id' => '',
        'token_salt'    => 'Zizo4740'
    ), 
    'logs' => array(
        'access'    => 'access.log',
        'error'     => 'error.log'
    )
);

/* End of file config.php */ 
/* Location: ./system/config.php */