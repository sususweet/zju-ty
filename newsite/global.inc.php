<?php
require_once 'global1.inc.php';

$ip = getClientIp();
//$ip = $_SERVER['REMOTE_ADDR'];
//print '<!--您当前IP地址是：'.$ip.'-->';
// 是否禁止当前ip访问
$jinzhi = false;
$is_xiaonei_ip = false;


$xiaonei_ip = array('210.32.', '222.205.','58.206.192.0','58.196.','10.','125.120.87.9','172.','192.168.','58.206.206.');
foreach($xiaonei_ip as $xn_ip) {
	if (strpos($ip,$xn_ip) === 0) {
		$is_xiaonei_ip = true;
		$jinzhi = false;
		break;
	}
}

$xiaowai_ip = array('10.14.200.158','10.22.34.','10.15.8.2');
foreach($xiaowai_ip as $xw_ip) {
	if (strpos($ip,$xw_ip) === 0) {
		$jinzhi = true;
		break;
	}
}
if($jinzhi === true || $is_xiaonei_ip === false) {
	Header("Location: http://www.tyys.zju.edu.cn/chinese/");  
	//print '对不起，浙江大学电气工程学院办公网只允许校内用户访问！<a href="http://ee.zju.edu.cn/chinese/" style="color:red;">点击进入中文网</a>';
	exit;
}

init_smarty();

$smarty->load_filter('output', 'convert_static_url');


 //获取用户IP地址
function getClientIp()
{
        if(!empty($_SERVER["HTTP_CLIENT_IP"]))
        {
            $cip = $_SERVER["HTTP_CLIENT_IP"];
        }
        else if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
        {
            $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
        else if(!empty($_SERVER["REMOTE_ADDR"]))
        {
            $cip = $_SERVER["REMOTE_ADDR"];
        }
        else
        {
            $cip = '';
        }
        preg_match("/[\d\.]{7,15}/", $cip, $cips);
        $cip = isset($cips[0]) ? $cips[0] : 'unknown';
        unset($cips);
        return $cip;
}
