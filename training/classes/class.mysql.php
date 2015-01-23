<?php

require_once 'class.database.php';

/**
 * Description of class
 *
 * @author JD
 */
class mysql extends database {

	var $sql_status = false;
	var $row_count = 0;
	var $rows = array();
	var $resource = false;

	function __construct() {
		mysql_connect(HOSTNAME, USERNAME, PASSWORD);
		mysql_select_db(DATABASE);
	}

	/**
	 * 
	 * @param type $table The table name in database
	 * @param string $conditions WHERE conditions go in here
	 * @param type $order_column The column on which to run the ORDER BY query
	 * @param type $order The order - ASC or DESC only
	 * @param type $limit Maximum number of results that the query should return
	 * @return boolean True, if the query is successful, false otherwise
	 */
	function select($table = '', $conditions = '', $order_column = '', $order = 'asc', $limit = '') {
		$sql = "SELECT * FROM $table";
		if (trim($conditions) == '') {
			$conditions = '1 = 1';
		}
		$sql .= " WHERE $conditions";

		if (trim($order_column) != '') {
			$sql .= " ORDER BY $order_column $order";
		}
		if (trim($limit) != '') {
			$sql .= " LIMIT $limit";
		}
		//echo $sql;
		if ($result = mysql_query($sql)) {
			$this->sql_status = true;
			$this->row_count = mysql_num_rows($result);
			$this->resource = $result;
			return true;
		} else {
			echo mysql_error();
			return false;
		}
	}

	function get_number_of_records() {
		return $this->row_count;
	}

	function rows() {
		unset($this->rows);
		while ($row = mysql_fetch_array($this->resource)) {
			$this->rows[] = $row;
		}
		return $this->rows;
	}

	function update($table, $data = array(), $condition = '') {
		$sql = "UPDATE `$table` SET ";
		if (count($data) > 0) {
			$count = count($data);
			$i = 1;
			//$first = true;
			foreach ($data as $_k => $_v) {
				if ($i == $count) {
					$sql .= " `$_k` = '$_v' ";
				} else {
					$sql .= " `$_k` = '$_v', ";
				}
				/*
				  if($first) {
				  $sql .= "$_k = '$_v' ";
				  $first = false;
				  } else {
				  $sql .= " AND $_k = '$_v' ";
				  }
				 */
				$i++;
			}
			$sql .= " WHERE $condition ;";
			//echo $sql; die;
			// Run the query
			if ($result = mysql_query($sql)) {
				$this->sql_status = true;
				//$this->row_count = mysql_affected_rows($result);
				return true;
			} else {
				echo mysql_error();
				return false;
			}
		}
	}

}
