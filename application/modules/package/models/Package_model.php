<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Package_model extends CI_Model {

    public function get_package()
    {
        $this->db->select('*');
        $this->db->from('package');
        $this->db->where('is_active','1');
        $this->db->order_by('package_name');
        $query=$this->db->get();
        return $query->result_array();
    }
    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from('package');
        $this->db->where('package_id',$id);
        $this->db->where('is_active','1');
        $this->db->order_by('package_name');
        $query=$this->db->get();
        return $query->row();
    }

    public function save($id)
    {  
        $data=array(
            'package_name'=>$this->input->post('name'),
            'descp'=>$this->input->post('descp'),
           
            'is_active'=>'1'
        );
        if($id==null)
        {
            if($this->db->insert('package',$data))
            {
                return true;
            }
            else{
                return false;
            }

        }else
        {
            $this->db->where('package_id',$id);
            if($this->db->update('package',$data))
            {
                return true;
            }
            else{
                return false;
            }

        }
       
        
    }

    public function delete_package()
    {
        
            // $this->db->where('package_id',$this->input->post('id'));
    
            // if($this->db->delete('package'))
            // {
            //     return true;
            // }
            // else{
            //     return false;
            // }

            $data=array(
    
                'is_active'=>'0'
            );
            $this->db->where_in('package_id',$this->input->post('id'));
            if($this->db->update('package',$data))

            {
                return true;
            }
            else{
                return false;
            }
           
         
        
    }
}