<?php

class Blogs extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Blogs_model');
        $this->model = $this->Blogs_model;
    }

    public function index()
    {
        if ($this->session->userdata('adminuserid')) {
            // Admin is logged in, show the admin panel
            $this->admin();
        } else {
            // User is a client or guest, show frontend blogs
            $data=array(
              'title'=>'Try For Learn : Blogs ',
              'mode'=>'frontend',
              'blogs' => $this->model->getAllBlogs(),
            );
            $view=array(
              'header'=>'themes/frontend/header',
              'sidebar'=>false,
              'body'=>'frontend/blogs_list',
              'footer'=>'themes/frontend/footer'
            );
         
          template($view,$data);
  
        }
    }
    public function detail($blog_id)
{
    $blog = $this->model->getBlogById($blog_id);
    
    if (!$blog) {
        show_404();
    }

    $data = array(
        'title' => $blog->title,
        'mode'=> 'frontend',
        'blog' => $blog
    );

    $view = array(
        'header' => 'themes/frontend/header',
        'sidebar' => false,
        'body' => 'frontend/blog_detail',
        'footer' => 'themes/frontend/footer'
    );

    template($view, $data);
}


    private function admin()
    {
        if ($this->session->adminuserid == "") {
            redirect('account/admin_login');
        }
        if (check_permission($this->uri->segment(1)) === false) {
            echo "SYSTEM EXITED! You do not have permission.";
            exit();
        }
        
        $data = array('title' => 'List Blogs');
        $view = array(
            'header' => 'themes/admin/header',
            'sidebar' => 'themes/admin/sidebar',
            'body' => 'admin/blogs',
            'footer' => 'themes/admin/footer'
        );
        template($view, $data);
    }

    // private function frontend()
    // {
    //     $data['title'] = 'Blogs';
    //     $data['blogs'] = $this->model->getAllBlogs();

    //     $this->load->view('themes/frontend/header', $data);
    //     $this->load->view('frontend/blogs_list', $data);
    //     $this->load->view('themes/frontend/footer');
    // }

    public function get_blogs()
    {
        $blogs = $this->model->getAllBlogs();
        $final_data = array("resource" => $blogs);
        $final_data["total"] = $this->model->countAllBlogs();
        header('Content-Type: application/json');
        echo json_encode($final_data);
    }

    public function add()
    {
        // Assuming the data comes from a POST request or similar input
        $data_arr = array(
            'title' => $_GET['models'][0]['title'], // Blog title
            'content' => $_GET['models'][0]['content'], // Blog content
            'image' => $_GET['models'][0]['propertyLogo'], // Blog image
            'is_active' => $_GET['models'][0]['is_active'], // Active status
        //     'created_by' => $this->session->adminuserid, // Created by admin user
        //     'updated_by' => $this->session->adminuserid, // Updated by admin user (could be the same as created by)
         );
    
        // Call the model's saveBlog method to insert the data
        if ($this->model->saveBlog($data_arr) > 0) {
            $validator['success'] = true;
            $validator['messages'] = "Blog has been saved"; // Success message
        } else {
            $validator['success'] = false;
            $validator['messages'] = "Error while inserting the information into the database"; // Error message
        }
    
        // Return the response as JSON
        echo json_encode($validator);
    }
    
    

    public function update()
    {
        // Retrieving the data passed in the $_GET request
        $data_arr = array(
            'title' => $_GET['models'][0]['title'], // Blog title
            'content' => $_GET['models'][0]['content'], // Blog content
            'image' => $_GET['models'][0]['propertyLogo'], // Blog image
            'is_active' => $_GET['models'][0]['is_active'], // Active status
            'updated_by' => $this->session->adminuserid // Updated by admin user
        );
    
        // Use the model's updateBlog method to update the blog based on the provided blog_id
        if ($this->model->updateBlog($_GET['models'][0]['blog_id'], $data_arr)) {
            $validator['success'] = true;
            $validator['messages'] = "Blog has been updated"; // Success message
        } else {
            $validator['success'] = false;
            $validator['messages'] = "Error while updating the information into the database"; // Error message
        }
    
        // Return the response as JSON
        echo json_encode($validator);
    }
    

    public function delete()
    {
        // Prepare the data to update the blog as deleted (soft delete)
        $data_arr = array(
            'is_active' => 0, // Mark as inactive (soft delete)
        );
    
        // Get the blog IDs from the request (either from POST or GET)
        $ids = $this->input->post('id') ? $this->input->post('id') : $_GET['models'][0]['blog_id'];
    
        // Update the blog's status to inactive (soft delete)
        if ($this->model->updateBlog($ids, $data_arr)) {
            $validator['success'] = true;
            $validator['messages'] = "Blog has been deleted"; // Success message
        } else {
            $validator['success'] = false;
            $validator['messages'] = "Error while updating the information into the database"; // Error message
        }
    
        // Return the response as JSON
        echo json_encode($validator);
    }
    

    public function removeImage()
    {
        unlink("./upload/blogs/" . $_POST['fileNames']);
        echo "";
    }

    public function image()
    {
        $fileParam = "fileUpload";
        $files = $_FILES[$fileParam];

        if (isset($files['name']) && $files['error'] == UPLOAD_ERR_OK) {
            $new_name = time() . $files['name'];
            $config = array(
                'upload_path' => './upload/blogs',
                'allowed_types' => "gif|jpg|png|jpeg|pdf",
                'overwrite' => TRUE,
                'max_size' => "2048000",
            );
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('fileUpload')) {
                echo json_encode($files);
            } else {
                echo json_encode(['error' => $this->upload->display_errors()]);
            }
        }
    }
}
