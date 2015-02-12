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
 * Autoload Objects
 *
 * Autoload Objects with files located in the libraries and system folders only.
 * File names must math the name of the Object defined within to be autoloaded.
 * 
 * @param        string $class Object name to be invoked. 
 */
spl_autoload_register(function($class) {
    
    if (file_exists(APPPATH . 'libraries/' . $class . '.php')) {
        require_once APPPATH . 'libraries/' . $class . '.php';        
    } elseif(file_exists(SYSDIR . '/' . $class . '.php')) {
        require_once SYSDIR . '/' . $class . '.php';
    }
});

/**
 * Autoload Configuration files
 * 
 * Anything in this array will be loaded automatically. 
 *
 * @see        ./application/config/autoload.php for a complete list
 */
foreach($autoload['config'] as $helper) {
    require_once APPPATH . 'config/' . $helper . '.php';
}

/**
 * Autoload Language files
 * 
 * Anything in this array will be loaded automatically. 
 *
 * @see        ./application/config/autoload.php for a complete list
 */
foreach($autoload['language'] as $helper) {
    require_once APPPATH . 'language/' . $helper . '.php';
}

/**
 * Autoload Model files
 * 
 * Anything in this array will be loaded automatically. 
 *
 * @see        ./application/config/autoload.php for a complete list
 */
foreach($autoload['model'] as $helper) {
    require_once APPPATH . 'models/' . $helper . '_model.php';
}

/**
 * Autoload Helpers
 * 
 * Anything in this array will be loaded automatically. 
 *
 * @see        ./application/config/autoload.php for a complete list
 */
foreach($autoload['helper'] as $helper) {
    require_once APPPATH . 'helpers/' . $helper . '.php';
}

/* End of file autoloader.php */
/* Location: ./system/autoloader.php */