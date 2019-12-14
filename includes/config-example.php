<?php
/*
config.php

stores configuration information for our web application

*/

//removes header already sent errors
ob_start();

define('SECURE',false); #force secure, https, for all site pages

define('PREFIX', ''); #Adds uniqueness to your DB table names.  Limits hackability, naming collisions

header("Cache-Control: no-cache");header("Expires: -1");#Helps stop browser & proxy caching

define('DEBUG',true); #we want to see all errors

include 'credentials.php';//stores database info
include 'common.php';//stores favorite functions

//prevents date errors
date_default_timezone_set('America/Los_Angeles');

//create config object
$config = new stdClass;

//CHANGE TO MATCH YOUR PAGES
$config->nav1['template.php'] = 'Template';
$config->nav1['db-test.php'] = 'DB Test';
$config->nav1['customer_list.php'] = 'Customers';
$config->nav1['daily.php'] = 'Daily';
$config->nav1['contact.php'] = 'Contact';

//create default page identifier
define('THIS_PAGE',basename($_SERVER['PHP_SELF']));

//START NEW THEME STUFF - be sure to add trailing slash!
$sub_folder = 'widgets/';//change to 'widgets' or 'sprockets' etc.
$config->theme = 'Clean';//sub folder to themes

//will add sub-folder if not loaded to root:
$config->physical_path = $_SERVER["DOCUMENT_ROOT"] . '/' . $sub_folder;
//force secure website
if (SECURE && $_SERVER['SERVER_PORT'] != 443) {#force HTTPS
	header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
}else{
    //adjust protocol
    $protocol = (SECURE==true ? 'https://' : 'http://'); // returns true
    
}
$config->virtual_path = $protocol . $_SERVER["HTTP_HOST"] . '/' . $sub_folder;

define('ADMIN_PATH', $config->virtual_path . 'admin/'); # Could change to sub folder
define('INCLUDE_PATH', $config->physical_path . 'includes/');


//CHANGE ITEMS BELOW TO MATCH YOUR SHORT TAGS
$config->title = THIS_PAGE;
$config->banner = 'Widgets';
$config->loadhead = '';//place items in <head> element

//default page values
$config->slogan = 'Whatever it is you do, we do it better.';
$config->pageHeader = 'The developer forgot to put a pageHeader!';
$config->subHeader = 'The developer forgot to put a subHeader!';
$config->sloganIcon = '';//will be replaced in contact.php by hero icons

switch(THIS_PAGE){
	
	case 'template.php':
		$config->title =  'My template page';
        $config->pageHeader = 'Put PageID here';
        $config->subHeader = 'Put more info about page here';
	break;
        
    case 'customer_list.php':
		$config->title =  'A list of customers';
        $config->pageHeader = 'Our customers';
        $config->subHeader = 'Don\'t sue us, because we\'re using celebrity photos!';
	break;    
        
    case 'db-test.php':
		$config->title =  'A database test page';
        $config->pageHeader = 'Database Test Page';
        $config->subHeader = 'Check this page to see if your db credentails are correct.';
	break;    
        
    case 'daily.php':
		$config->title =  'My Daily page';
        $config->pageHeader = 'Daily Coffee Specials';
        $config->subHeader = 'All our coffee is special!';
        //$config->sloganIcon = randomize($heros);
	break;    
	
	case 'contact.php':
		$config->title =  'My contact page';
        $config->pageHeader = 'Please contact us';
        $config->subHeader = 'We appreciate your feedback';
        //$config->sloganIcon = randomize($heros);
	break;
	
}

//creates theme virtual path for theme assets, JS, CSS, images
$config->theme_virtual = $config->virtual_path . 'themes/' . $config->theme . '/';

/*
    handles database and other errors
*/
function myerror($myFile, $myLine, $errorMsg)
{
    if(defined('DEBUG') && DEBUG)
    {
       echo "Error in file: <b>" . $myFile . "</b> on line: <b>" . $myLine . "</b><br />";
       echo "Error Message: <b>" . $errorMsg . "</b><br />";
       die();
    }else{
		echo "I'm sorry, we have encountered an error.  Would you like to buy some socks?";
		die();
    }
}

/*
 * adminWidget allows clients to get to admin page from anywhere
 * code will show/hide based on logged in status
*/
/*
 * adminWidget allows clients to get to admin page from anywhere
 * code will show/hide based on logged in status
*/
if(startSession() && isset($_SESSION['AdminID']))
{#add admin logged in info to sidebar or nav
    
    $config->adminWidget = '
        <a href="' . ADMIN_PATH . 'admin_dashboard.php">ADMIN</a> 
        <a href="' . ADMIN_PATH . 'admin_logout.php">LOGOUT</a>
    ';
}else{//show login (YOU MAY WANT TO SET TO EMPTY STRING FOR SECURITY)
    
    $config->adminWidget = '
        <a  href="' . ADMIN_PATH . 'admin_login.php">LOGIN</a>
    ';
}



?>