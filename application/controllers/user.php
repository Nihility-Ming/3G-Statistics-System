<?php
class User extends CI_Controller {
	public $username; // 用户名
	public $user_id; // 用户ID
	public $userRoot = 0; // 用户权限
	
	public function __construct() {
		parent::__construct();
		header("Content-Type:text/html; Charset=utf-8");
		$this->load->library('session');
		$this -> username = $this -> session -> userdata('username');
		$this -> user_id = $this -> session -> userdata('id');
		$this -> userRoot = $this -> session -> userdata('root');
		if (!$this -> username) {
			exit('<h1 style="text-align:center;margin-top:300px;">- _ - |||</h1><h3 style="text-align:center">错误提示：非法操作！</h3>');
		}
		
		$this->load->model('user_model');
	}
	
	public function index() {
		if (!$this -> username) {
			$this -> _errMsg("禁止未登录操作！");
		} else {
			$userData = $this -> user_model -> getUserAppDownload(array('user_id' => $this -> user_id)); // 获取当前用户应用
			
			$data = array(
				'username' => $this -> username,
				'userData' => $userData,
				'userRoot' =>  $this -> userRoot
			);
			$this -> load -> view('admin',$data);
		}
	}
	
	// 展示添加会员页
	public function showAddUser() {
		if( !$this->userRoot ) exit('非法入侵者，你可能是黑客，你已被记录！');
		
		$appname = $this -> user_model -> getApp(); // 获取应用名
		$this -> load -> vars('appname',$appname);
		$this -> load -> view('data/add_user');
	}
	
	// 添加会员
	public function doAddUser() {
		
		$data = array(
			'username' =>$this -> input -> post('username'),
			'password' =>  $this -> input -> post('password'),
			'realname' => $this -> input -> post('realname'),
			'bank_name' =>  $this -> input -> post('bank_name'),
			'bank_accument' => $this -> input -> post('bank_accument'),
			'join_date' => date("Y-m-d",time())
		);
		$user_id = $this -> user_model ->addUser($data); // 添加用户返回ID
		
		$id = $this -> input -> post('id'); // 获得应用ID数组
		$download = $this -> input -> post('download'); // 获得下载地址数组
		$name = $this -> input -> post('name'); // 获得应用名称
		// 判断是否选择了添加应用
		if( count($id) > 0 ) {
			// 生成二维数组$data2，用来储存App的ID和下载地址
			for($i= 0;$i<count($id); $i++) {
				$data2[$i] = array(
					'user_id' => $user_id,
					'app_id' => $id[$i],
					'name' => $name[$i],
					'download' => $download[$i]
				);
			}
			
			foreach($data2 as $item) {
				$this -> user_model -> addApp($item); // 添加用户应用下载地址
			}
		} // end if
		
		echo("用户添加成功！");
	}
	
	public function doCheckSameUserName() {
		if( $this -> db -> where('username',$this -> input -> post('username')) -> get('user') -> num_rows() > 0) exit('false'); // 检查是否存在同名
	}
	
	// 查看用户 check_user.php
	public function showCheckUser() {
		if( !$this->userRoot ) exit('非法入侵者，你可能是黑客，你已被记录！');
		$rst = $this -> user_model -> getAllUser();
		$this -> load -> vars('rst', $rst);
		$this -> load -> view('data/check_user');
	}
	
	// 修改管理员密码
	public function showChangePassword() {
		if( !$this->userRoot ) exit('非法入侵者，你可能是黑客，你已被记录！');
		$data = array('username' => $this -> username);
		$this -> load -> view("data/change_password", $data);
	}
	
	// 动作：修改管理员密码
	public function doChangePassword() {
		
		$data = array(
			'id' => $this -> user_id,
			'password' => $this->input->post('s_pwd')
		);
		$bool = $this -> user_model -> getUserNumRows($data);
		if( $bool > 0 ) {
			// 验证原始密码成功操作
			if( $this->input->post('n_pwd1') == $this->input->post('n_pwd2') ) {
				// 验证两次密码正确操作
				$data = array(
					'password' =>  $this->input->post('n_pwd2')
				);
				$this -> user_model -> changePassword($this -> user_id, $data);
				echo('修改成功！');
			} else {
				// 验证两次密码失败操作
				echo('两次输入的密码不一致！');
			}
		} else {
			// 验证原始密码失败操作
			echo('原始密码错误！');
		}
	}
	
