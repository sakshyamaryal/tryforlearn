<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Startup_model extends CI_Model {

    public function get_startup()
    {
        $this->db->select('*');
        $this->db->from('about_us');
        $this->db->where('id','1');
        $this->db->where('is_active','1');
        $query=$this->db->get();
        return $query->row();
    }
    

    public function save($id,$image)
    {  
        $data=array(
            'name'=>$this->input->post('name'),
            'description'=>$this->input->post('desc'),
            'service'=>$this->input->post('service'),
            'teacher'=>$this->input->post('teacher'),
            'course'=>$this->input->post('course'),
            'parents'=>$this->input->post('testomonial'),
            'marketing_ling'=>$this->input->post('marketing'),
            'image'=>$image,
            'phone'=>$this->input->post('phone'),
            'email'=>$this->input->post('email'),
            'address'=>$this->input->post('address'),
            'extra'=>$this->input->post('extra'),
           
            'is_active'=>'1'
        );
        if($id==null)
        {
            if($this->db->insert('about_us',$data))
            {
                return true;
            }
            else{
                return false;
            }

        }else
        {
            $this->db->where('id',$id);
            if($this->db->update('about_us',$data))
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
        
            // $this->db->where('id',$this->input->post('id'));
    
            // if($this->db->delete('about_us'))
            // {
            //     return true;
            // }
            // else{
            //     return false;
            // }

            $data=array(
    
                'is_active'=>'0'
            );
            $this->db->where('id',$this->input->post('id'));
            if($this->db->update('about_us',$data))

            {
                return true;
            }
            else{
                return false;
            }
           
         
        
    }
}