<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
 * Method to build follow links otherwise known as breadcrumb
 * 
 * @info        Consider using https://bitbucket.org/ardinotow/autocrumb/src/7d5b608a894182d4ea2fa6d4b852a6b085e6f54a/helpers/breadcrumb_helper.php?at=default
 * @see         http://www.capitalh.net/codesamples/breadcrumb.txt
 */
class Breadcrumb
{ 
    public $bread = '',
           $crumbs = array(),
           $href_param,
           $seperator,
           $home_text,
           $home_link;
    
	public function __construct(
        $seperator = "&nbsp;&gt;&nbsp;",
        $href_param = NULL,
        $home_link = BASE_URL,
        $home_text = "Home"
    ) {
		$this->href_param   = $href_param;
		$this->seperator    = $seperator;	
		$this->home_text    = $home_text;
		$this->home_link    = $home_link;
		$this->crumbs[]     = array(
            'crumb' => $this->home_text,
            'link' => $this->home_link
        );
	}
    
	public function addCrumb($this_crumb, $this_link = NULL)
    {
		$in_crumbs = false;
		// first check that we haven't already got this link in the breadcrumb list.
		foreach($this->crumbs as $crumb){
			if($crumb['crumb'] == $this_crumb ){
				$in_crumbs = true;
			}
			if($crumb['link'] == $this_link &&  $this_link != ''){
				$in_crumbs = true;
			}
		}
		if($in_crumbs == false){
			$this->crumbs[] = array('crumb'=>$this_crumb,'link'=>$this_link);
		}
	}
    
	// call this to return your breadcrumb html
	public function makeBread()
    {
		$sandwich = $this->crumbs;
		$slices = array();
		foreach($sandwich as $slice){
			if (isset($slice['link']) && $slice['link'] != '') {
				$slices[] = '<a href="' . $slice['link'] . '" '.$this->href_param.'>' . $slice['crumb'] . '</a>';
			} else {
				$slices[] = $slice['crumb'];
			}	
		}
		$this->bread = join($this->seperator, $slices);
		return $this->bread;
	}
}

/* End of file Breadcrumb.php */
/* Location: ./application/libraries/Breadcrumb.php */