<?php

class Content_model extends CI_Model
{
  public function updateContent ($id)
	{
    $data = array(
      'is_active' => 0
    );
		$this->db->where_in('contentid', $id);
		if ($this->db->update('content', $data)) {
			return 1;
		} else {
			return 0;
		}
	}
}