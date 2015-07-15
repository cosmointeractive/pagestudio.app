<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

class Mailer
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public static function send(
        $to = '',
        $from = '',
        $subject = '', 
        $message = ''
    ) {
        $mail = new PHPMailer();
    }
    
    public function send_mail() 
    {
        $mail = new PHPMailer();
        $mail->IsSMTP(); // we are going to use SMTP
        $mail->SMTPAuth   = true; // enabled SMTP authentication
        $mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
        $mail->Host       = "smtp.gmail.com";      // setting GMail as our SMTP server
        $mail->Port       = 465;                   // SMTP port to connect to GMail
        $mail->Username   = "myusername@gmail.com";  // user email address
        $mail->Password   = "password";            // password in GMail
        $mail->SetFrom('info@yourdomain.com', 'Firstname Lastname');  //Who is sending the email
        $mail->AddReplyTo("response@yourdomain.com","Firstname Lastname");  //email address that receives the response
        $mail->Subject    = "Email subject";
        $mail->Body       = "HTML message";
        $mail->AltBody    = "Plain text message";
        $to               = "addressee@example.com"; // Who is addressed the email to
        $mail->AddAddress($to, "John Doe");

        // $mail->AddAttachment("images/phpmailer.gif");      // some attached files
        // $mail->AddAttachment("images/phpmailer_mini.gif"); // as many as you want
        
        $data["message"] = ( ! $mail->Send()) ? "Error: " . $mail->ErrorInfo : "Message sent correctly!";
        
    }
}