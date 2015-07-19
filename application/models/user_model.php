<?php
class User_model extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this -> load -> database();
	}

	// 获取指定的用户，返回数量
	public function getUserNumRows($data) {
		$rst = $this -> db -> from('user') -> where($data) -> order_by('id','desc') -> get();
		return $rst -> num_rows();
	}
	
	// 获取指定用户，返回结果集
	public function getAllUsers($data) {
		$rst = $this -> db -> from('user') -> where($data) -> order_by('id', 'desc') -> get();
		return $rst;
	}
	
	// 获取所有用户，包括所有字段，返回数组
	public function getAllUser() {
		$rst = $this -> db -> from('user') -> order_by('id','desc') -> get();
		return $rst -> result_array();
	}
	
	// 添加用户
	public function addUser($data) {
		$this -> db -> insert('user', $data);
		return mysql_insert_id();
	}
	
	// 查询应用表
	public function getApp() {
		$rst = $this -> db -> from('app') -> order_by('id','asc') -> get();
		return $rst -> result_array();
	}
	
	// 按条件查询公共应用
	public function getPublicApp($data) {
		$rst = $this -> db -> from('app') -> where($data) -> order_by('id','desc') -> get();
		return $rst -> result_array();
	}
	
	// 添加公共应用
	public function addPublicApp($data) {
		$rst = $this->db->insert('app',$data);
		return $this->db->insert_id();
	}
	
	// 按条件删除公共应用
	public function deletePublicApp($data) {
		$rst = $this->db->delete('app',$data);
		return $this->db->affected_rows();
	}
	
	// 按条件修改公共应用表
	public function changeApp($data, $keyName) {
		$rst = $this->db->update_batch('app', $data, $keyName); 
		return $rst;
	}
	
	// 添加应用 下载地址
	public function addApp($data) {
		$rst = $this -> db -> insert('download', $data);
		return $this -> db -> insert_id();
	}
	
	// 获得指定用户的应用下载地址
	public function getUserAppDownload($data) {
		$rst = $this -> db ->  from('download') -> where($data) -> order_by('id','desc') -> get();
		return $rst -> result_array();
	}
	
	// 添加应用到指定用户
	public function addUserApp() {
		$data = array(
			'user_id' => $this->input->post('user_id'),
			'app_id' => $this->input->post('app_id'),
			'name' => $this->input->post('name'),
			'download' => $this->input->post('download')
		);
		// 判断是否存在重复的用户应用
		$where = array(
			'user_id' => $this->input->post('user_id'),
			'app_id' => $this->input->post('app_id'),
			'name' => $this->input->post('name')
		);
		if( $this -> db -> where($where) -> get('download') -> num_rows() > 0 ) {
			return false;
		}
		$this -> db -> insert('download',$data);
		return true;
	}
	
	// 删除用户的应用
	public function deleteUserApp($data) {
		$this -> db -> where($data)->delete('download');
	}
	
	// 获取某个用户的结算表
	public function showUserMoney($data) {
		$array = $this ->db -> from('money') -> where($data) -> order_by('id','desc') -> get();
		$array = $array -> result_array();
		return $array ;
	}
	
	// 获取某个用户的日期数量表
	public function showUserDataNum($data) {
		$array = $this ->db -> from('date') -> where($data) -> order_by('id','desc') -> get();
		$array = $array -> result_array();
		return $array ;
	}
	
	
	public function changePassword($id, $data) {
		$rst = $this -> db -> where('id', $id) -> update('user', $data);
		return $rst;
	}
	
	// 删除某条结算记录
	public function deleteUserMoney($data) {
		$this -> db -> where($data) -> delete('money');
		return $this -> db -> affected_rows();
	}
	
	// 修改某条结算记录
	public function changeUserMoney($where) {
		$data = array(
			'money' => $this->input->post('money'),
			'poundage' => $this->input->post('poundage'),
			'reality' => $this->input->post('reality'),
			'bank_name' => $this->input->post('bank_name'),
			'bank_accument' => $this->input->post('bank_accument'),
			'cycle' => $this->input->post('cycle'),
			'status' => $this->input->post('status'),
		);
		$this -> db -> where($where) -> update('money',$data);
		return $this -> db -> affected_rows();
	}
	
	// 为该用户添加结算记录
	public function addUserMoney() {
		$data = array(
			'money' => $this->input->post('money'),
			'poundage' => $this->input->post('poundage'),
			'reality' => $this->input->post('reality'),
			'bank_name' => $this->input->post('bank_name'),
			'bank_accument' => $this->input->post('bank_accument'),
			'cycle' => $this->input->post('cycle'),
			'status' => $this->input->post('status'),
			'user_id' => $this->input->post('id'),
		);
		$this -> db -> insert('money', $data);
		return $this -> db -> insert_id();
	}
	
}
?>