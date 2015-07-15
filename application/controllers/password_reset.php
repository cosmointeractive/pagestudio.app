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

final class Password_Reset extends Controller 
{
    private $_user_id,
            $_username,
            $_email,
            $_tmp_passwd,
            $_formResult,
            $_errors = array();
            
    public function index()
    {
        $this->auth_username();
    }
    
    /**
     * User Login authentication
     * @access    private
     * @access    final
     */
    final private function auth_username() 
    {   
        /**
         * Check if the form was submitted then check if a unique token was 
         * generated with it. Validate our token to protect against cross site
         * forgery and to make sure that the login request is sent once per
         * iteration. Last, validate the form field values and allow access if passed.
         */
        if(Input::exists('post')) { 
            /** Check if a token was submitted and validate it */
            if(Token::validate(Input::get('token'))) {
                /** Validate user input */
                if(Input::get('reset')) {
                    $validate = new Validate();
                    $validation = $validate->check($_POST, array(
                        'username' => array(
                            'required' => false,
                            'min' => 5,
                            'max' => 30
                        )
                    ));
                    
                    /** 
                     * If validations passed redirect the user the main page. 
                     * Else return the errors to the errors array.
                     */
                    if($validate->passed()) {  
                        if( $this->verifyDatabase() ) {
                            
                            /** Generate temporary hashed password. */
                            $hasher = new PasswordHash(8, TRUE);
                            
                            /** Create a readable 8 character alpha numeric password. */
                            $this->tmp_passwd = random_passwd(); 
                            
                            /** Hash randomly generated password with phpass algorithm. */
                            $this->_hashedPassword = $hasher->HashPassword($this->tmp_passwd);
        
                            /** Update database with newly hashed password. */
                            $this->insertNewPass($this->_hashedPassword);
                            
                            /** Email new password to email in database. */
                            $this->mailPass();
                            
                            /** Store a login successful message in the session. */
                            Session::flash('success', 'An email containing password reset instructions has been sent to the email on file!');
                            
                            /** Redirect to the default controller. */
                            // $this->redirect(Config::get('admin_controller'));
                        } else {
                            if(isset($this->_access) && $this->_access === '0') {
                                $this->_errors[] = 'Your account has been disabled';
                            } else {
                                $this->_errors[] = 'We could not find this email in our database.';
                            }
                        }
                    } else {
                        $errors = $validate->errors();
                        foreach($errors as $error) {
                            $this->_errors[] = $error . '<br />';
                        }
                    }
                }
                
                /** Delete form session token */
                Session::delete(Config::get('session/session_token'));
            }
        }
        
        //return results to the view
        $template = $this->loadView('login/pass_reset_view');
        $template->set('page', array(
            'title' => 'Password Reset',
            'heading' => 'Password Reset',
            'description' => ''
        ));
        $template->set('errors', $this->_errors);
        $template->render();
    }
    
    // --------------------------------------------------------------------
    
    /**
	 * Check database for user email address 
     *
	 * @param       string $_username
	 * @return      bool Return true if a match was found
	 */
	private function verifyDatabase()
	{		
        $this->_username = ! isset($this->_username) ? Input::get('username') : $this->_username;
        
		/**
		 * Check database table for username and password
		 */		        
        $query = Database::getInstance()->query(
            "SELECT id, username, email, access
            FROM cimp_users 
            WHERE username = ?", 
            array(escape_and_addslashes( $this->_username ))
        );
        
        if( $query->count()) {
            /** Loop through our query result. */
            foreach($query->results() as $item) {
                $this->_user_id = $item->id;
                $this->_email   = $item->email;
                $this->_access  = $item->access;
                /** Check if user account is not disabled. */
                return ( $item->access !== '0') ? 1 : 0;
            }
        } else {
            return false;
        }	
	}
    
    // --------------------------------------------------------------------
    
    private function insertNewPass($hashedPass)
    {
        $query = Database::getInstance()->update(
            'cimp_users', 
            $this->_user_id, 
            array(
                'password' => $hashedPass
            )
        );
    }
    
    // --------------------------------------------------------------------
    
    private function mailPass()
    {
        $this->loadModel('Settings_model');
        $op = new Settings_model();
        
        /*
		 * Configure phpMailer settings
		 */
		$this->To		  = ( $op::get('webmaster_email') )
                                ? $op::get('webmaster_email') 
                                : $op::get('admin_email');
		$this->From 	  = ( $op::get('webmaster_email') )
                                ? $op::get('webmaster_email') 
                                : $op::get('admin_email');
		$this->FromName   = "Webmaster";
		$this->Subject    = "Admin Panel Password Reset Request - " . $op::get('site_name');
		$this->Host 	  = $op::get('mail_server');
		$this->Port		  = $op::get('mail_outgoing_port');
		$this->SMTPSecure = $op::get('mail_authen_srvc');
		$this->Username   = $op::get('mail_login');
		$this->Password   = $op::get('mail_password');		
		$this->html		  = $op::get('mail_send_as_html');		
		
		/*
		 * Additional email addresses
		 */
		$this->noReplyAddress = $op::get('reply_email');
		$this->webmasterEmail = $op::get('webmaster_email');
        
        $mail = new PHPMailer();

		/*
		 * send via SMTP
		 */
		$mail->IsSMTP(); 
		
		/*
		 * SMTP server
		 */
		$mail->Host = $this->Host; 
		$mail->Port = $this->Port;
		$mail->SMTPSecure = $this->SMTPSecure;
		//$mail->SMTPDebug   = 2; // 2 to enable SMTP debug information
		
		/*
		 * Send mail via smtp account of default mail server.
		 */
		if ( ! empty( $this->Username )) {
			$mail->SMTPAuth = true;
			$mail->Username = $this->Username;
			$mail->Password = $this->Password;
		} else {
			$mail->SMTPAuth = false;
		} 
		
		/*
		 * phpMailer email configuration
		 */
		$mail->From 		= $this->From;
		$mail->FromName 	= $this->FromName;
		$mail->AddAddress( $this->_email );
		$mail->AddReplyTo( $this->From );
		
		$mail->WordWrap 	= 50; // set word wrap
		$mail->IsHTML( $this->html );
		
		$mail->Subject  	= $this->Subject;
		$this->Message     .= "Hello,<br /><br />"
            . "We've generated a new password for you at your request: "
            // . "request, you can use this new password with your "
            // . "username to log in to " . $this->website_name . "'s admin dashboard.<br /><br />"
            // . "Username: ".$this->userid . "<br />"
            . "New Password: ".$this->tmp_passwd."<br /><br />"
            . "It is recommended that you change this password to something that is easier "
            . "to remember, which can be done by going to your profile page after signing in. <br /><br />"
			. "This email was automatically generated!<br /><br />";
		$mail->Body 		= $this->Message;
		
		/*
		 * Send the email, add auto respond if sent successfully
		 */
		if ( $mail->Send() ) {
			return 1;
		} else {
			$this->MailErrorInfo = $mail->ErrorInfo;
			$this->errors[] .= "Mailer Error: " . $mail->ErrorInfo;
			return 0;
		}
    }
}