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

class Pages_model extends Model 
{
	public $title;
	public $author;
	public $description;
	
	public function __construct()  
    {  
        //$this->title = $title;
	    //$this->author = $author;
	    //$this->description = $description;
    } 
    
    public function getEntries()
	{
        $query = Database::getInstance()->query(
            "SELECT 
                id, 
                post_title 
            FROM cimp_posts 
            WHERE 
                post_type = ?", 
                array('post')
        );
        
        if( ! $query->count()) {
            echo 'No record found';
        } else {
            return $query->results();
        }
	}
    
    public function getPages($status = 'published')
	{        
        $query = Database::getInstance()->get(
            "cimp_pages", array('page_status', '=', $status)
        );

        if( ! $query->count()) {
            // echo 'No record found';
        } else {
            return $query->results();
        }
	}
	
    /**
     * Return a list of books to the controller 
     *
     * @param      array $allBooks Array containing a list of books 
     * @return     array
     */
	public static function getEntry($slug)
	{
		$query = Database::getInstance()->query(
            "SELECT * FROM cimp_pages WHERE page_slug = ?", array($slug)
        );

        if( ! $query->count()) {
            //echo 'No record found';
        } else {            
            return $query->results();
        }
	}
    
    /**
     * Updates a specific entry in the database
     *
     * @param      int $ID
     * @param      string $post_title
     * @param      string $post_content
     * @return     bool
     */
	public function updateEntry($ID, $post_title, $post_content)
	{
		$query = Database::getInstance()->update(
            "cimp_posts", $ID,  array(
                'post_title' => $post_title,
                'post_content' => $post_content
            )
        );
        
        return ( ! $query) ? false : true;
	}
}

/* End of file pages_model.php */
/* Location: ./application/modules/site/models/pages_model.php */