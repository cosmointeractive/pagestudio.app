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
 * Application Controller View Class
 *
 * Loads view files and sends final output to browser
 *
 * @package		PageStudio
 * @author		Cosmo Mathieu
 */
class MY_View //extends View
{
    /**
     *
     * @access     private
     */
	private $pageVars = array();
    /**
     *
     * @access     private
     */
    private $template;
    
    /**
	 * Constructor
	 *
	 * Sets the path to the view files
	 */
	public function __construct($template, $module = 'site')
	{
		$this->template = APPPATH .'modules/'.$module.'/views/'. $template .'.php';
	}

	public function set($var, $val)
	{
		$this->pageVars[$var] = $val;
	}
    
    /** 
     * Provides a way to add page level view css files
     * 
     * @access      Public 
     */
    public function addCSS($array = '')
    {
        $this->pageLevelCSS = $array;
    }
    
    /** 
     * Provides a way to add page level view js files
     * 
     * @access      Public 
     */
    public function addJS($array = '')
    {
        $this->pageLevelJS = $array;
    }
    
    /** 
     * Provides a way to add page level view javascript function files
     * 
     * @access      Public 
     */
    public function addScript($array = '')
    {
        $this->pageLevelScript = $array;
    }
        
    // Return the page level css files in an array
    public function pageCSS()
    {
        return ! empty($this->pageLevelCSS) ? $this->pageLevelCSS : '';
    }
    
    // Return the page level css files in an array
    public function pageJS()
    {
        return ! empty($this->pageLevelJS) ? $this->pageLevelJS : '';
    }
    
    // Return the page level css files in an array
    public function pageScript()
    {
        return ! empty($this->pageLevelScript) ? $this->pageLevelScript : '';
    }
    
    /**
     * Returns the content of the model to the viewer
     * 
     * @array       $pageVars Array containing elements to be displayed
     * @param       $template Variable to be displayed to the viewport   
     */
	public function render()
	{
		extract($this->pageVars);

		ob_start();
		require($this->template);
		echo ob_get_clean();
	}
}

/* End of file MY_View.php */
/* Location: ./application/libraries/MY_View.php */