	// 公共应用列表
	public function showPublicApp() {
		if( !$this->userRoot ) exit('非法入侵者，你可能是黑客，你已被记录！');
		$data = $this -> user_model -> getApp();
		$this -> load -> view("data/public_app", array('data' => $data));
	}
	
	public function changePublicApp() {
		
		for($i =0;$i < count($_POST['id']); $i++) {
			$data[$i] = array(
				'id' => $_POST['id'][$i],
				'name' =>  $_POST['name'][$i],
				'download' =>  $_POST['download'][$i]
			);
			
			// 更新用户应用表里面的
			$update = array('name' => $_POST['name'][$i]);
			$this -> db -> where('app_id', $_POST['id'][$i]) -> update('download', $update);
		}
		// 更新公共应用表里面的
		$this -> user_model -> changeApp($data, 'id');
		
		echo('修改成功！');
	}
	
	// 添加公共应用
	public function addPublicApp() {
		if( $this -> db -> where('name', $this -> input -> post('name')) -> get('app') -> num_rows() > 0 ) exit('添加失败：已存在相同名称的应用！');
		$data = array(
			'name' =>  $this -> input -> post('name'),
			'download' =>  $this -> input -> post('download')
		);
		$this -> user_model -> addPublicApp($data);
		echo('成功添加公共应用：' . $data['name']);
	}
	
	// 删除公共应用
	public function deletePublicApp() {
		
		$data = array('id' => $this->input->post('id'));
		$this -> user_model -> deletePublicApp($data);
		
		$xdata = array('name' => $this->input->post('name'));
		$this -> user_model -> deleteUserApp($xdata); // 顺便用户里面的此应用
		echo('成功删除' . $this->input->post('name')  .'！');
	}
	
	// 显示修改用户资料页
	public function showChangeUser($id) {
		if( !$this->userRoot ) exit('非法入侵者，你可能是黑客，你已被记录！');
		$data = array('id' => $id);
		$user_arr = $this -> user_model -> getAllUsers($data); // 获得用户表结果集
		$user_arr = $user_arr -> result_array(); // 获得数组
		$user_arr = $user_arr[0];
	
		$data2 = array('user_id' => $id);
		$download_arr = $this -> user_model -> getUserAppDownload($data2) ; //此用户的应用结果集

		$data3 = $this -> db -> get('app');
		$data3 = $data3->result_array();
		
		$data4 = array(
			'app_arr' => $data3,
			'user_arr' => $user_arr,
			'download_arr' => $download_arr
		);
		$this -> load -> view('data/change_user', $data4);
		
	}
	
	// 添加用户应用
	public function addUserApp() {
		
		if($this -> user_model -> addUserApp()) {
			echo("添加成功！");
		} else {
			echo("添加失败：存在相同的用户应用名称，请修改！");
		}
	}
	
	// 删除指定用户的应用
	public function deleteUserApp($id) {
		
		$xdata = array('id' => $id);
		$this -> user_model -> deleteUserApp($xdata);
		echo("删除成功！");
	}
	
	// 更新用户数据
	public function doChangeUser() {
		
		$userData = array(
			'password' =>  $_POST['password'],
			'realname' =>  $_POST['realname'],
			'bank_accument' =>  $_POST['bank_accument'],
			'bank_name' =>  $_POST['bank_name']
		);
		$this -> db -> where('id',$_POST['user_id']) -> update('user',$userData); // 更新用户数据
	
		for($i=0;$i<count($_POST['id']);$i++) {
			$appData[$i] = array(
				'id' => $_POST['id'][$i],
				'name' =>  $_POST['name'][$i],
				'download' =>  $_POST['download'][$i]
			);
		}
		$this -> db -> update_batch('download', $appData,'id'); // 更新下载表应用
		echo("修改用户数据和用户应用成功！");
	}
	
	// 删除用户
	public function deleteUser($id) {
		
		$this -> db -> where('id',$id) -> delete('user');
		$this -> db -> where('user_id',$id) -> delete('date');
		$this -> db -> where('user_id',$id) -> delete('download');
		$this -> db -> where('user_id',$id) -> delete('money');
		echo('删除用户成功！');
	}
	
