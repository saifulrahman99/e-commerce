<?php
$user_agent = $_SERVER['HTTP_USER_AGENT'];

function get_client_ip_env()
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'IP tidak dikenali';
    return $ipaddress;
}


function get_os()
{
    global $user_agent;
    $os_platform    =   "Unknown OS Platform";
    $daftar_os      =   array(
        '/windows nt 11.0/i'    =>  'Windows 11',
        '/windows nt 10.2/i'    =>  'Windows 11',
        '/windows nt 10.0/i'    =>  'Windows 10',
        '/windows nt 6.2/i'     =>  'Windows 8',
        '/windows nt 6.1/i'     =>  'Windows 7',
        '/windows nt 6.0/i'     =>  'Windows Vista',
        '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
        '/windows nt 5.1/i'     =>  'Windows XP',
        '/windows xp/i'         =>  'Windows XP',
        '/windows nt 5.0/i'     =>  'Windows 2000',
        '/windows me/i'         =>  'Windows ME',
        '/win98/i'              =>  'Windows 98',
        '/win95/i'              =>  'Windows 95',
        '/win16/i'              =>  'Windows 3.11',
        '/macintosh|mac os x/i' =>  'Mac OS X',
        '/mac_powerpc/i'        =>  'Mac OS 9',
        '/linux/i'              =>  'Linux',
        '/ubuntu/i'             =>  'Ubuntu',
        '/iphone/i'             =>  'iPhone',
        '/ipod/i'               =>  'iPod',
        '/ipad/i'               =>  'iPad',
        '/android/i'            =>  'Android',
        '/blackberry/i'         =>  'BlackBerry',
        '/webos/i'              =>  'Mobile'
    );

    foreach ($daftar_os as $regex => $value) {
        if (preg_match($regex, $user_agent)) {
            $os_platform    =   $value;
        }
    }
    return $os_platform;
}

function getting_browser()
{
    global $user_agent;
    $browser        =   "Unknown Browser";
    $daftar_browser  =   array(
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

    foreach ($daftar_browser as $regex => $value) {
        if (preg_match($regex, $user_agent)) {
            $browser    =   $value;
        }
    }
    return $browser;
}
$user_os        =   get_os();
$user_browser   =   getting_browser();
$ip_user  = get_client_ip_env();

$today = date('Y-m-d');
// echo php_uname();

// echo " $user_os $user_browser $ip_user";
$q_user = "SELECT * FROM pengunjung WHERE ip_address = '$ip_user' AND os = '$user_os'";
$select = mysqli_num_rows(mysqli_query($db, "$q_user"));

if ($select < 1) {
    $query = "INSERT INTO pengunjung(ip_address, browser, os, waktu) VALUES ('$ip_user','$user_browser','$user_os','$today')";

    $insert = mysqli_query($db, $query);
}


$sessionPengunjung = (isset($_SESSION['id_pengunjung'])) ? $_SESSION['id_pengunjung'] : '';
$coockiePengunjung = (isset($_COOKIE['id_pengunjung'])) ? $_COOKIE['id_pengunjung'] : '';

$select_id = mysqli_fetch_assoc(mysqli_query($db, "$q_user"));

if (empty($sessionPengunjung)) {

    $_SESSION['id_pengunjung'] = $select_id['id_pengunjung'];
}

if (empty($coockiePengunjung)) {
    setcookie('id_pengunjung', $select_id['id_pengunjung'], time() + (60 * 60 * 24 * 1), '/');
}

if (isset($_COOKIE['id_pengunjung'])) {
    if ($_COOKIE['id_pengunjung'] != $sessionPengunjung) {
        setcookie('id_pengunjung', $select_id['id_pengunjung'], time() + (60 * 60 * 24 * 1), '/');
    }
}
