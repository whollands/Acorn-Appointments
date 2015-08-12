<?php defined("ACORN_EXECUTE") or die("Access Denied.");


function Check_Auth_User()
{
	if($_SESSION["ACORN_LOGIN"] != true)
	{
		$PathInfo = ParsePath();
		$_SESSION["ACORN_AUTH_RETURN"] = $_SERVER['REQUEST_URI'];
		
		header("Location: " . constant("BASE_URL") . "login");
		exit;
	}
}


function CleanID($ID) {
return preg_replace("/[^0-9]/", rand(000,999), $ID);
}


function CleanData($Data) {
	$Data = trim($Data);
	$Data = stripslashes($Data);
  	$Data = htmlspecialchars($Data);
  	return $Data;
}

function ParsePath() {
  $path = array();
  if (isset($_SERVER['REQUEST_URI'])) {
    $request_path = explode('?', $_SERVER['REQUEST_URI']);

    $path['base'] = rtrim(dirname($_SERVER['SCRIPT_NAME']), '\/');
    $path['call_utf8'] = substr(urldecode($request_path[0]), strlen($path['base']) + 1);
    $path['call'] = utf8_decode($path['call_utf8']);
    if ($path['call'] == basename($_SERVER['PHP_SELF'])) {
      $path['call'] = '';
    }
    $path['call_parts'] = explode('/', $path['call']);

    $path['query_utf8'] = urldecode($request_path[1]);
    $path['query'] = utf8_decode(urldecode($request_path[1]));
    $vars = explode('&', $path['query']);
    foreach ($vars as $var) {
      $t = explode('=', $var);
      $path['query_vars'][$t[0]] = $t[1];
    }
  }
return $path;
}


function getOS($user_agent) { 

    $os_platform    =   "Unknown OS Platform";

	$win = '<i class="fa fa-windows"></i> ';
	
    $os_array       =   array(
                            '/windows nt 10/i'     =>  $win.'Windows 10',
                            '/windows nt 6.3/i'     =>  $win.'Windows 8.1',
                            '/windows nt 6.2/i'     =>  $win.'Windows 8',
                            '/windows nt 6.1/i'     =>  $win.'Windows 7',
                            '/windows nt 6.0/i'     =>  $win.'Windows Vista',
                            '/windows nt 5.2/i'     =>  $win.'Windows Server 2003/XP x64',
                            '/windows nt 5.1/i'     =>  $win.'Windows XP',
                            '/windows xp/i'         =>  $win.'Windows XP',
                            '/windows nt 5.0/i'     =>  $win.'Windows 2000',
                            '/windows me/i'         =>  $win.'Windows ME',
                            '/win98/i'              =>  $win.'Windows 98',
                            '/win95/i'              =>  $win.'Windows 95',
                            '/win16/i'              =>  $win.'Windows 3.11',
                            '/macintosh|mac os x/i' =>  '<i class="fa fa-desktop"></i> Mac OS X',
                            '/mac_powerpc/i'        =>  '<i class="fa fa-desktop"></i> Mac OS 9',
                            '/linux/i'              =>  '<i class="fa fa-linux"></i> Linux',
                            '/ubuntu/i'             =>  '<i class="fa fa-linux"></i> Ubuntu',
                            '/iphone/i'             =>  '<i class="fa fa-apple"></i> iPhone',
                            '/ipod/i'               =>  '<i class="fa fa-apple"></i> iPod',
                            '/ipad/i'               =>  '<i class="fa fa-apple"></i> iPad',
                            '/android/i'            =>  '<i class="fa fa-mobile"></i> Android',
                            '/blackberry/i'         =>  '<i class="fa fa-mobile"></i> BlackBerry',
                            '/webos/i'              =>  '<i class="fa fa-mobile"></i> Mobile'
                        );

    foreach ($os_array as $regex => $value) { 

        if (preg_match($regex, $user_agent)) {
            $os_platform    =   $value;
        }

    }   

    return $os_platform;

}

function getBrowser($user_agent) {

    $browser        =   "Unknown Browser";

    $browser_array  =   array(
                            '/msie/i'       =>  'Internet Explorer',
                            '/firefox/i'    =>  'Firefox',
                            '/safari/i'     =>  'Safari',
                            '/chrome/i'     =>  'Chrome',
                            '/opera/i'      =>  'Opera',
                            '/netscape/i'   =>  'Netscape',
                            '/maxthon/i'    =>  'Maxthon',
                            '/konqueror/i'  =>  'Konqueror',
                            '/mobile/i'     =>  'Handheld Browser'
                        );

    foreach ($browser_array as $regex => $value) { 

        if (preg_match($regex, $user_agent)) {
            $browser    =   $value;
        }

    }

    return $browser;

}
