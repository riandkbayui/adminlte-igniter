<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Select2 {
	
	private $collumns;
	private $table;
	private $search;
	private $where;
	private $where_in;
	private $where_in_columns;

	function where($where) {
		$this->where = $where;
		return $this;
	}

	function where_in($where_in_columns ,$where_in){
		$this->where_in_columns = $where_in_columns;
		$this->where_in = $where_in;
		return $this;
	}

	function from($table) {
		$this->table = $table;
		return $this;
	}

	function select($id='', $text='') {
		$this->collumns = array($id, $text);
		return $this;
	}

	function search($search) {
		$this->search = $search;
		return $this;
	}

	function generate($return = TRUE) {
		$collumns = $this->collumns;
		$search = @$_POST['searchTerm'];
		$tb = get_instance()->db->like($collumns[1], $search);
		if(!empty($this->where))    get_instance()->db->where($this->where);
		if(!empty($this->where_in)) get_instance()->db->where_in($this->where_in_columns, $this->where_in);
		$tb = get_instance()->db->get($this->table)->result_array();
		$array = array();
		foreach ($tb as $key => $val) {
			$array[] = array(
				'id' => $val[$collumns[0]],
				'text' => $val[$collumns[1]],
			);
		}
		header('Content-Type: application/json');
		if ($return) {
			return json_encode($array, JSON_PRETTY_PRINT);
		} else {
			print_r(json_encode($array, JSON_PRETTY_PRINT));
		}
	}

	function create($u='') {
		$url = base_url($u);
		$str = "
				ajax: { 
		           url: '$url',
		           type: 'post',
		           dataType: 'json',
		           delay: 250,
		           data: function (params) {
		              return {
		                searchTerm: params.term // search term
		              };
		           },
		           processResults: function (response) {
		              return {
		                 results: response
		              };
		           },
		           cache: true
		        }
		";
		print_r($str);
	}

	function select2_preselect($selector='', $value='', $return=FALSE) {
		$CI =& get_instance();
		if (is_array($value)) {
			$value = json_decode(json_encode($value));
			$text = $CI->db->where($value->where_key, $value->where_val)->get($value->table)->row($value->text_val);
			if ($return) {
				return "<option att=\"$text\" value=\"$value->where_val\">$text</option>";
			} else {
				echo "<option att=\"$text\" value=\"$value->where_val\">$text</option>";
			}
		} else {
			if ($return) {
				return "$('$selector').val('$value').trigger('change');".PHP_EOL;
			} else {
				echo "$('$selector').val('$value').trigger('change');".PHP_EOL;
			}
		}
	}

	function option_create($setup=array(), $return = false) {
		/*
			$set->where = where pada databse harus array
			$set->val_id = id dari tabel
			$set->val_text = label dari tabel
			$set->id = id yang digunakan untuk selected
			$set->table = tabel tujuan
		*/
		$set = json_decode(json_encode($setup));
		$CI =& get_instance();
		if (@$set->where) {
			$where = json_decode(json_encode($set->where), TRUE);
			if(is_array(@$where) && !empty(@$where)) $CI->db->where($where);
		}
		$db = $CI->db->get($set->table)->result();
		$str = '';
		foreach ($db as $key => $var) {
			$val_id = $set->val_id;
			$val_text = $set->val_text;
			$selected = ($var->$val_id == @$set->id) ? 'selected=""' : '';
			$str .= "<option ".$selected." value=\"".$var->$val_id."\">".$var->$val_text."</option>".PHP_EOL;
		}
		if ($return) {
			return $str;
		} else {
			echo $str;
		}
	}

}