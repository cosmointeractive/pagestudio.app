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

class Plugins extends MY_Controller 
{	
	public function index()
	{        
		$bc = new Breadcrumb();
        $bc->addCrumb('Plugins', BASE_URL . 'plugins');
        
		$template = $this->loadView('plugins/plugins_view');
        $template->set('page', array(
            'title' => 'Plugins',
            'heading' => 'The plugins page',
            'description' => 'This is the plugins page'
        ));
        $template->set('bread', $bc->makeBread());
        // $template->set('posts' , $this->loadEntries());
		$template->render();
	}
    
    public function filemanager()
	{        
		$bc = new Breadcrumb();
        $bc->addCrumb('File Manager', BASE_URL . 'plugins/filemanager');
        
		$template = $this->loadView('plugins/filemanager_view');
        $template->set('page', array(
            'title' => 'File Manager',
            'heading' => 'The file manager page',
            'description' => 'This plugin allows you to manage the images for your site',
            'icon' => '<i class="icon x32 icon-media"></i>',
            'body_class' => 'bg-grey'
        ));
        $template->set('bread', $bc->makeBread());
        // Add the js files supporting the cropping 
        // @source      http://stackoverflow.com/questions/819416/adjust-width-height-of-iframe-to-fit-with-content-in-it
        // @source      http://www.daveoncode.com/2009/06/12/adapting-iframe-height-to-its-content-with-2-lines-of-javascript/
        $template->addJS(array(
            'function' => "
            // <!--
            // function resize_iframe() {
                // var height = window.innerWidth;//Firefox
                // if (document.body.clientHeight) {
                    // height = document.body.clientHeight;//IE
                // }
                // //resize the iframe according to the size of the
                // //window (all these should be on the same line)
                // document.getElementById(\"glu\").style.height = parseInt(height-document.getElementById(\"glu\").offsetTop)+\"px\";
                // alert(height);
            // }

            // // this will resize the iframe every
            // // time you change the size of the window.
            // window.onresize=resize_iframe; 

            // //Instead of using this you can use: 
            // //	<BODY onresize=\"resize_iframe()\">

            // //-->
            "
        ));
		$template->render();
	}
}

/* End of file plugins.php */
/* Location: ./application/controllers/plugins.php */