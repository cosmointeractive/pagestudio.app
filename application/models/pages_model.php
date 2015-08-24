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
                page_title, 
                page_slug,
                page_author,
                page_date,
                page_modified,
                page_editor
            FROM cimp_pages "
            // WHERE 
                // page_status = ?", 
                // array('published')
        );
        
        return ( ! $query->count()) ? false : $query->results();
	}
	
    /**
     * Return a list of books to the controller 
     *
     * @param      array $allBooks Array containing a list of books 
     * @return     array
     */
	public function getEntry($ID)
	{
		$query = Database::getInstance()->query(
            "SELECT * FROM cimp_pages
            WHERE id = ?", array($ID)
        );
        
        return ( ! $query->count()) ? false : $query->results();
	}
    
    /**
     * Creates and entry in the database 
     *
     * @param      string $table  
     * @param      array $fields Array of table key and value
     * @return     bool true or false
     */
	public function addEntry($table, $fields)
	{
		$query = Database::getInstance()->insert(
            $table, $fields
        );
        
        return ( ! $query) ? true : false;
	}
    
    /**
     * Updates a specific entry in the database
     *
     * @param      int $ID
     * @param      string $post_title
     * @param      string $post_content
     * @return     bool
     */
	public function updateEntry($ID, $page_title, $page_slug, $page_content)
	{
		$query = Database::getInstance()->update(
            "cimp_pages", $ID,  array(
                'page_title' => $page_title,
                'page_slug' => $page_slug,
                'page_content' => $page_content
            )
        );
        
        return ( ! $query) ? false : true;
	}
    
    /**
     * Delete a specific entry in the database
     *
     * @param      int $ID
     * @return     bool
     */
	public function deleteEntry($ID)
	{
		$query = Database::getInstance()->delete( 
            "cimp_pages", array('id', '=', $ID) 
        );
        
        return ( ! $query) ? false : true;
	}
}

/* End of file entries_model.php */
/* Location: ./application/models/entries_model.php */