	// 某个用户数量和日期页面 showUserAppData.php
	public function showUserDataNum($id) {
		if( !$this->userRoot ) exit('非法入侵者，你可能是黑客，你已被记录！');
		$data = array(
			'user_id' => $id
		);
		$app = $this -> user_model -> getUserAppDownload($data); // 获取该用户的应用表
		
		$userData = $this -> user_model -> getAllUsers(array('id'=>$id)); // 获取用户信息
		$userData = $userData -> result_array();
		$userData = $userData[0];
		// 分配数据
		$data = array(
			'app'  =>$app,
			'user' => $userData
		);
		
		$this -> load -> view("data/showUserDataNum",$data);
	}
	
	// 调用下拉框应用查询 
	public function selectAppDateNum($user_id,$app_id) {
		
		$today = date("Y-m-d",time()-3600*24);
		// $ageday = date("Y-m-d",time()-3600*24*6);
		// $data = $this -> db -> query("SELECT * FROM pf_date WHERE user_id={$user_id} AND app_id={$app_id} AND date BETWEEN '{$ageday}' AND '{$today}' ORDER BY date DESC");
		//$data = $data -> result_array();
		
		// echo('<tr><td colspan="4" style="font-weight:bold">以下是该用户应用近七日的数据</td></tr>');
		for($i = 0;$i<7; $i++) {
			$where = array(
				'user_id' => $user_id,
				'app_id' => $app_id,
				'date' => $today
			);
			$arr = $this -> db -> where($where) -> get('date') -> result_array();
			echo("<tr>");
			echo("<td>$today <input type='hidden' name='cdate[]' value='$today'/></td>");
			if( $arr ) {
				echo("<td><input type='text' name='camount[]' value='{$arr[0]['amount']}' style='width:100px;text-align:center' /></td>");
				echo("<td><input type='text' name='cprice[]' value='{$arr[0]['price']}' style='width:100px;text-align:center' /></td>");
				echo("<td><input type='text' name='cincome[]' value='{$arr[0]['income']}' style='width:100px;text-align:center' /></td>");
			} else {
				echo("<td><input type='text' name='camount[]' style='width:100px;text-align:center' /></td>");
				echo("<td><input type='text' name='cprice[]' style='width:100px;text-align:center' /></td>");
				echo("<td><input type='text' name='cincome[]' style='width:100px;text-align:center' /></td>");
			}
			echo("</tr>");
			$today = date("Y-m-d",time()-3600*24*($i+2));
		}
		
	}
	
	// 设置时间段
	public function setStepTime() {
		
		$user_id = $this -> input ->post('user_id');
		$app_id = $this -> input ->post('app_id');
		$start_date = $this -> input ->post('start_date');
		$end_date = $this -> input ->post('end_date');
		$dateobj = new DateTime($end_date);
		
		$bool = true;
		while($bool) {
			$arr = $this -> db -> query("SELECT * FROM pf_date WHERE date='{$dateobj->format('Y-m-d')}' AND user_id=$user_id AND app_id=$app_id ORDER BY date DESC") -> result_array();
			echo("<tr>");
			echo("<td>{$dateobj->format('Y-m-d')}<input type='hidden' name='cdate[]' value='{$dateobj->format('Y-m-d')}'/></td>");
			if( count($arr) > 0 ) {
				echo("<td><input type='text' name='camount[]' value='{$arr[0]['amount']}' style='width:100px;text-align:center' /></td>");
				echo("<td><input type='text' name='cprice[]' value='{$arr[0]['price']}' style='width:100px;text-align:center' /></td>");
				echo("<td><input type='text' name='cincome[]' value='{$arr[0]['income']}' style='width:100px;text-align:center' /></td>");
			} else {
				echo("<td><input type='text' name='camount[]' style='width:100px;text-align:center' /></td>");
				echo("<td><input type='text' name='cprice[]' style='width:100px;text-align:center' /></td>");
				echo("<td><input type='text' name='cincome[]' style='width:100px;text-align:center' /></td>");
			}
			echo("</tr>");
			$dateobj->modify("-1 day");
			if ( $dateobj->format("Y-m-d") < $start_date) {
				$bool = false;
			}
		}
		
	}
	
