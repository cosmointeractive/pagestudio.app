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
 * @author      Cosmo Mathieu <cosmo@cosmointeractive.co>   
 */
 
// ------------------------------------------------------------------------

class Users_model extends Model 
{
	public $title;
	public $author;
	public $description;
    
    public function __construct()
    {
        
    }
    
    // --------------------------------------------------------------------
		
    /**
     * Return an array 
     *
     * @param      array $allBooks Array containing a list of books 
     * @return     array
     */
	public function getUser($ID)
	{
		$query = Database::getInstance()->query(
            "SELECT * FROM cimp_users
            WHERE id = ?", array($ID)
        );
        
        return ( ! $query->count()) ? false : $query->results();
	}
    
    // --------------------------------------------------------------------
    
    /**
     * Get a list of all categories, and the categories tied to 
     * the post from the database.
     * 
     * @param      
     * @return     array $cats Array of categories and matches
     */ 
    public function getUsers()
    {
        $pdo = new PDO(
            'mysql:dbname=' . Config::get('mysql/db') . ';' .
            'host=' . Config::get('mysql/host'), 
            Config::get('mysql/username'),   //Username
            Config::get('mysql/password')    //Password
        );
        $fpdo = new FluentPDO($pdo);
        $query = $fpdo->from('cimp_users')
                    ->leftJoin(
                        'cimp_user_groups ON cimp_user_groups.group_id
                            = cimp_users.group_id'
                    )
                    ->select('cimp_user_groups.*');
                    
        $row = $query->fetchAll();

        if ( ! $query) {
            return false;
        } else {
            return $results = arrayToObject($row);
        }
    }
    
    // --------------------------------------------------------------------
    
    /**
     * Creates and entry in the database 
     *
     * @param      string $hashed_password  
     * @return     bool true or false
     */
	public function addEntry($hashed_password)
	{
        if( ! empty($hashed_password)) {            
            $query = DB::table('cimp_users')->insert([
                'username' => Input::get('username'),
                'password' => $hashed_password,
                'email' => Input::get('email'),
                'firstname' => Input::get('firstname'),
                'lastname' => Input::get('lastname'),
                'help_tips' => Input::get('help_tips'),
                'access' => Input::get('access'),
                'group_id' => Input::get('role'),
            ]);
        }
        
        return ( ! $query) ? false : true;
	}
    
    // --------------------------------------------------------------------
    
    /**
     * Updates a specific entry in the database
     *
     * @param      int $ID
     * @param      string $hashed_password
     * @return     bool
     */
	public function updateEntry($ID, $hashed_password)
	{
        if( ! empty($hashed_password)) {
            $query = DB::table('cimp_users')->where('id', $ID)->update([
                'username' => Input::get('username'),
                'password' => $hashed_password,
                'email' => Input::get('email'),
                'firstname' => Input::get('firstname'),
                'lastname' => Input::get('lastname'),
                'help_tips' => Input::get('help_tips'),
                'access' => Input::get('access'),
                'group_id' => Input::get('role'),
            ]);
        } else {
            $query = DB::table('cimp_users')->where('id', $ID)->update([
                'username' => Input::get('username'),
                'email' => Input::get('email'),
                'firstname' => Input::get('firstname'),
                'lastname' => Input::get('lastname'),
                'help_tips' => Input::get('help_tips'),
                'access' => Input::get('access'),
                'group_id' => Input::get('role'),
            ]);
        }
        return ( ! $query) ? false : true;
	}
    
    // --------------------------------------------------------------------
    
    /**
     * Delete a specific user in the database
     *
     * @param      int $ID
     * @return     bool True or False
     */
	public function deleteEntry($ID)
	{
        $query = DB::table('cimp_users')->where('id', '=', $ID)->delete();
        
        return ( ! $query) ? false : true;
	}
}

/* End of file users_model.php */
/* Location: ./application/models/users_model.php */