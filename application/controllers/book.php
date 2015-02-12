<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Book extends Controller 
{	
   
	public function index()
	{
        /**
         * Check if a user session has already been created
         * else send the user to the login page.
         */
        if( ! Session::get('session_id')) {
            $this->redirect('login');
        }
        
        if (isset($_GET['book']))
		{
            // show the requested book
            $books = $this->loadModel('Book_model');
            $booksList = $books->getBookList();
            
            $template = $this->loadView('book_details_view');
            $template->set('book', $booksList);
            $template->render();
            
        }
        else
        {
            $bc = new Breadcrumb();
            $bc->addCrumb('Book', BASE_URL . 'book');
            
            $books = $this->loadModel('Book_model');
            $booksList = $books->getBookList();
            
            $Lex = new Lex_Parser();
            $parsedText = $Lex->parse(
                '<?php 
                    echo "Hello world! <br />";
                    $book = new Book();
                    $book->test();
                ?>
                {{ content }}
                ', array(), false, true
            );
            
            // no special book is requested, we'll show a list of all available books
            $template = $this->loadView('book_details_view');
            $template->set('bread', $bc->makeBread());
            $template->set('book', $booksList);
            $template->set('lex', $parsedText);
            $template->render();
        }
        
	}
    
    public function test()
    {
        echo 'From the book controller. <br />';
    }

    public function book_detail()
    {
        //$test = new Test();
        //$db = new Database();
        //$query = $db::getInstance()->query("SELECT * FROM dyn_menu WHERE id = ?", array('1'));
        //$user = $db::getInstance()->get('dyn_menu', array('id', '=', '3'));
        $query = Database::getInstance()->query("SELECT id, label FROM dyn_menu");
        
        if( ! $query->count()) {
            //echo 'No record found';
        } else {
            foreach($query->results() as $item) {
                echo 'id: ' . $item->id;
                echo 'Name: ' . $item->label;
            }
        }
        
        //$this->addRecord();
        //$this->updateRecord();
        
        if(Input::exists('get')) {
            echo Input::get('name');
            echo Input::get('nickname');
            //Input::sanitizeEmail();
            //Input::sanitizeString();
        }
    }

    public function addRecord() 
    {
        $recordInsert = Database::getInstance()->insert('dyn_menu', array(
                'label' => 'New Information To Add',
                'link_url' => 'http://google.com/'
            )
        );
        
        if($recordInsert) {
            //Assume success
        }
    }
    
    public function updateRecord() 
    {
        /**
         * Method to update a table record
         *
         * @example     Database::getInstance()->update($table, $id array(
         *                  $field => $value
         *              )
         */
        $update = Database::getInstance()->update('dyn_menu', '13', array(
                'label' => 'New Information To Update',
                'link_url' => 'http://google.com/'
            )
        );
        
        if($update) {
            //Assume success
        }
    }
    
    public function delete()
    {
        echo '<h2>From the delete method</h2>';
        
        if(Input::exists('get')) {
            echo Input::get('name');        
        }
    }
}