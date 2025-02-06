<?php

/**
 * Database config variables
 */
 /*
define("DB_HOST", "203.124.112.182");
define("DB_USER", "oditekdata");
define("DB_PASSWORD", "Oditek123@");
define("DB_DATABASE", "oditekdata");
*/
date_default_timezone_set('Asia/Kolkata');

$protocol = "http";

$url  =  $_SERVER['SERVER_NAME'];

$folder = "";

$url = $url.$folder;
define("ROOT_DIR",$protocol."://172.105.61.204//");
define("IT_IMG_PATH","/var/www/intra/upload_it/");
define("PR_IMG_PATH","/var/www/intra/upload_pr/");

define("SESSION_INACTIVE", 3600); // 60 min
define("DB_HOST", "localhost");
define("DB_USER", "tester");
define("DB_PASSWORD", "OdiTester@123");
define("DB_DATABASE", "oditek_intra");
define("USER_SITE_URL", "http://".$url."/");
define("ADMIN_SITE_URL", "http://".$url."/");
define("PREFIX", "od_");
define("PREFIX1", "od_");
define("BANNER_IMG_PATH", "../uploads/banner/");
define("USER_BANNER_IMG_PATH", "uploads/banner/");
define("EXCEL_PATH", "/var/www/intra/admin/excel_files/");

?>