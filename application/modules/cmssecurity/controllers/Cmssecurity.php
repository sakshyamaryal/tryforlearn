<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
class Cmssecurity extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('cmssecurity_model');
        $this->model=$this->cmssecurity_model;
        if($this->session->adminuserid == "")
        {
            redirect('account/admin_login');
		}
		if(check_permission($this->uri->segment('1'))=== false)
		{
			echo "SYSTEM EXITED ! You donot Have Permission.";exit();
		}
    }

    public function menu()
    {
        $data=array(
            'title'=>'Manage Menu',
            'menu'=>$this->model->get_menu(),
            'menu_modules'=>$this->model->get_modules()

        );
        $view=array(
            'header'=>'themes/admin/header',
            'sidebar'=>'themes/admin/sidebar',
            'body'=>'menu',
            'footer'=>'themes/admin/footer'
        );

        template($view,$data);

    }
    public function menu_save()
    {
        $name=$this->input->post('name');
        $pname=$this->input->post('pname');
        $fname=$this->input->post('fname');
        $ficon=$this->input->post('ficon');
        $bar=$this->input->post('bar');
        $order=$this->input->post('order');
        if($name=="" || $pname=="" || $fname=="" || $ficon=="" || $bar =="" || $order=="" )
        {
           $res = ["message"=>'invalid',"status"=>false];

           echo json_encode($res);
        }else
        {
            if($this->model->save_menu()==true)
            {
                $res = ["message"=>'success',"status"=>true];

                 echo json_encode($res);

            }else
            {
                $res = ["message"=>'failed',"status"=>false];

                echo json_encode($res);

            }



        }
        
    }
     function getmenubyId()
     {
         $data=$this->model->getmenubyId();
         $res = ["message"=>'success',"status"=>true,"data"=>$data,'menu_modules'=>$this->model->get_modules()];

                 echo json_encode($res);
     }
     function menu_update($id)
     {
        $name=$this->input->post('name');
        $pname=$this->input->post('pname');
        $fname=$this->input->post('fname');
        $ficon=$this->input->post('ficon');
        $bar=$this->input->post('bar');
        $order=$this->input->post('order');
        if($name=="" || $pname=="" || $fname=="" || $ficon=="" || $bar =="" || $order=="" )
        {
           $res = ["message"=>'invalid',"status"=>false];

           echo json_encode($res);
        }else
        {
            if($this->model->update_menu($id)==true)
            {
                $res = ["message"=>'success',"status"=>true];

                 echo json_encode($res);

            }else
            {
                $res = ["message"=>'failed',"status"=>false];

                echo json_encode($res);

            }



        }

     }

     function delete_menu()
     {
        if($this->model->delete_menu()==true)
        {
            $res = ["message"=>'success',"status"=>true];

             echo json_encode($res);

        }else
        {
            $res = ["message"=>'failed',"status"=>false];

            echo json_encode($res);

        }

     }

     function permission()
     {
        $data=array(
            'title'=>'Manage Permission',
            'module_name'=>$this->model->get_modules(),
            'usertype'=>$this->model->get_user_type(),
            'permission'=>$this->model->mod_permission()

        );
        $view=array(
            'header'=>'themes/admin/header',
            'sidebar'=>'themes/admin/sidebar',
            'body'=>'permission',
            'footer'=>'themes/admin/footer'
        );

        template($view,$data);
     }

     function printModules()
     {
        $data= $this->model->getsubmodules();
         $usertype=$this->model->get_user_type();
         $permission=$this->model->mod_permission();
        $html="";
        $check="";
        $sn=0;
        $q='"';
        foreach($data as $val)
        { 
            $sn++;
            $html .= "<tr>
                    <td>".$sn."</td>
                    <td>".$val['module_name']."</td>";
                    foreach($usertype as $res)
                    { if(isset($permission[$res['typeid']."_".$val['module_id']])){
                        if($permission[$res['typeid']."_".$val['module_id']]=='1') {
                            $check="checked";
                        }else{
                            $check="";
                        }
                    }else{
                        $check="";
                    }
                    
                        
                        $html .="<td><input type='checkbox' id='check".$val['module_id'].$res['typeid']."' onclick='set_permission(".$val['module_id'].",".$res['typeid'].")' ".$check."></td>";

                    }

                    $html .="<tr>";
        }
        $res = ["message"=>'success',"status"=>true,"html"=>$html];

        echo json_encode($res);


     }

     function change_permission()
     {
         $this->model->manage_permission();
         $res = ["message"=>'success',"status"=>true];

         echo json_encode($res);
     }

       
   
    }
    

