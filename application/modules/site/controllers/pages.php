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

function my_callback($name, $attr, $content)
{
    $result     = '';
    $theme_path = BASE_URL . Config::get('theme_path') . 'default/';
    
    if(isset($attr)) {        
        $parser = new Lex_Parser();
        foreach($attr as $key) {
            $filename = $theme_path . 'views/partials/'.$key.'.php';            
            $result = $parser->parse(file_get_contents($filename)); 
        }
    }
    
    return $result;
}

class Pages extends Main
{	
    public function __construct()
    {
        /**
         * Instantiate new cache object
         *
         * @var     object
         */ 
        $c = new Cache(array(
            'name' => Config::get('cache/name'),
            'path' => Config::get('cache/file_path'),
            'extension' => Config::get('cache/extension')
        ));
        
        /**
         * Get current page slug (name)
         * 
         * @var     string
         */
        $permalink = ( Url::segment(0)) ? Url::segment(0) : 'home';
        
        /**
         * Load the cache content if it exists, else load from the database
         */
        if($c->isCached($permalink)) {
            $the_content = $c->retrieve($permalink);
            
            // Show entry 
            $template = $this->loadView('render_view');
            $template->set('the_content', $the_content);
            $template->render();
        } else {            
            $this->index();
        }
    }
    
	public function index()
	{       
        $pages      = array('');
        $page       = Url::segment(0);
        $entries    = $this->loadModel(array('module' => 'site', 'model' => 'Pages_model'));
        $themePath  = BASE_URL . Config::get('theme_path') . 'default/';
        
        // Allow pages with 'published' statuses to be viewed
        if($entries->getPages()) {
            // An array of page url-slugs from the database
            foreach($entries->getPages() as $key) {
                $pages[] = $key->page_slug;
            }
        }
        
        // Allow pages with 'draft' statuses to be previewed if user is logged in
        if(Session::exists(Config::get('session/session_id'))) {
            // An array of page url-slugs from the database
            if($entries->getPages('draft')) {                
                foreach($entries->getPages('draft') as $key) {
                    $pages[] = $key->page_slug;
                }
            }
        }

        // Check if the page requested is in the database, else show 404
        if( ! in_array($page, $pages)) {
            $this->redirect('error');
        } else {
            
            $bc = new Breadcrumb(); 
            
            $data = array();
            $data['BASE_URL']       = BASE_URL;
            $data['page_style']     = array(
                array('source' => $themePath . '/assets/css/style.css'),
                array('source' => $themePath . '/assets/css/error.css')
            );
            $data['bread']          = $bc->makeBread();
            $data['copy']           = '&copy; Copyright ' . date('Y');
            $page                   = ( ! empty($page)) ? $page : 'home';
            
            foreach($entries::getEntry($page) as $entry) {
                $data['site_title']     = 'My First CMS';
                $data['the_title']      = remove_slashes( $entry->page_title );
                $data['the_slug']       = remove_slashes( $entry->page_slug );
                $data['the_content']    = remove_slashes( $entry->page_content );
            }
            
            $this->loadHelper('functions');  
            $this->loadHelper('shortcodes');  
            $this->loadHelper('shortcode_list');  
            
            $data['the_content']        = shortcode_empty_paragraph_fix( $data['the_content'] );
            $data['the_content']		= do_shortcode( $data['the_content'] );
            $data['nav_primary']        = $this->buildMenu();
            
            $parser = new Lex_Parser();
            $parser->scopeGlue(':');
            $the_content = $parser->parse(
                file_get_contents($themePath . 'views/layouts/index.php'), 
                $data, 
                'my_callback'
            );
            
            // Build a cache version of the page 
            $this->buildCache($data['the_slug'], $the_content);
            
            // Show entry 
            $template = $this->loadView('render_view');
            $template->set('the_content', $the_content);
            $template->render();
        }
    }
    
    /**
     * Build navigation menu
     * 
     * @syntax     function_name( $param ) 
     * @param      
     * @access     public       
     * @return     $param;
     */ 
    public function buildMenu( $base_url = BASE_URL)
    {
        $menu = menu::factory()
			->add('Home', $base_url, menu::factory())
			->add('About', $base_url . 'about/', menu::factory()
				->add('Our Story', $base_url . 'our-story/')
				->add('Our Beliefs', $base_url . 'our-beliefs/')
            );
					
        $menu->attrs = array(
            'id' => 'navigation',
            'class' => 'menu',
        );

        $menu->current = '/level-three/';
        
        return $menu;
    }
    
    /**
     * Build the page cache 
     * 
     * @param      string $permalink
     * @param      string $page_content
     * @return     void
     */ 
    private function buildCache( $permalink, $page_content )
    {
        $c = new Cache(array(
            'name' => Config::get('cache/name'),
            'path' => Config::get('cache/file_path'),
            'extension' => Config::get('cache/extension')
        ));
        // store the built page
        $c->store($permalink, $page_content); 
    }
    
    /**
     * NOT USED!!!
     * Get a list of active pages from the database
     * @return      string $pageSlug The url slug of the page
     */
    private function pageExists($pageSlug) 
    {
        //@note     This will be a list populated from the database
        if(in_array($pageSlug, array(
            '',
            'home', 
            'about',
            'mission',
            'giving', 
            'contact',
            'blog'
        ))) {
            return $pageSlug;
        } else {
            return false;
        }
        
    }
    
}

/* End of file pages.php */
/* Location: ./application/modules/site/controllers/pages.php */