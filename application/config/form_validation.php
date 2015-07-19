<?php
$config = array(
	'welcome/doLogin' => array(
		array(
			'field'   => 'username', 
			'label'   => '用户名', 
			'rules'   => 'trim|required|alpha_numeric'
		),
		array(
			'field'   => 'password', 
			'label'   => '密码', 
			'rules'   => 'trim|required|alpha_numeric'
		),
		array(
			'field' => 'code',
			'label' => '验证码',
			'rules' => 'trim|required|exact_length[4]'
		)
	) // end welcome/doLogin
);
?>