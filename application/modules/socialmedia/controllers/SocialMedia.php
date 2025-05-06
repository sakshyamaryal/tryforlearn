
<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class Socialmedia extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('socialmedia_model');
        $this->model = $this->socialmedia_model;
        $this->load->model('comman/common_model');
        $this->common = $this->common_model;

        if ($this->session->adminuserid == "") {
            redirect('account/admin_login');
        }

        if (check_permission($this->uri->segment('1')) === false) {
            echo "SYSTEM EXITED ! You do not Have Permission.";
            exit();
        }
    }

    public function index()
    {
        $data = array(
            'title' => 'List Social Media',
        );
        $view = array(
            'header' => 'themes/admin/header',
            'sidebar' => 'themes/admin/sidebar',
            'body' => 'list',
            'footer' => 'themes/admin/footer'
        );
        template($view, $data);
    }

    public function get_social_medias()
    {
        $social_medias = $this->model->get_social_media();
        $final_data = array("resource" => $social_medias);
        $final_data["total"] = $this->model->count_all_social_media();
        header('Content-Type: application/json');
        echo trim(json_encode($final_data));
    }

    public function add()
    {
        $data_arr = array(
            'name' => $_GET['models'][0]['name'],
            'link' => $_GET['models'][0]['link'],
            'icon' => $_GET['models'][0]['icon'],
            'order' => $_GET['models'][0]['order'],
        );

        if ($this->model->saveSocialMedia($data_arr) > 0) {
            $validator['success'] = true;
            $validator['messages'] = "Social media entry has been saved.";
        } else {
            $validator['success'] = false;
            $validator['messages'] = "Error while inserting the information into the database.";
        }
        echo json_encode($validator);
    }

    public function update()
    {
        $data_arr = array(
            'name' => $_GET['models'][0]['name'],
            'link' => $_GET['models'][0]['link'],
            'icon' => $_GET['models'][0]['icon'],
            'order' => $_GET['models'][0]['order'],
        );

        if ($this->model->updateSocialMedia($data_arr, $_GET['models'][0]['id'])) {
            $validator['success'] = true;
            $validator['messages'] = "Social media entry has been updated.";
        } else {
            $validator['success'] = false;
            $validator['messages'] = "Error while updating the information into the database.";
        }
        echo json_encode($validator);
    }

    public function delete()
    {
        $ids = $this->input->post('id') ? $this->input->post('id') : $_GET['models'][0]['id'];

        if ($this->model->updateSocialMedia(['is_active' => 0], $ids)) {
            $validator['success'] = true;
            $validator['messages'] = "Social media entry has been deleted.";
        } else {
            $validator['success'] = false;
            $validator['messages'] = "Error while updating the information into the database.";
        }
        echo json_encode($validator);
    }

    public function get_active_social_media()
{
    $this->load->model('socialmedia_model');
    $social_icons = $this->socialmedia_model->get_all_active();

    return $social_icons;
}

}
?>
