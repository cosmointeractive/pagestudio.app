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
 * This class in essence functions as a router class
 * Forward page request to the appropriate module/controlelr 
 * @note        This may end up being part of the Public_Controller in the future
 */
class Addons extends MY_Controller
{	

	public function index()
	{
        
	}
    
    public function load()
    {
        $this->loadAddon(Url::segment(2), Url::segment(3));
    }
    
    /**
     * Load the appropriate controller based on the url slug
     *
     * @access     public 
     * @var        string $segment The first segment if the url minus the base_path
     * @var        string [optional] $method Method to load 
     */
    public function loadAddon($segment, $method)
    {
        $method         = ( !empty($method)) ? $method : 'index';
        $pageController = array();
        
        // @note    Load a list of pages from the database and save them in an array
        // @note    Consider populating $pageController array with data from a database
        switch($segment) {            
            case 'sliders' : $pageController = array(
                'module' => 'sliders',
                'controller' => 'sliders',
                'method' => $method
            );
            break;
            
            // default : $pageController = array(
                // 'module' => 'site',
                // 'controller' => 'pages',
                // 'method' => 'index'
            // );
            // break;
        }
        // This will error to the 404 page if the module/controller is not found
        $this->loadModule($pageController['module'] . '/' . $pageController['controller']);
        $object = ucfirst($pageController['controller']);
        $pages = new $object;
        
        /**
         * Check if called method exists. Load 404 if not found.
         * 
         * @param     object $pages 
         * @param     method $method
         */ 
        if(method_exists($pages, $method) !== false) {
            $pages->$method();
        } else {
            $this->redirect('error');
        }
    }
    
    /**
     * Method to manually load modules
     *
     * @access      public
     * @var         string $name The plugin file name (minus the extension 
     *              e.g. .php) to load
     */
	public function loadModule($name)
	{
        $split    = explode('/', $name);
        $folder   = $split[0];
        $filename = $split[1];
		$file     = APPPATH .'modules/'. strtolower($folder) .'/controllers/'. strtolower($filename) .'.php';
        
        if( ! file_exists($file)) {
            // File Not found!
            $this->redirect('error');
        }
        
        require $file;
	}
    
    /**
     * Method to manually load models
     *
     * @access      public
     * @var         array $data The Module name and Model name.
     */
    public function loadModel($data)
	{
        $module = $data['module'];
        $name   = ucfirst($data['model']);
        
		require APPPATH . 'modules/' . $module .'/models/'. strtolower($name) .'.php';

		$model = new $name;
		return $model;
	}
    
    public function loadView($name, $module = 'site')
	{
		$view = new MY_View($name, $module);
		return $view;
	}
    
    /**
     * Method to load a helper file 
     *
     * @param       string $name
     * @return      mixed
     */
    public function loadHelper($name)
    {        
        $file = APPPATH . 'helpers/' . strtolower($name) . '_helper.php';
        
        if( file_exists($file) ) {            
            require_once $file;
        } else {
            return false;
        }
    }
    
    /**
     * Method to check the method being requested exists
     *
     * @param       string $method
     * @param       array $args
     * @return      mixed
     */
    // public function __call($method, $args)
    // {
        // if(method_exists($this, $method)) {
            // return call_user_func_array(array($this, $method), $args);
        // } else {
            // $this->error[] = 'The required method <b>' . $method .'</b> does not exist.';
            
            // $template = $this->loadView('error_view');
            // $template->set('page', array(
                // 'title' => '404 Error',
                // 'heading' => '404 Error',
                // 'message' => $this->error
            // ));
            // $template->render();
        // }
    // }

}

/* End of file addons.php */
/* Location: ./application/controllers/addons.php */