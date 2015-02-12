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
 * Custom class to extend the default Controller. 
 * Provides a means to add functionality without hacking at the framework's core
 */
class Public_Controller extends Controller 
{	
    /**        
     * @var     array Array to store error values
     */
    private $error = array();
    
    public function __construct()
    {
        parent::__construct();
        
        // $this->init();
    }

	public function init()
	{
       
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
        $split = explode('/', $name);
        $module = $split[0];
        $moduleController = $split[1];
		require APPPATH .'modules/'. strtolower($module) .'/controllers/'. strtolower($moduleController) .'.php';
	}
    
    /**
     * Method to check the method being requested exists
     *
     * @param       string $method
     * @param       array $args
     * @return      mixed
     */
    public function __call($method, $args)
    {
        if(method_exists($this, $method)) {
            return call_user_func_array(array($this, $method), $args);
        } else {
            $this->error[] = 'The required method <b>' . $method .'</b> does not exist.';
            
            $template = $this->loadView('error_view');
            $template->set('page', array(
                'title' => '404 Error',
                'heading' => '404 Error',
                'message' => $this->error
            ));
            $template->render();
        }
    } 
    
}

/* End of file Public_Controller.php */
/* Location: ./application/libraries/Public_Controller.php */