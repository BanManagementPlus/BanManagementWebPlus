<?php
/*  BanManagement � 2012, a web interface for the Bukkit plugin BanManager
    by James Mortemore of http://www.frostcast.net
	is licenced under a Creative Commons
	Attribution-NonCommercial-ShareAlike 2.0 UK: England & Wales.
	Permissions beyond the scope of this licence 
	may be available at http://creativecommons.org/licenses/by-nc-sa/2.0/uk/.
	Additional licence terms at https://raw.github.com/confuser/Ban-Management/master/banmanagement/licence.txt
*/

// Disable errors to prevent invalid JSON
error_reporting(0);
@ini_set('display_errors', 0); // Fallback incase error_reporting(0) fails

if(!isset($_SESSION['admin']) || (isset($_SESSION['admin']) && !$_SESSION['admin']))
	die('Hacking attempt');
else if(!isset($_GET['authid']) || (isset($_GET['authid']) && $_GET['authid'] != sha1($settings['password'])))
	die('Hacking attempt');
else if(!is_alphanumdash($_POST['banstable'])) 
	die('Hacking attempt');
else if(!is_alphanumdash($_POST['recordtable']))
	die('Hacking attempt');
else if(!is_alphanumdash($_POST['iptable']))
	die('Hacking attempt');
else if(!is_alphanumdash($_POST['iprecordtable']))
	die('Hacking attempt');
else if(!is_alphanumdash($_POST['mutestable']))
	die('Hacking attempt');
else if(!is_alphanumdash($_POST['mutesrecordtable']))
	die('Hacking attempt');
else if(!is_alphanumdash($_POST['kickstable']))
	die('Hacking attempt');
else if(!is_alphanumdash($_POST['warningstable']))
	die('Hacking attempt');

function tableExists($name) {
	if(!@mysql_query("SELECT * FROM $name"))
		return false;
	return true;
}

// Test the mysql connection
if(!mysql_connect($_POST['host'], $_POST['username'], $_POST['password']))
	$error = 'Unable to connect, check connection information is correct';
else if(!mysql_select_db($_POST['database']))
	$error = 'Unable to select database';
else if(!tableExists($_POST['banstable'])) 
	$error = 'Bans table not found';
else if(!tableExists($_POST['recordtable']))
	$error = 'Bans record table not found';
else if(!tableExists($_POST['iptable']))
	$error = 'IP table not found';
else if(!tableExists($_POST['iprecordtable']))
	$error = 'IP record table not found';
else if(!tableExists($_POST['mutestable']))
	$error = 'Mutes table not found';
else if(!tableExists($_POST['mutesrecordtable']))
	$error = 'Mutes record table not found';
else if(!tableExists($_POST['kickstable']))
	$error = 'Kicks table not found';
else if(!tableExists($_POST['warningstable']))
	$error = 'Warnings table not found';
else {
	// Success! Add it
	$servers = $settings['servers'];
	$servers[] = array(
		'name' => $_POST['servername'],
		'host' => $_POST['host'],
		'database' => $_POST['database'],
		'username' => $_POST['username'],
		'password' => $_POST['password'],
		'bansTable' => $_POST['banstable'],
		'recordTable' => $_POST['recordtable'],
		'ipTable' => $_POST['iptable'],
		'ipRecordTable' => $_POST['iprecordtable'],
		'mutesTable' => $_POST['mutestable'],
		'mutesRecordTable' => $_POST['mutesrecordtable'],
		'kicksTable' => $_POST['kickstable'],
		'warningsTable' => $_POST['warningstable']
	);

	$settings['servers'] = $servers;
	$servers = serialize($servers);
	$servers = "['servers'] = '".$servers;
	$contents = file_get_contents('settings.php');
	$contents = preg_replace("/\['servers'\] = '(.*?)/", $servers, $contents);
	file_put_contents('settings.php', $contents);
	$array['success'] = 'true';
}
if(isset($error))
	$array['error'] = $error;
else {
	$array['success'] = array('id' => count($settings['servers']) - 1, 'serverName' => $_POST['servername']);
}
echo json_encode($array);
?>