<?php
if(!defined('LOCAL_MODE')) {
	die('<span style="font-family: tahoma, arial; font-size: 11px">config file cannot be included directly');
}
if (LOCAL_MODE) {
    // Settings for local midas server do not edit here
    $ARR_CFGS["db_host"] = 'localhost';
	$ARR_CFGS["db_name"] = 'db_priyareg_com';
    $ARR_CFGS["db_user"] = 'root';
    $ARR_CFGS["db_pass"] = '';
	define('SITE_SUB_PATH', '/priyareg.com/priyareg.com');
 } else {
    // Settings for live server edit whenever shifting site to different server
  	$ARR_CFGS["db_host"] = 'localhost';
	$ARR_CFGS["db_name"] = 'db_priyareg_com';
    $ARR_CFGS["db_user"] = 'priyaregdbuser';
    $ARR_CFGS["db_pass"] = 'PriYayxppL80pf5NYyxppL80pf5NYyxppL80pf5N';
	define('SITE_SUB_PATH', '/priyareg.com/priyareg.com');
}
define('SITE_WS_PATH', 'http://'.$_SERVER['HTTP_HOST'].SITE_SUB_PATH);
define('SITE_BACKEND_BASE_URL', SITE_WS_PATH.'/backend-assets');
define('THUMB_CACHE_DIR', 'thumb_cache');
define('PLUGINS_DIR', 'includes/plugins');

define('UP_FILES_FS_PATH', SITE_FS_PATH.'/uploaded_files');
define('UP_FILES_WS_PATH', SITE_WS_PATH.'/uploaded_files');

define('DEFAULT_START_YEAR', 2011);
define('DEFAULT_END_YEAR', date('Y')+10);

define('ADMIN_EMAIL', 'info@priyareg.com');
define('SUPPORT_EMAIL', 'support@priyareg.com');
define('SITE_NAME', 'Priya Group');
define('SITE_TITLE', 'Priya Group ');
define('SITE_URL', 'www.priyareg.com');
define('TEST_MODE', false);

define('DEF_PAGE_SIZE', 10);
define('SITE_CSS', 'style.css');
?>