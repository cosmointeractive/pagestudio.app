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
 * Bootstrap file
 *
 * This function invokes all default objects and models. It is ran by the
 * default index.php located in the root directory. It also serves as our
 * url router.
 *
 * @note       Consider renaming this function to init() or create a route class.
 *
 * @package    PageStudio
 * @author     Cosmo Mathieu <cosmo@cimwebdesigns.com>
 */
function pip()
{
    // Set our defaults
    $controller = Config::get('default_controller');
    $action     = 'index';
    $url        = '';

	// Get request url and script url
	$request_url = (isset($_SERVER['REQUEST_URI'])) ? parse_url(strtolower($_SERVER['REQUEST_URI'])) : '';
	$script_url  = (isset($_SERVER['PHP_SELF'])) ? $_SERVER['PHP_SELF'] : '';

	// Get our url path and trim the / of the left and the right
    if($request_url != $script_url) {
        $url = trim(preg_replace(
            '/'. str_replace(
                    '/', '\/', strtolower(str_replace('index.php', '', $script_url))
                ) .'/', '', $request_url['path'], 1
            ), '/'
        );
    }

	// Split the url into segments
	$segments = explode('/', $url);

	// Do our default checks
	if(isset($segments[0]) && $segments[0] != '') {
        $controller = $segments[0];
    }

	if(isset($segments[1]) && $segments[1] != '') {
        $action = $segments[1];
    }

	// Get our controller file
    $path = APPPATH . 'controllers/' . $controller . '.php';
	if( file_exists($path) ) {
        require_once $path;
	} else {
        // $controller = Config::get('error_controller');
        $controller = Config::get('default_controller');
        require_once APPPATH . 'controllers/' . $controller . '.php';
	}

    // Check if the action exists
    if( ! method_exists($controller, $action)) {
        // $controller = Config::get('error_controller');
        $controller = Config::get('default_controller');
        require_once APPPATH . 'controllers/' . $controller . '.php';
        $action = 'index';
    }

	// Create object and call method
	$obj = new $controller;
    die(call_user_func_array(
            array($obj, $action),
            array_slice($segments, 2)
        )
    );
}

/* End of file pip.php */
/* Location: ./system/pip.php */