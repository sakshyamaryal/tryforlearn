<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class Myprofile extends CI_Controller
{
	function __construct ()
	{
		parent::__construct();
		$this->load->model('myprofile_model','model');
		$this->load->model('comman/common_model','common_model');

		if($this->session->userdata('userid') == "")
        {
			$this->session->set_userdata('currentevent',$this->uri->segment('1'));
            redirect('studentlogin');
		}
		
		
    }

    function index()
    {
        $data=array(
            'title'=>'My Profile',
            'mode'=>'frontend',
          
        );
        $view=array(
            'header'=>'themes/frontend/header',
            'sidebar'=>'themes/frontend/sidebar',
            'body'=>'profile',
            'footer'=>'themes/frontend/footer'

        );
       
        template($view,$data);

    }

    function getdetail()
    {
        $list=$this->model->getlist($this->session->userdata('userid'));
        $data['list']=$list;
        $html=$this->load->view('profiledetail',$data,true);
        echo json_encode(array('status'=>true,'message'=>'Success','html'=>$html));
        exit;
    }

    function showmodal()
    {
        $data['class']=$this->common_model->getRows('class',array('is_active'=>1),'*','classid');

        $list=$this->model->getlist($this->session->userdata('userid'));
        $data['st']=$list;
        $html=$this->load->view('form',$data,true);
        echo json_encode(array('status'=>true,'message'=>'Success','html'=>$html));
        exit;

    }

    public function verify_email()
{
    $email = $this->input->get('email');
    $token = $this->input->get('token');

    if ($this->session->userdata('verification_token') == $token &&
        $this->session->userdata('new_email') == $email) {
        
        $user_id = $this->session->userdata('userid');

        // Update email in database
        $this->common_model->update('users', ['email' => $email], ['user_id' => $user_id]);

        // Clear session verification data
        $this->session->unset_userdata('verification_token');
        $this->session->unset_userdata('new_email');

        $this->session->set_flashdata('success', 'Your email has been updated successfully.');
        redirect(base_url('myprofile'));
    } else {
        $this->session->set_flashdata('error', 'Invalid verification link.');
        redirect(base_url('myprofile'));
    }
}

function updatemyprofile()
{
    $post = $_POST;
    $this->load->library('form_validation');
    $this->form_validation->set_rules('fname', 'Name', 'required');
    $this->form_validation->set_rules('cnum', 'Contact Number', 'required');
    $this->form_validation->set_rules('address', 'Address', 'required');

    if (!empty($post['email'])) {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    }

    if ($this->form_validation->run() == FALSE) {
        $res = ["message" => validation_errors(), "success" => false];
        echo json_encode($res);
        exit;
    }

    // Check if email is being changed
    $user_id = $this->session->userdata('userid');
    $current_user = $this->common_model->get_row('users', array('user_id' => $user_id));

    if (!empty($post['email']) && $post['email'] != $current_user->email) {
        // Send verification email
        $this->load->helper('email');
        $this->load->library('email');
        $this->email->set_mailtype("html");

        $verification_token = md5(time() . $post['email']);
        $subject = "Verify Your New Email Address";
        $verification_link = base_url("myprofile/verify_email?token=" . $verification_token . "&email=" . $post['email']);
        
        $message = "Click this link to verify your new email address: <br><br/>
                    <a href='" . $verification_link . "'>Verify Email</a>";

        $sent = send_email($post['email'], $subject, $message);

        if ($sent) {
            // Store in session
            $this->session->set_userdata('new_email', $post['email']);
            $this->session->set_userdata('verification_token', $verification_token);

            // Send JSON response with Gmail redirect
            $res = [
                "message" => "A verification email has been sent to your new email address. Please verify it before the update is applied.",
                "success" => true,
                "redirect" => "https://mail.google.com/"
            ];
        } else {
            $res = ["message" => "Error sending verification email. Please try again.", "success" => false];
        }

        echo json_encode($res);
        exit;
    }

    // Proceed with the profile update (if email is not changed)
    $data = [
        'fullname' => @$post['fname'],
        'phone' => @$post['cnum'],
        'address' => @$post['address'],
        'preffered_language' => @$post['language']
    ];

    if ($this->input->post('gender') != '') {
        $data['gender'] = $this->input->post('gender');
    }
    if ($this->input->post('is_differently_abled') != '') {
        $data['is_differently_abled'] = $this->input->post('is_differently_abled');
    }

    // Update user profile
    $this->common_model->update('users', $data, array('user_id' => $user_id));

    $res = ["message" => "Your profile has been updated successfully.", "success" => true];
    echo json_encode($res);
}



    
}