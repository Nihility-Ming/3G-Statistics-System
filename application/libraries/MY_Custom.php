<?php
class MY_Custom extends CI_Controller {
	public function __construct() {
		parent::__construct();
	}
	
	// 发送电子邮件
	public function sendEmail($title, $content) {
		$this->load->library('email');
		$this->load->helper("url");
		
		$from = "ekawayi@163.com"; // 发件人 和 email.php里面的一样
		$to = "724849296@qq.com"; // 收件人
		
		$title .= " | 数据统计系统";
		$this->email->from($from, '数据统计系统(机器人)');
		$this->email->to($to);
		$this->email->subject($title);
		$this->email->message($content); 
		$this->email->attach("/images/index_03.png");
		$this->email->send();
		return true;
	}
	
	// 获取IP地址
	public function requestIpAddress() {
		if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) 
			$ip = getenv("HTTP_CLIENT_IP"); 
		else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) 
			$ip = getenv("HTTP_X_FORWARDED_FOR"); 
		else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) 
			$ip = getenv("REMOTE_ADDR"); 
		else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) 
			$ip = $_SERVER['REMOTE_ADDR']; 
		else {
			$ip = "unknown"; 
		}
		
		if( $ip == "unknown" || $ip == "::1") {
			$ip= "无法获取IP地址！";
		}
		
		$str = file_get_contents("http://ip.taobao.com/service/getIpInfo.php?ip={$ip}");
		$obj = json_decode($str);
		$printStr =  @"{$obj->data->country} {$obj->data->area} {$obj->data->isp} {$obj->data->region} {$obj->data->city} IP: {$obj->data->ip}";
		return ($printStr);
	}

}
?>