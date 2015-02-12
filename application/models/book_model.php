<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Book_model extends Model 
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
    
    public function getBookList()
	{
		// here goes some hard-coded values to simulate the database
		return array(
			array(
                "title" => "Jungle Book", 
                "author" => "R. Kipling", 
                "description" => "A classic book."
            ),
			array(
                "title" => "Moonwalker", 
                "author" => "J. Walker", 
                "description" => ""
            ),
			array(
                "title" => "PHP for Dummies", 
                "author" => "Some Smart Guy", 
                "description" => ""
            )
		);
	}
	
    /**
     * Return a list of books to the controller 
     *
     * @param      array $allBooks Array containing a list of books 
     * @return     array
     */
	public function getBook($title)
	{
		// we use the previous function to get all the books and then we return the requested one.
		// in a real life scenario this will be done through a db select command
		$allBooks = $this->getBookList();
		return $allBooks[$title];
	}
}