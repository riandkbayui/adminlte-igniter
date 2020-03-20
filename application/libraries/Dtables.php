<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dtables {
 
    private $table;
    private $column_order = []; //set column field database for datatable orderable
    private $column_search = []; //set column field database for datatable searchable 
    private $order = []; // default order 
    private $join = [];
    private $where = [];
    private $ci;
    private $group = [];
 
    public function __construct() {
        $this->ci =& get_instance();
    }

    public function set_table($tables = '') {
    	$this->table = $tables;
    	return $this;
    }

    public function set_column_order($co = []) {
    	$this->column_order = $co;
    	return $this;
    }

    public function set_column_search($cs) {
    	$this->column_search = $cs;
    	return $this;
    }

    public function set_order($columns, $order) {
    	$this->order[] = ['columns'=>$columns, 'order'=>$order];
    	return $this;
    }

    public function set_join($table, $where, $position='inner') {
    	$this->join[] = ['table'=>$table, 'where'=>$where, 'position'=>$position];
    	return $this;
    }

    public function set_where($where) {
    	$this->where[] = $where;
    	return $this;
    }

    public function set_group($group) {
        $this->group[] = $group;
        return $this;
    }
 
    private function _get_datatables_query()
    {
         
        $this->ci->db->from($this->table);

        foreach ($this->join as $key => $var) $this->ci->db->join($var['table'], $var['where'], $var['position']);
        foreach ($this->group as $key => $var) $this->ci->db->group_by($var);
        foreach ($this->where as $key => $var) $this->ci->db->where($var);


 
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if(@$_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    // $this->ci->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->ci->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->ci->db->or_like($item, $_POST['search']['value']);
                }
 
                // if(count($this->column_search) - 1 == $i) //last loop
                    // $this->ci->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->ci->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            foreach ($order as $key => $var) {
            	$this->ci->db->order_by($var['columns'], $var['order']);
            }
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if(@$_POST['length']) $this->ci->db->limit($_POST['length'], $_POST['start']);
        $data = $this->ci->db->get()->result_array();
        $output = array(
                "draw" => (@$_POST['draw']) ?: '0',
                "recordsTotal" => $this->count_all(),
                "recordsFiltered" => $this->count_filtered(),
                "data" => $data,
        );
        return $output;
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->ci->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        // $this->ci->db->from($this->table);
        // return $this->ci->db->count_all_results();
        $this->_get_datatables_query();
        $query = $this->ci->db->get();
        return $query->num_rows();
    }
 
}