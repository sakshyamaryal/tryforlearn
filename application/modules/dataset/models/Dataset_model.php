<?php

class Dataset_model extends CI_Model
{
	public function savegroup ($data_arr)
	{
		$this->db->insert('datasetmain', $data_arr);
		return $this->db->insert_id();
	}

	public function get_classes_by_level($level_id)
{
    $this->db->select('classid, name'); // adjust based on your table column names
    $this->db->from('class'); // replace 'class' with your actual table name
    $this->db->where('levelid', $level_id);
    $this->db->where('is_active', 1); // optional: if you use this flag
    return $this->db->get()->result_array();
}
	public function get_subjects_by_class($class_id)
{
    $this->db->select('subject_id, subject_name'); // adjust based on your table column names
    $this->db->from('subject'); // replace 'class' with your actual table name
    $this->db->where('classid', $class_id);
    $this->db->where('is_active', 1); // optional: if you use this flag
    return $this->db->get()->result_array();
}
public function get_all_datasets()
{
	$this->db->select('datasetmain.*, class.name AS class_name, subject.subject_name, level.name AS level_name');
	$this->db->from('datasetmain');
	$this->db->join('class', 'datasetmain.class_id = class.classid', 'left');
	$this->db->join('subject', 'datasetmain.subject_id = subject.subject_id', 'left');
	$this->db->join('level', 'class.levelid = level.level_id', 'left'); // Join with level table using class.levelid
	$this->db->order_by('datasetmain.order', 'ASC');

	$query = $this->db->get();
    return $query->result();
}

public function get_filtered_datasets($class_id, $subject_id)
{
	$this->db->select('datasetmain.*, class.name AS class_name, subject.subject_name, level.name AS level_name');
	$this->db->from('datasetmain');
	$this->db->join('class', 'datasetmain.class_id = class.classid', 'left');
	$this->db->join('subject', 'datasetmain.subject_id = subject.subject_id', 'left');
	$this->db->join('level', 'class.levelid = level.level_id', 'left');
    if ($class_id && $class_id != -1) {
        $this->db->where('datasetmain.class_id', $class_id);
    }
    if ($subject_id && $subject_id != -1) {
        $this->db->where('datasetmain.subject_id', $subject_id);
    }
    $this->db->where('datasetmain.is_active', 1); // optional
		$this->db->order_by('datasetmain.order', 'ASC');
		$query = $this->db->get();
    return $query->result();
}
public function delete_dataset_by_id($setid) {
	// Ensure the dataset ID is valid
	$this->db->where('setid', $setid);
	return $this->db->delete('datasetmain');  // Delete the dataset from the 'datasetmain' table
}
public function delete_selected_datasets($setids)
{
    $this->db->where_in('setid', $setids);
    $this->db->delete('datasetmain'); // Replace 'datasetmain' with your actual table name

    return $this->db->affected_rows() > 0;
}
public function insert_dataset($data)
{
    return $this->db->insert('datasetmain', $data);
}
public function get_dataset_by_id($setid)
{
    // Get the dataset by setid from the database
    $query = $this->db->get_where('datasetmain', ['setid' => $setid]);
    return $query->row_array();  // Return the dataset as an array
}
public function get_questions_by_setid($setid)
{
    $this->db->select('dq.*, e.question, c.name as class_name, s.subject_name as subject_name');
    $this->db->from('dataset_question dq');
    $this->db->join('exercise e', 'e.eid = dq.eid', 'left');
    $this->db->join('class c', 'c.classid = dq.class_id', 'left');
    $this->db->join('subject s', 's.subject_id = dq.subject_id', 'left');
    $this->db->where('dq.setid', $setid);
    return $this->db->get()->result_array();
}


// Update dataset
public function update_dataset($setid, $setname, $title, $order, $time_period, $guidelines) {
	$data = [
			'setname' => $setname,
			'title' => $title,
			'order' => $order,
			'time_period' => $time_period,
			'guideline' => $guidelines
	];

	$this->db->where('setid', $setid);
	return $this->db->update('datasetmain', $data); // Replace with your table name
}
public function delete_question_from_dataset($setid, $eid) {
	$this->db->where('setid', $setid);
	$this->db->where('eid', $eid);
	return $this->db->delete('dataset_question');
}


	public function get_group ()
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
			$field = "setid";
		} else {
			$field = $_REQUEST['sort'][0]['field'];
		}
		if (!isset($_REQUEST['sort'][0]['dir'])) {
			$order = "desc";
		} else {
			$order = $_REQUEST['sort'][0]['dir'];
		}


		if (isset($_REQUEST['filter'])) $where = $this->parseFilters($_REQUEST['filter']);
		$query = $this->db->query("select * from datasetmain where is_active=1 and  $where order by $field $order limit $skip, $take");
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

	public function count_all_group ()
	{
		$this->db->select(" * ");
		$this->db->where('is_active',1);
		$this->db->from('datasetmain');
		$query = $this->db->get();
		return $query->num_rows();
	}


	
	public function updategroup ($data, $gid)
	{
		$this->db->where('setid', $gid);
		if ($this->db->update('datasetmain', $data)) {
			return true;
		} else {
			return false;
		}
	}


}