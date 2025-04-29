<?php

class SocialMedia_model extends CI_Model
{
    public function saveSocialMedia($data_arr)
    {
        $this->db->insert('social_media', $data_arr);
        return $this->db->insert_id();
    }

    public function get_social_media()
    {
        $where = "is_active = 1";
        $take = '10';
        $skip = '0';
        
        if (isset($_GET["take"])) {
            $take = $_GET["take"];
        }
        if (isset($_GET["skip"])) {
            $skip = $_GET["skip"];
        }
    
        if (!isset($_REQUEST['sort'][0]['field'])) {
            $field = "order"; // 👈 default sort by 'order'
        } else {
            $field = $_REQUEST['sort'][0]['field'];
        }
        
        if (!isset($_REQUEST['sort'][0]['dir'])) {
            $order = "asc"; // 👈 default ascending
        } else {
            $order = $_REQUEST['sort'][0]['dir'];
        }
    
        if (isset($_REQUEST['filter'])) {
            $where = $this->parseFilters($_REQUEST['filter']);
        }
    
        // Important fix: backticks for $field
        $query = $this->db->query("SELECT * FROM social_media WHERE 1=1 AND $where ORDER BY `$field` $order LIMIT $skip, $take");
        return $query->result();
    }
    
    

    function parseFilters($filters, $count = 0)
    {
        $where = "";
        $intcount = 0;
        $noend = false;
        $nobegin = false;

        if (isset($filters['filters'])) {
            $itemcount = count($filters['filters']);
            if ($itemcount <= 1) {
                $noend = true;
                $nobegin = true;
            }
            foreach ($filters['filters'] as $key => $filter) {
                if (isset($filter['field'])) {
                    switch ($filter['operator']) {
                        case 'startswith':
                            $compare = " LIKE ";
                            $value = "'" . $filter['value'] . "%'";
                            break;
                        case 'contains':
                            $compare = " LIKE ";
                            $value = "'%" . $filter['value'] . "%'";
                            break;
                        case 'doesnotcontain':
                            $compare = " NOT LIKE ";
                            $value = "'%" . $filter['value'] . "%'";
                            break;
                        case 'endswith':
                            $compare = " LIKE ";
                            $value = "'%" . $filter['value'] . "'";
                            break;
                        case 'eq':
                            $compare = " = ";
                            $value = "'" . $filter['value'] . "'";
                            break;
                        case 'gt':
                            $compare = " > ";
                            $value = $filter['value'];
                            break;
                        case 'lt':
                            $compare = " < ";
                            $value = $filter['value'];
                            break;
                        case 'gte':
                            $compare = " >= ";
                            $value = $filter['value'];
                            break;
                        case 'lte':
                            $compare = " <= ";
                            $value = $filter['value'];
                            break;
                        case 'neq':
                            $compare = " <> ";
                            $value = "'" . $filter['value'] . "'";
                            break;
                    }
                    $field = $filter['field'];
                    $before = ($count == 0 && $intcount == 0) ? "" : " " . $filters['logic'] . " ";
                    $where .= ($nobegin ? "" : $before) . $field . $compare . $value . ($noend ? "" : " " . $filters['logic'] . " ");
                    $count++;
                    $intcount++;
                } else {
                    $where .= " ( " . $this->parseFilters($filter, $count) . " )";
                }
            }
            $where = rtrim($where, " " . $filters['logic'] . " ");
        } else {
            $where = " 1 = 1 ";
        }

        return $where;
    }

    public function count_all_social_media()
    {
        $this->db->select("*");
        $this->db->from('social_media');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getSocialMediaById($id)
    {
        $this->db->select('*');
        $this->db->from('social_media');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function updateSocialMedia($data, $id)
    {
        $this->db->where_in('id', $id);
        if ($this->db->update('social_media', $data)) {
            return true;
        } else {
            return false;
        }
    }
    public function get_all_active()
    {
        $this->db->select('*');
        $this->db->from('social_media');
        $this->db->where('is_active', 1);
        $this->db->order_by('`order`', 'ASC'); // Order by order field
        $query = $this->db->get();
        return $query->result();
    }
    

}
?>
