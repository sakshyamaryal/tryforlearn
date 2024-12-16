<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cmssecurity_model extends CI_Model {

    public function get_menu()
    {  
        $this->db->select('*');
        $this->db->from('modules');
        $this->db->where('is_active','1');
        $this->db->order_by('module_name');
        $query=$this->db->get();
        return $query->result_array();
    }
    public function get_modules()
    {
        $this->db->select('*');
        $this->db->from('modules');
        $this->db->where('is_active','1');
        $this->db->where('parent_module','0');
        if($this->session->userdata('adminusertype')!='1')
        {
            $this->db->where('bar_type','1');
        }
        $this->db->order_by('module_name');
        $query=$this->db->get();
        return $query->result_array();
    }
    public function save_menu()
    {
        $data=array(
            'module_name'=>$this->input->post('name'),
            'parent_module'=>$this->input->post('pname'),
            'controller_fname'=>$this->input->post('fname'),
            'fonticon'=>$this->input->post('ficon'),
            'bar_type'=>$this->input->post('bar'),
            'display_order'=>$this->input->post('order'),
            'is_active'=>'1'
        );
        $this->db->insert('modules',$data);
        return true;
    }
    public  function getmenubyId()
    {
        $this->db->select('*');
        $this->db->from('modules');
        $this->db->where('module_id',$this->input->post('id'));
        
        $query=$this->db->get();
        return $query->row();

    }
    public function update_menu($id)
    {
        $data=array(
            'module_name'=>$this->input->post('name'),
            'parent_module'=>$this->input->post('pname'),
            'controller_fname'=>$this->input->post('fname'),
            'fonticon'=>$this->input->post('ficon'),
            'bar_type'=>$this->input->post('bar'),
            'display_order'=>$this->input->post('order'),
            'is_active'=>'1'
        );
        $this->db->where('module_id',$id);
        $this->db->update('modules',$data);
        return true;
    }
    public  function delete_menu()
    {
        // $this->db->where('module_id',$this->input->post('id'));

        // $this->db->delete('modules');
        // return true;
        $data=array(
    
            'is_active'=>'0'
        );
        $this->db->where('module_id',$this->input->post('id'));
        $this->db->update('modules',$data);
        return true;
       
     
    }

    public function get_user_type()
    {  
        $where='';
        if($this->session->userdata('adminusertype')!='1')
        {
            $where=' where typeid!=1 and typeid !=2 and typeid !=3';
        }
        $sql="select *  from user_type ".$where;
        $query=$this->db->query($sql);
        
        return $query->result_array();
    }

    public function mod_permission()
    {  
        $this->db->select('*');
        $this->db->from('modules_permission');
        $query=$this->db->get();
        $res= $query->result_array();
        $data=array();
        foreach($res as $val){
            $data[$val['userid']."_".$val['module_id']]='1';
        }
        return $data;
    }
     public function getsubmodules()
     {
        $this->db->select('*');
        $this->db->from('modules');
        $this->db->where('parent_module',$this->input->post('id'));

        $query=$this->db->get();
        return $query->result_array();

     }

     public function manage_permission()
     {
         if($this->input->post('mode')=='insert')
         {
            $data=array(
                'userid'=>$this->input->post('usertype'),
                'module_id'=>$this->input->post('moduleid')
            );
            $this->db->insert('modules_permission',$data);
            return true;

         }else{
            $this->db->where('module_id',$this->input->post('moduleid'));
            $this->db->where('userid',$this->input->post('usertype'));

            $this->db->delete('modules_permission');
            return true;

         }
     }
}