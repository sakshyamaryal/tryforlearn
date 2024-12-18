<?php

class Services_model extends CI_Model
{
	public function saveService ($data_arr)
	{
		$this->db->insert('service', $data_arr);
		return $this->db->insert_id();
	}


	public function get_services ()
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
			$field = "service_id";
		} else {
			$field = $_REQUEST['sort'][0]['field'];
		}
		if (!isset($_REQUEST['sort'][0]['dir'])) {
			$order = "desc";
		} else {
			$order = $_REQUEST['sort'][0]['dir'];
		}


		if (isset($_REQUEST['filter'])) $where = $this->parseFilters($_REQUEST['filter']);
		$query = $this->db->query("select * from service where is_active=1 and  $where order by $field $order limit $skip, $take");
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

	public function count_all_services ()
	{
		$this->db->select(" * ");
		$this->db->where('is_active',1);
		$this->db->from('service');
		$query = $this->db->get();
		return $query->num_rows();
	}


	
	public function updateService ($data, $serviceId)
	{
		$this->db->where_in('service_id', $serviceId);
		if ($this->db->update('service', $data)) {
			return true;
		} else {
			return false;
		}
	}
}