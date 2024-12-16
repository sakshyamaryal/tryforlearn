<?php

class Events_model extends CI_Model
{
	public function saveevents ($data_arr)
	{
		$this->db->insert('events', $data_arr);
		$id=$this->db->insert_id();
		$this->db->select('user_id');
		$this->db->from('users');
		$this->db->where('user_type',3);
		$this->db->where('is_active',1);
		$user=$this->db->get()->result_array();
		
		foreach($user as $usr)

		{
			$data=array
			(
				'keyid'=>$id,
				'keytype'=>'event',
				'userid'=>$usr['user_id'],
				'title'=>$data_arr['title'],
				'posted_date'=>$data_arr['created_at'],
				'logstamp'=>date('Y-m-d h:i:s'),
				'is_seen'=>0
			);
			$this->db->insert('trigger_notify',$data);
		}
		return $id;
	}


	public function get_events ()
	{
		$where = " 1 = 1 ";
		$order = '';
		$take = '10';
		$skip = '0';
		if (isset($_GET["take"])) {
			$take = $_GET["take"];
		}
		if (isset($_GET["skip"])) {
			$skip = $_GET["skip"];
		}
		if (!isset($_REQUEST['sort'][0]['field'])) {
			$field = "event_id";
		} else {
			$field = $_REQUEST['sort'][0]['field'];
		}
		if (!isset($_REQUEST['sort'][0]['dir'])) {
			$order = "desc";
		} else {
			$order = $_REQUEST['sort'][0]['dir'];
		}


		if (isset($_REQUEST['filter'])) $where = $this->parseFilters($_REQUEST['filter']);
		$query = $this->db->query("select * from events where is_active=1 and $where order by $field $order limit $skip, $take");
		return $query->result();
	}

	function parseFilters ($filters, $count = 0)
	{
		$where = "";
		$intcount = 0;
		$noend = false;
		$nobegin = false;
		// Do we actually have filters or noi ?
		if (isset($filters['filters'])) {
			$itemcount = count($filters['filters']);
			if ($itemcount == 0) {
				$noend = true;
				$nobegin = true;
			} elseif ($itemcount == 1) {
				$noend = true;
				$nobegin = true;
			} elseif ($itemcount > 1) {
				$noend = false;
				$nobegin = false;
			}
			foreach ($filters['filters'] as $key => $filter) {
				if (isset($filter['field'])) {
					switch ($filter['operator']) {
						case 'startswith':
							$compare = " LIKE ";
							$field = $filter['field'];
							$value = "'" . $filter['value'] . "%' ";
							break;
						case 'contains':
							$compare = " LIKE ";
							$field = $filter['field'];
							$value = " '%" . $filter['value'] . "%' ";
							break;
						case 'doesnotcontain':
							$compare = " NOT LIKE ";
							$field = $filter['field'];
							$value = " '%" . $filter['value'] . "%' ";
							break;
						case 'endswith':
							$compare = " LIKE ";
							$field = $filter['field'];
							$value = "'%" . $filter['value'] . "' ";
							break;
						case 'eq':
							$compare = " = ";
							$field = $filter['field'];
							$value = "'" . $filter['value'] . "'";
							break;
						case 'gt':
							$compare = " > ";
							$field = $filter['field'];
							$value = $filter['value'];
							break;
						case 'lt':
							$compare = " < ";
							$field = $filter['field'];
							$value = $filter['value'];
							break;
						case 'gte':
							$compare = " >= ";
							$field = $filter['field'];
							$value = $filter['value'];
							break;
						case 'lte':
							$compare = " <= ";
							$field = $filter['field'];
							$value = $filter['value'];
							break;
						case 'neq':
							$compare = " <> ";
							$field = $filter['field'];
							$value = "'" . $filter['value'] . "'";
							break;
					}
					if ($count == 0 && $intcount == 0) {
						$before = "";
						$end = " " . $filters['logic'] . " ";
					} elseif ($count > 0 && $intcount == 0) {
						$before = "";
						$end = " " . $filters['logic'] . " ";
					} else {
						$before = " " . $filters['logic'] . " ";
						$end = "";
					}
					$where .= ($nobegin ? "" : $before) . $field . $compare . $value . ($noend ? "" : $end);
					$count++;
					$intcount++;
				} else {
					$where .= " ( " . parseFilters($filter, $count) . " )";
				}
				$where = str_replace(" or  or ", " or ", $where);
				$where = str_replace(" and  and ", " and ", $where);
			}
		} else {
			$where = " 1 = 1 ";
		}

		return $where;
	}

	public function count_all_events ()
	{
		$this->db->select(" * ");
		$this->db->from('events');
		$this->db->where('is_active',1);
		$query = $this->db->get();
		return $query->num_rows();
	}


	
	public function updateevents ($data, $eventId)
	{
		$this->db->where('event_id', $eventId);
		if ($this->db->update('events', $data)) {
			
			$this->db->select('user_id');
			$this->db->from('users');
			$this->db->where('user_type',3);
			$this->db->where('is_active',1);
			$user=$this->db->get()->result_array();
			
			foreach($user as $usr)
	
			{
				$event=array
				(
					'keyid'=>$eventId,
					'keytype'=>'event',
					'userid'=>$usr['user_id'],
					'title'=>$data['title'],
					'posted_date'=>date('Y-m-d'),
					'logstamp'=>date('Y-m-d h:i:s'),
					'is_seen'=>0
				);
				$this->db->insert('trigger_notify',$event);
			}
			//return $id;
			return true;
		} else {
			return false;
		}
	}
}