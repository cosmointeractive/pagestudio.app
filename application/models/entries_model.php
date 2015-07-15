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

class Entries_model extends Model 
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
            "SELECT id, post_title, post_slug, post_date, post_modified FROM cimp_posts 
            WHERE post_type = ?", array('post')
        );
        
        if( ! $query->count()) {
            //echo 'No record found';
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
	public function getEntry($ID)
	{
		$query = Database::getInstance()->query(
            "SELECT * FROM cimp_posts 
            WHERE id = ?", array($ID)
        );
        
        return ( ! $query->count()) ? false : $query->results();
	}
    
    /**
     * Get a list of all categories, and the categories tied to 
     * the post from the database.
     * 
     * @param      
     * @return     array $cats Array of categories and matches
     */ 
    public function getCategories($ID)
    {
        $pdo = new PDO(
            'mysql:dbname=' . Config::get('mysql/db') . ';' .
            'host=' . Config::get('mysql/host'), 
            Config::get('mysql/username'),   //Username
            Config::get('mysql/password')    //Password
        );
        $fpdo = new FluentPDO($pdo);
        $query = $fpdo->from('cimp_categories_entries')
                    ->leftJoin(
                        'cimp_categories ON cimp_categories.category_ID 
                            = cimp_categories_entries.category_ID'
                    )
                    ->where('post_ID', $ID)
                    ->select('cimp_categories.category_ID');
                    
        $row = $query->fetchAll();
        
        $query = Database::getInstance()->query(
            "SELECT category_ID, category_title FROM cimp_categories 
            WHERE category_visibility = ?", array('1')
        );
        
        $cats = array(
            "categories" => $query->results(),
            "matches" => $row
        );

        return ( ! $query->count()) ? false : $cats;     
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
	public function updateEntry(
        $ID, $post_title, $post_content, $post_categories, $post_author,
        $post_status, 
        $post_visibility, 
        $post_password, 
        $is_featured, 
        $is_sticky
    ) {
        /** Get current datetime. */
        $date = new DateTime();
        $post_modified = $date->format('Y-m-d H:i:s');
        
        /** Update the post table. */
		$query = Database::getInstance()->update(
            "cimp_posts", $ID,  array(
                'post_title' => $post_title,
                'post_content' => $post_content, 
                'post_author' => $post_author,
                'post_modified' => $post_modified,
                'post_status' => $post_status, 
                'post_visibility' => $post_visibility, 
                'post_password' => $post_password, 
                'is_featured' => $is_featured, 
                'is_sticky' => $is_sticky, 
                'post_type' => 'post'
            )
        );        
        
        /** Remove all instances of the post from the categories entries table. */
        $del_post_from_cat 	= Database::getInstance()->delete(
            'cimp_categories_entries', array('post_ID', '=', $ID)
        ); 
        
        /** Insert new instances of the post in the categories_entries table. */
        foreach($post_categories as $category_ID) {
            Database::getInstance()->insert(
                'cimp_categories_entries',
                array(
                    'category_ID' => $category_ID, 
                    'post_ID' => $ID, 
                )
            );
        }

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
            "cimp_posts", array('id', '=', $ID) 
        );
        
        return ( ! $query) ? false : true;
	}
}

/* End of file entries_model.php */
/* Location: ./application/models/entries_model.php */