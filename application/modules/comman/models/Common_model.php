<?php
class Common_model extends CI_Model
{
        function __construct() {
       // Call the Model constructor
        parent::__construct();

    }

    function compress_image($src, $dest , $quality) 
    {
        $info = getimagesize($src);
        if ($info['mime'] == 'image/jpeg') 
        {
            $image = imagecreatefromjpeg($src);
        }
        elseif ($info['mime'] == 'image/gif') 
        {
            $image = imagecreatefromgif($src);
        }
        elseif ($info['mime'] == 'image/png') 
        {
            $image = imagecreatefrompng($src);
        }
        else
        {
            die('Unknown image file format');
        }
        imagejpeg($image, $dest, $quality);
        return $dest;
    }

	public function uploadImage ($filename)
	{
		$new_name = time() . $_FILES[$filename]['name'];
		$config = array(
			'upload_path' => './upload/page',
			'allowed_types' => "gif|jpg|png|jpeg|pdf",
			'overwrite' => TRUE,
			'max_size' => "2048000",
			'max_height' => "2000",
			'max_width' => "2000",
			'file_name' => $new_name
		);
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('files')) {
			$data = array('upload_data' => $this->upload->data());

			$filename = $data['upload_data']['file_name'];
			return $filename;
		} else {
			$error = array('error' => $this->upload->display_errors());
			return $error;
		}
    }
    
    public function get_notification()
    {
        $this->db->select('*');
        $this->db->from('trigger_notify');
        $this->db->where('userid',$this->session->userdata('userid'));
        $this->db->where('logstamp',date('Y-m-d h:i:s'));
        $res=$this->db->get();
        return $res->result_array();

    }
    public function count_notification()
    {
        $this->db->select('id');
        $this->db->from('trigger_notify');
        $this->db->where('userid',$this->session->userdata('userid'));

        $this->db->where('is_seen','0');
        $res=$this->db->get();
        return $res->num_rows();;

    }
    public function get_weekly_notification()
    {
        $date=date("Y-m-d");
        $beforedate = date('Y-m-d', strtotime('-6 days', strtotime($date)));
        $this->db->order_by('logstamp','desc');
        $this->db->select('*');
        $this->db->from('trigger_notify');
        $this->db->where('userid',$this->session->userdata('userid'));

        $this->db->where('posted_date>=',$beforedate);
        $this->db->where('posted_date<=',$date);
        $res=$this->db->get();
        //var_dump($this->db->last_query());exit();
        return $res->result_array();

    }

    public function update_status()
    {
        $data=array('is_seen'=>'1');
        $this->db->where('id',$this->input->post('val'));
        $this->db->update('trigger_notify',$data);
        return true;
    }

    public function getRows($table,$where,$select,$order)
    {
        $this->db->select($select,false);
        $this->db->from($table);
        $this->db->where($where);
        $this->db->order_by($order);

        $query=$this->db->get();
      
        return $query->result();
       
    }
    public function insert($table,$data)
    {
        if($this->db->insert($table,$data))
        return $this->db->insert_id();
        else
        return false;
       
    }
    public function update($table,$data,$where)
    {
        $this->db->where($where);
        if($this->db->update($table,$data))
        return 1;
        else
        return false;
       
    }
    public function delete($table,$where)
    {
        $this->db->where($where);
        if($this->db->delete($table))
        return 1;
        else
        return false;
       
    }
    
    
	
}