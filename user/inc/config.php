<?php 
ob_start();
session_start();

// error_reporting(0);
/************ SITE CONFIGURATION ***************/
define("SITE_URL", "http://healthcare.loc");
define('CMS_URL', SITE_URL.'/admin/');

define('ASSETS_URL', CMS_URL.'assets/');
define('CSS_URL', ASSETS_URL.'css/');
define('JS_URL', ASSETS_URL.'js/');

define('SITE_TITLE', 'Admin Panel Natours Healthcare');

/*************	Database Configuaration   **************/
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_NAME', 'healthcare');
define('DB_PASSWORD', '');

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD) OR die('Error establishing database connection.');
mysqli_select_db($conn, DB_NAME);
mysqli_query($conn, "SET NAMES utf8");
/*************	Database Configuaration   **************/


define('ALLOWED_EXTENSIONS', array('jpg','jpeg','png','gif','svg','bmp','jifi'));

define('UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT']."upload");
define("UPLOAD_URL", SITE_URL.'/upload/');

?>