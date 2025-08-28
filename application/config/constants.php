<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


/*
|--------------------------------------------------------------------------
| Custome constant
|--------------------------------------------------------------------------
*/
date_default_timezone_set('Asia/Dhaka');
$root = "http://" . $_SERVER['HTTP_HOST'];
$root .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
$constants['base_url'] = $root;

// define('HOSTNAME','localhost');
// define('DBUSERNAME','root');
// define('DBPASSWORD','');
// define('DBNAME', 'land_pmis');

// windows path
define('BASH_PATH', $_SERVER['DOCUMENT_ROOT']. '/scouts/');
// define('BASH_PATH', 'E:/Server/htdocs/land_mis/');
// define('BASH_PATH', 'C:/xampp/htdocs/codeigniter-crop-image/');
// ubuntu path
// define('BASH_PATH', 'var/www/html/service.scouts.gov.bd/');
// MAC path
// define('BASH_PATH', '/Applications/XAMPP/htdocs/codeigniter-crop-image/');

define('USER_IP_ADDRESS', $_SERVER['REMOTE_ADDR']);
define('HTTP_CSS_PATH', $constants['base_url'] . 'awedget/assets/cropper/css/');
define('HTTP_IMAGES_PATH', $constants['base_url'] . 'awedget/assets/cropper/images/');

define('HTTP_JS_PATH', $constants['base_url'] . 'awedget/assets/cropper/js/');
define('HTTP_CROP_PATH', $constants['base_url'] . 'awedget/assets/cropper/crop/');


define('ROOT_UPLOAD_PATH', BASH_PATH . 'temp_dir/');
define('HTTP_USER_PROFILE_THUMB_PATH', $constants['base_url'] . 'temp_dir/_thumb/');
// define('ROOT_UPLOAD_PATH', BASH_PATH . 'awedget/assets/cropper/uploads/');
// define('HTTP_USER_PROFILE_THUMB_PATH', $constants['base_url'] . 'awedget/assets/cropper/uploads/_thumb/');


define('APPLICATION_NAME', 'Scouts');
define('APPLICATION_URL', '');
define('SITE_DELIMETER_MSG', 'Best regards,');
define('SITE_DELIMETER', 'bdquery');
define('SALT', FALSE);

define('TO_MAIL', 'xxx@xxx.com');
define('FROM_MAIL', 'xxx@xxx.com');
define('FROM_TEXT', 'BDQUERY');

define('DATE_FORMAT_SIMPLE', 'Y-m-d');

// TEST Paypal Express credential
// define('PRO_PAYPAL', 0);
// define("PAYPAL_CLIENTID", "ARHUUeNT_WdabZnL3AH6e5WY5sEDlj_wJawH1a7c7PkATfN3ZwyDTo0xOmAVUyDpLtO6skYM3Ooikl71");
// define("PAYPAL_SECRET", "EChDV9reG_PooeIbETe62ScIBWRl7Tv1HEe6SIk9c33vH8hDkUHXVUoKD3pttcNU2C_9Ho5HRP0f2C1L");
// define("PAYPAL_BASE_URL", "https://api.sandbox.paypal.com/v1/");
// define("PAYPAL_ENV", "sandbox");
// define('CURRENCY', 'USD');
