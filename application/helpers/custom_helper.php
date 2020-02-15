<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function select2_preselect($selector='', $value='', $return=FALSE) {
	if (is_array($value)) {
		$text = $this->db->where($value->where_key, $value->where_val)->get($value->table)->row($value->text);
		if ($return) {
			return "initSelection : function (element, callback) {
				        var data = {id: '$value->where_val', text: '$value->text'};
				        callback(data);
				    };".PHP_EOL;
		} else {
			echo "initSelection : function (element, callback) {
				        var data = {id: '$value->where_val', text: '$value->text'};
				        callback(data);
				    };".PHP_EOL;
		}
	} else {
		if ($return) {
			return "$('$selector').val('$value').trigger('change');".PHP_EOL;
		} else {
			echo "$('$selector').val('$value').trigger('change');".PHP_EOL;
		}
	}
}