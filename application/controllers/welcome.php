<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public $userRoot=0;
	public function __construct() {
		parent::__construct();
		header("Content-Type:text/html; Charset=utf-8");
		$this->load->library('session');
	}
	
	public function index() {
		if($this->session->userdata('username')) {
			header('Location:' . site_url('user'));
		}
		$this->load->helper('captcha');
		
		// 验证码数组
		$vals = array(
			'word' => rand(1000,9999),
			'img_path' => './captcha/',
			'img_url' => base_url() . 'captcha/',
			'font_path' => './font.ttf',
			'img_height' => '30',
			'expiration' => 10
		);
			$cap = create_captcha($vals); // 创建验证码数组
			
			$this->session->set_userdata('cap', $cap['word']); // 设置验证码SESSION数据
			
			$this->load->view('index',array('cap'=>$cap)); // 分配验证码和装载模板
	}
	
		// 用户登录
	public function doLogin() {
		$this->load->model('user_model');
		// 获取POST数据
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		$data = array('username' => $username, 'password' => $password);
		$rst = $this -> user_model -> getAllUsers($data);
		$arr = $rst->result_array();
		$code = $this->session->userdata('cap'); // 获取验证码SESSION
		
		if( $this->input->post('code') == $code ) {
			// 验证码正确操作
			if ($rst->num_rows() > 0) {
				// 登录成功操作
				$data = array(
					'username' => $username,
					'id' =>$arr[0]['id'] ,
					'root' => $arr[0]['type']
				);
				$this->session->set_userdata($data); // 保存用户名到SESSION
				$this->userRoot = $arr[0]['type'];
				$data = array(
					'result' => true,
					'data' => array(
						'username' => $username,
						'type' => $this->userRoot
					),
					'message' => '登录成功'
				);
				echo(json_encode($data));
				// $this->sendEmail();
			} else {
				// 登录失败操作
				$data = array(
					'result' => false,
					'data' => array(),
					'message' => '您填写的用户名或密码错误！'
				);
				echo(json_encode($data));
			}
		} else {
			// 验证码错误操作
			$data = array(
					'result' => false,
					'data' => array(),
					'message' => '验证码错误！'
				);
				echo(json_encode($data));
		}
	}
	
	public function code() {
		$this->load->helper('captcha');
		// 验证码数组
		$vals = array(
			'word' => rand(1000,9999),
			'img_path' => './captcha/',
			'img_url' => base_url() . 'captcha/',
			'font_path' => './font.ttf',
			'img_height' => '30',
			'expiration' => 10
		);
			$cap = create_captcha($vals); // 创建验证码数组
			
			$this->session->set_userdata('cap', $cap['word']); // 设置验证码SESSION数据
			echo(base_url() . 'captcha/' . $cap['time'] . '.jpg');
	}
	
	public function _errMsg($str) {
		$this -> load -> vars('msg',$str);
		$this -> load -> view('error/loginException');
	}
	
	// 发送邮件
	public function sendEmail() {
		if( $this->input->post("userType")) {
			$this->load->library('user_agent');
			$this->load->library('MY_Custom');
			$introInfo = $this->agent->agent_string();
			$location = $this->my_custom->requestIpAddress();
		
			$thistime = date("Y-m-d H:i:s",time());
			$website_url = site_url();
			$title = "系统登录提醒"; // 邮件标题
			$content ="<img src='http://img.lanrentuku.com/img/allimg/1002/34-10020GQG0.gif' />" . 
				"<h3>$title</h3><p>你最近在{$thistime}登录了，<br/>" . 
				"登录地点：{$location}<br />浏览器信息：{$introInfo}<br />" . 
				"请确认，提防非法用户潜入后台！</p><p>如有任何问题请联系技术支持。</p>" . 
				"<hr />数据统计系统技术支持 敬上"; // 邮件内容
			
			$this->my_custom->sendEmail($title, $content);
		}
	}
	
}