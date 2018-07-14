<?php
require WESCMS_ROOT.'/../Snoopy.class.php';
require WESCMS_ROOT .'/lib/nusoap/lib/nusoap.php';


class WesSnoopy extends Snoopy {
  function delete($URI) {
		$URI_PARTS = parse_url($URI);
		if (!empty($URI_PARTS["user"]))
			$this->user = $URI_PARTS["user"];
		if (!empty($URI_PARTS["pass"]))
			$this->pass = $URI_PARTS["pass"];
		if (empty($URI_PARTS["query"]))
			$URI_PARTS["query"] = '';
		if (empty($URI_PARTS["path"]))
			$URI_PARTS["path"] = '';
				
		switch(strtolower($URI_PARTS["scheme"]))
		{
			case "http":
				$this->host = $URI_PARTS["host"];
				if(!empty($URI_PARTS["port"]))
					$this->port = $URI_PARTS["port"];
				if($this->_connect($fp))
				{
					if($this->_isproxy)
					{
						// using proxy, send entire URI
						$this->_httprequest($URI,$fp,$URI,'DELETE');
					}
					else
					{
						$path = $URI_PARTS["path"].($URI_PARTS["query"] ? "?".$URI_PARTS["query"] : "");
						// no proxy, send only the path
						$this->_httprequest($path, $fp, $URI, 'DELETE');
					}
					
					$this->_disconnect($fp);		
				}
				else
				{
					return false;
				}
				return true;					
				break;
      default:
        return false;
    }
  }
  function get_header($name) {
	  foreach ($this->headers as $header) {
	    if (stripos($header, $name . ':') === 0) {
		    return trim(substr($header, strlen($name) + 2));
      }
	  }
    return null;
  }
}

class ZJUSSO {
	const SESSIONURL =  "http://zuinfo.zju.edu.cn:8080/AMWebService/Session";
	const USERURL = "http://zuinfo.zju.edu.cn:8080/AMWebService/UserProfile";
	const POLICYURL = "http://zuinfo.zju.edu.cn:8080/AMWebService/Policy";
	public static $appUid = '';
	public static $appPwd = '';

  protected static function cookie() {
    return isset($_COOKIE['iPlanetDirectoryPro']) ? $_COOKIE['iPlanetDirectoryPro'] : '';
  }

	/**
	 * 若当前会话用户登录成功就返回学工号，否则返回FALSE
	 */
	static function is_login() {

    static $is_login = null;
    $cookie = self::cookie();
	  if (empty($cookie)) return false;
    if (!is_null($is_login)) return $is_login;

	  $snoopy = new WesSnoopy;
	  $snoopy->rawheaders['iPlanetDirectoryPro'] = $cookie;
	  $snoopy->rawheaders['appUid'] = self::$appUid;
	  $snoopy->rawheaders['appPwd'] = self::$appPwd;
	  $snoopy->fetch(self::SESSIONURL);
	  $uid = $snoopy->get_header('ZJU_SSO_UID');
      $is_login = is_null($uid) ? false : $uid;
      return $is_login;
	}

	public static function login($xgh, $password) {
	  $snoopy = new WesSnoopy;
		$headers = array();
		$headers['name'] = $xgh;
		$headers['password'] = $password;
		$headers['type'] = 1;
		$headers['module'] = 'DataStore';
		$headers['appUid'] = self::$appUid;
		$headers['appPwd'] = self::$appPwd;
		$snoopy->rawheaders = $headers;
		$snoopy->submit(self::SESSIONURL, array());
		$cookie = $snoopy->get_header('iPlanetDirectoryPro');
		
		if ($cookie) {
		  $_COOKIE['iPlanetDirectoryPro'] = $cookie;
		  setcookie('iPlanetDirectoryPro', $cookie, 0, '/', '.zju.edu.cn');
		}

	}

  /**
   * 统一身份认证注销
   */
	public static function logout() {
    $cookie = self::cookie();

    if (empty($cookie)) {
      return true;
    }

	$snoopy = new WesSnoopy;

    $snoopy->rawheaders['iPlanetDirectoryPro'] = $cookie;
	$snoopy->rawheaders['appUid'] = self::$appUid;
	$snoopy->rawheaders['appPwd'] = self::$appPwd;
    $snoopy->delete(self::SESSIONURL);
    $status = $snoopy->get_header('status');
    setcookie('iPlanetDirectoryPro', '', time() - 3600, '/', '.zju.edu.cn');
	}

  /**
   * 取当前登录用户信息，若未登录返回null，若已登录返回数组
   */
	public static function get_user_info() {
    static $user_info = null;

    $xgh = self::is_login();
    if (!$xgh) {
      return NULL;
    }
    if (!is_null($user_info)) {
      return self::$user_info;
    }

	  $snoopy = new WesSnoopy;

		$snoopy->rawheaders = array();
		$snoopy->rawheaders['id'] = $xgh;
		$snoopy->rawheaders['type'] = 1;
	    $snoopy->rawheaders['appUid'] = self::$appUid;
	    $snoopy->rawheaders['appPwd'] = self::$appPwd;
		$snoopy->fetch(self::USERURL);
		$user = array();
		$metas = array('name', 'uid', 'email', 'type', 'title', 'depname', 'position');
		foreach ($snoopy->headers as $header) {
		  $arr = explode(': ', $header, 2);
		  if (in_array($arr[0], $metas)) {
			$user[$arr[0]] = trim($arr[1]);
		  }
		}
    $user_info = $user;
    return $user_info;
	}
}

class ZJUSSO_SOAP{
	const service_uri = 'http://zuinfo.zju.edu.cn/services/IdentityWebService';
	
	/**
	* 取得学生邮箱、专业码、专业名称信息
	*/
	public static function get_zhuanyem($xuehao){
		return self::call_soap($xuehao,'equipexam','123456');	
	}
	
	/**
	* 取得学生院系代码、院系名称信息
	*/
	public static function get_person($xuehao){
		return self::call_soap($xuehao,'person','123456');	
	}
	
	public  function call_soap($stu,$manager,$password) {
	  $client = new soapclient(self::service_uri);
	  $client->soap_defencoding='UTF-8';
	  $client->decode_utf8 = false;
	
	  $stu = trim($stu);
	
	  $result = $client->call('getIdentityByUserID', array($manager, $password, $stu));
	  if ($result) {
		try {
		$sxe = new SimpleXMLElement(str_replace('GBK', 'UTF-8', $result));
		}
		catch (Exception $e) {
		  print $result;
		  continue;
		}
		//echo $sxe->getName() . "\n";
	
		$result = array();
		foreach ($sxe->children() as $child) {
			$result[strtolower($child->getName())] = iconv('UTF-8', 'GBK', $child[0]);
		}
		return $result;
	  }
	  return false;
	}
}
?>
