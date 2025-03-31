<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
class Login extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('login_model');
        $this->model=$this->login_model;
    }
    function index() {
        $this->model->autologout();
        if(!empty($this->session->userdata('adminuserid')))
            {
                    redirect(base_url()."dashboard");
            }else{

            
        $this->load->view('login');
            }
    }

    // function authenticate()
    // {
    //         $username = $this->input->post('username');
    //         $password= md5($this->input->post('password'));
    //         $this->load->helper(array('form', 'url'));

    //         $this->load->library('form_validation');

    //         $this->form_validation->set_rules('username', 'Username', 'required');
    //         $this->form_validation->set_rules('password', 'Password', 'required'
    //         );
          

    //         if ($this->form_validation->run() == FALSE)
    //         {
    //             $error=validation_errors();
    //             $this->session->set_flashdata('error',$error);
    //             $this->load->view('login');
    //         }
    //         else
    //         {
    //           $valid= $this->model->verify($username,$password);
        
    //           if ($valid == 2) // Successful login
    //           {
    //               // Check user type to determine if super admin (type_id = 1)
    //               $user = $this->model->getUserByUsername($username); // Get user info by username
    //               if ($user->user_type == 1) // Super admin check
    //               {
    //                   // Super admin: Allow multiple devices by creating a unique session token
    //                   $sessionToken = md5(uniqid(rand(), true)); // Generate a unique session token
    //                   $this->session->set_userdata('session_token', $sessionToken); // Store session token
    //                   $this->model->createSession($user->user_id, $sessionToken); // Store the session in the database
      
    //                   redirect(base_url() . "dashboard");
    //               }
    //               else
    //               {
    //                   // Regular user login, handle accordingly (restrict single device login if needed)
    //                   $this->session->set_userdata('user_id', $user->user_id);
    //                   $this->session->set_userdata('user_type', $user->user_type);
    //                   $this->session->set_userdata('username', $user->username);
      
    //                   redirect(base_url() . "dashboard");
    //               }
    //           }else if($valid==1)
    //         {
    //             $this->session->set_flashdata('error','Your account Is Already Logged In from Another Device');
    //             $this->load->view('login');

    //         }
    //         else
    //         {
    //             $this->session->set_flashdata('error','Invalid Email ID OR Password. Please Try Again.');
    //             $this->load->view('login');
    //         }
    //     }
    // }
//         else
//         {
//             // Call the model to verify credentials
//             $valid = $this->model->verify($username, $password);

//             if ($valid == 2) // Successful login
//             {
//                 // Check user type to determine if super admin (type_id = 1)
//                 $user = $this->model->getUserByUsername($username); // Get user info by username
//                 if ($user->user_type == 1) // Super admin check
//                 {
//                     // Super admin: Allow multiple devices by creating a unique session token
//                     $sessionToken = md5(uniqid(rand(), true)); // Generate a unique session token
//                     $this->session->set_userdata('session_token', $sessionToken); // Store session token
//                     $this->model->createSession($user->user_id, $sessionToken); // Store the session in the database

//                     redirect(base_url() . "dashboard");
//                 }
//                 else
//                 {
//                     // Regular user login, handle accordingly (restrict single device login if needed)
//                     $this->session->set_userdata('user_id', $user->user_id);
//                     $this->session->set_userdata('user_type', $user->user_type);
//                     $this->session->set_userdata('username', $user->username);

//                     redirect(base_url() . "dashboard");
//                 }
//             }
//             else if ($valid == 1) // Account is already logged in from another device
//             {
//                 $this->session->set_flashdata('error', 'Your account is already logged in from another device');
//                 $this->load->view('login');
//             }
//             else // Invalid username or password
//             {
//                 $this->session->set_flashdata('error', 'Invalid Email ID or Password. Please Try Again.');
//                 $this->load->view('login');
//             }
//         }
// }

function authenticate()
{
    $username = $this->input->post('username');
    $password = md5($this->input->post('password'));
    $this->load->helper(array('form', 'url'));

    $this->load->library('form_validation');

    // Set validation rules for the form
    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() == FALSE) {
        // Validation failed, set error and load the login view
        $error = validation_errors();
        $this->session->set_flashdata('error', $error);
        $this->load->view('login');
    } else {
        // Validate user credentials
        $valid = $this->model->verify($username, $password);

        if ($valid == 2) { // Successful login
            // Get user info from the database based on the username
            $user = $this->model->getUserByUsername($username); 

            if ($user->user_type == 1) { // Super admin check
                // Super admin: Allow multiple devices by creating a unique session token
                $sessionToken = md5(uniqid(rand(), true)); // Generate a unique session token
                $this->session->set_userdata('session_token', $sessionToken); // Store session token
                $this->model->createSession($user->user_id, $sessionToken); // Store the session in the database

                redirect(base_url() . "dashboard"); // Redirect to the dashboard
            } else {
                // Regular user login
                $this->session->set_userdata('user_id', $user->user_id);
                $this->session->set_userdata('user_type', $user->user_type);
                $this->session->set_userdata('username', $user->username);

                redirect(base_url() . "dashboard"); // Redirect to the dashboard
            }
        } else if ($valid == 1) { // Account is already logged in from another device
            $this->session->set_flashdata('error', 'Your account is already logged in from another device');
            $this->load->view('login'); // Reload the login view with error message
        } else { // Invalid credentials
            $this->session->set_flashdata('error', 'Invalid Email ID or Password. Please Try Again.');
            $this->load->view('login'); // Reload the login view with error message
        }
    }
}

    function logout()
    {
       $data=$this->model->logout();
      
       $this->session->set_flashdata('success','You have logged out Successfully.');
   

       redirect(base_url()."account/admin_login");

    }
    
    function sendemail()
    {
         $from_email = 'mail@tryforlearn.com';
    $subject ="test";
   $message = "test" ;
   $to_email="srijal.fantastic@gmail.com";
   


    $config = array(
      'protocol' => 'mail',
      'smtp_host' => 'ssl://mail.tryforlearn.com',
      'smtp_port' => '587', // 465
      'smtp_user' => $from_email, // change it to your email
      'smtp_pass' => '&XJeM&#LpVnZ', // change it to your password
      'mailtype' => 'html',
      'charset' => 'iso-8859-1',
      'wordwrap' => TRUE,
      'newline' => "\r\n"
       
      
       );
       $this->load->library('email');
    $this->email->initialize($config);
    
    //send mail
    $this->email->from($from_email, 'Try for Learn'); //Mydomain- - Sender name
    $this->email->to($to_email);
    $this->email->subject($subject);
    $this->email->message($message);
   if ($this->email->send()) {
echo "true"; }
else {
     echo $this->email->print_debugger();
 echo "false";
}
    }
}