	// *当前位置 设置用户时间段
	public function showUserSetTime() {
		$user_id = $this -> input ->post('user_id');
		$app_id = $this -> input ->post('app_id');
		$start_date = $this -> input ->post('start_date');
		
		$end_date = $this -> input ->post('end_date');
		$dateobj = new DateTime($end_date );
		//$i=1;
		
		$bool = true;
		while($bool) {
			$arr = $this -> db -> query("SELECT * FROM pf_date WHERE date='{$dateobj->format('Y-m-d')}' AND user_id=$user_id AND app_id=$app_id ORDER BY date DESC") -> result_array();
			echo("<tr>");
			//echo("<td>{$i}</td>");
			echo("<td>{$dateobj->format('Y-m-d')}</td>");
			if( $arr ) {
				echo("<td class='sumNum'>{$arr[0]['amount']}");
				echo("<td class='sumPrice'>{$arr[0]['price']}</td>");
				echo("<td class='sumIncome'>{$arr[0]['income']}</td>");
			} else {
				echo("<td></td>");
				echo("<td></td>");
				echo("<td></td>");
			}
			echo("</tr>");
			$dateobj->modify("-1 day");
			//$i++;
			if ( $dateobj->format("Y-m-d") < $start_date) {
				$bool = false;
			}
		}
	}
	
	
	// 修改指定用户指定应用的日期和数量
	public function changeAppDateNum($user_id,$app_id) {
		
		for( $i = 0; $i < count($_POST['camount']); $i++ ) {
			$where = array(
				'user_id' => $user_id,
				'app_id' => $app_id,
				'date' => $_POST['cdate'][$i]
			);
			$data = array(
				'amount' => $_POST['camount'][$i],
				'price' => $_POST['cprice'][$i],
				'income' => $_POST['cincome'][$i]
			);
			if( $this -> db -> where($where) -> get('date') -> num_rows() > 0) { // 如果存在，则是更新
				$this -> db -> where($where) -> update('date', $data);
			} else { // 否则则是插入新数据
				if($_POST['camount'][$i]!='' ||  $_POST['cprice'][$i]!='' || $_POST['cincome'][$i]!='') {
						$insertData = array(
						'user_id' => $user_id,
						'app_id' => $app_id,
						'date' => $_POST['cdate'][$i],
						'amount' => $_POST['camount'][$i]!='' ? $_POST['camount'][$i] : '',
						'price' => $_POST['cprice'][$i]!='' ? $_POST['cprice'][$i] : '',
						'income' => $_POST['cincome'][$i]!='' ? $_POST['cincome'][$i] : ''
					);
					$this -> db -> insert('date', $insertData);
				}
				
			}
		}

		echo('更新数据成功！');	
		
	}
	
	// 获取某个用户结算信息user_money.php
	public function showUserMoney($id) {
		if( !$this->userRoot ) exit('非法入侵者，你可能是黑客，你已被记录！');
		$data = array(
			'user_id' => $id
		);
		$moneyData = $this -> user_model -> showUserMoney($data); // 获取该用户的结算表
		
		$userData = $this -> user_model -> getAllUsers(array('id'=>$id)); // 获取用户信息
		$userData = $userData -> result_array();
		$userData = $userData[0];
		// 分配数据
		$data = array(
			'money' =>$moneyData,
			'user' => $userData
		);
		$this -> load -> view("data/user_money",$data);
	}
	
	// 删除某条结算记录
	public function deleteUserMoney($id) {
		if( !$this->userRoot ) exit('非法入侵者，你可能是黑客，你已被记录！');
		$data = array('id' => $id);
		$this -> user_model -> deleteUserMoney($data);
		echo("成功删除该结算记录！");
	}
	
	// 修改某条结算记录
	public function changeUserMoney($id) {
		
		$data = array('id' => $id);
		$this -> user_model -> changeUserMoney($data);
		echo("成功修改该结算记录！");
	}
	
	// 为该用户添加结算记录
	public function addUserMoney() {
		
		$this -> user_model ->addUserMoney();
		echo("添加结算记录成功！");
	}
	
