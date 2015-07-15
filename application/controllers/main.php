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
 * Forward page request to the appropriate module/controller 
 * @note        This may end up being part of the Public_Controller in the future
 */
class Main extends Public_Controller
{	

	public function index()
	{        
		// $bc = new Breadcrumb();
        
        // no special book is requested, we'll show a list of all available books
		// $template = $this->loadView('main_view');
        // $template->set('bread', $bc->makeBread());
		// $template->render();
        // $this->loadModule('site/pages');
        // $pages = new Pages();
        
        $this->loadContent(Url::segment(0));
	}
    
    /**
     * Load the appropriate controller based on the url slug
     *
     * @access      public 
     * @var         string $segment The first segment if the url minus the base_path
     */
    public function loadContent($segment)
    {
        $pageController = array();
        
        // @note    Load a list of pages from the database and save them in an array
        // @note    Consider populating $pageController array with data from a database
        switch($segment) {            
            case 'contact' : $pageController = array(
                'module' => 'site',
                'controller' => 'contact',
                'method' => 'index'
            );
            break;
            
            case 'blog' : $pageController = array(
                'module' => 'site',
                'controller' => 'blog',
                'method' => 'index'
            );
            break;
            
            default : $pageController = array(
                'module' => 'site',
                'controller' => 'pages',
                'method' => 'index'
            );
            break;
        }
        // This will error to the 404 page if the module/controller is not found
        $this->loadModule($pageController['module'] . '/' . $pageController['controller']);
        $object = ucfirst($pageController['controller']);
        $pages = new $object;
        
    }

}

/* End of file main.php */
/* Location: ./application/controllers/main.php */