	/****************  用户模块 *****************/
	// 查看自己的结算信息
	public function showMyMoney() {
		$where = array ( 'user_id' => $this->user_id );
		$arr  = $this -> user_model -> showUserMoney($where );
		$data = array(
			'money' => $arr
		);
		$this->load->view('user/money',$data);
	}
	
	// 查看自己的应用
	public function showMyApp() {
		$where = array('user_id' => $this->user_id);
		$arr = $this -> user_model -> getUserAppDownload($where); // 获取该用户的应用表
		$d2 = array();
		foreach($arr as $key => $item) {
			$newArr = $this->db->where('name',$item['name'])->get('app')->result_array();
			$d2[$key] = $newArr[0]['id'];
		}
		
		$data = array(
			'd1' => $arr,
			'd2' => $d2
		);
		$this->load->view('user/myapp',$data);
	}
	
	public function downMyPublicApp($id) {
		$arr = $this->db->where('id',$id)->get('app')->result_array();
		if(!$arr) exit("<h3>该资料包可能已被删除！</h3>");
		$download = $arr[0]['download'];
		header('Location:' . $download);
	}
	
	// 查看数量和日期
	public function showNumDate($id) {
		
		$today = date("Y-m-d",time()-3600*24);
		$ageday = date("Y-m-d",time()-3600*24*7);
		$user_id = $this->user_id;
		$app_id = $id;
		$rst = $this -> db -> query("SELECT * FROM pf_date WHERE user_id={$user_id} AND app_id={$app_id} AND date BETWEEN '{$ageday}' AND '{$today}' ORDER BY date DESC");
		$arr = $rst -> result_array();
		
		$this->load->view('user/date', array('arr' => $arr,'id'=> $id,  'user_id' => $user_id, 'app_id' => $app_id));
	}
	
	// 添加时间和日期
	public function addUserDataNum() {
		
		for($i = 0; $i < count($_POST['date']); $i++) {
			$data[$i] = array(
				'user_id' => $_POST['user_id'],
				'app_id' => $_POST['app_id'],
				'amount' => $_POST['num'][$i],
				'date' => $_POST['date'][$i]
			);
			
			// 检查是否存在相同日期的数据
			$where = array(
				'user_id' => $_POST['user_id'],
				'app_id' => $_POST['app_id'],
				'date' => $_POST['date'][$i]
			);
			if( $this -> db -> from('date') -> where(	$where) -> get() -> num_rows() > 0) {
				echo("已存在相同的日期{$_POST['date'][$i]}，请检查后添加!");
				exit();
			}
			
		}
		$this->db->insert_batch('date' ,$data);
		echo("添加日期和数量的数据成功！");
	}
	
	// 修改密码并且发送电子邮件
	public function getBackPassword() {
		
		// 获取管理员账号密码
		$data = array(
			'username' => $this->session->userdata('username'),
			'type' => '1'
		);
		$rst = $this -> user_model -> getAllUsers($data);
		$num = $rst -> num_rows();
		if(!$num > 0 ) {
			exit("您的账号有误，请联系作者解决。");
		}
		$rst = $rst -> result_array();
		$username = $rst[0]['username'];
		$password = $rst[0]['password'];
		$website_url = site_url();
		
		// 发送邮件
		$title = "修改密码成功"; // 邮件标题
		$content ="<h3>$title</h3><p>你最近修改了密码！快拿纸记住吧：</p><hr /><p>管理员账号：<b>$username</b><br />密码：<b>$password</b></p><hr /><p>网站地址：<a href='$website_url'>$website_url</a></p>"; // 邮件内容
		$this->load->library('MY_Custom');
		if( $this->my_custom->sendEmail($title, $content) ) {
			echo("该信息已发送到指定邮箱！");
		} else {
			echo("发送邮件失败，请检查配置文件！");
		}
	}
	
	
	
	// 用户退出
	public function out() {
		$this->session->sess_destroy(); // 销毁所有session
		$this -> username = '';
		$this -> user_id = '';
		$this -> _errMsg("成功退出，欢迎下次再来！");
	}
	
	// 用户登录错误提示 loginException.php
	public function _errMsg($str) {
		$this -> load -> vars('msg',$str);
		$this -> load -> view('error/loginException');
	}
}
?>