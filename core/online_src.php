<?php
# [1.7.2]jquery.min.js
#$js['jquery'] = 'https://cdn.bootcss.com/jquery/1.7.2/jquery.min.js';
# [1.9]jquery.validate.min.js
#$js['jquery_validate'] = 'https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js';
$js_online = array(
    'https://www.jq22.com/jquery/jquery-3.3.1.js',
    'https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js',
    'https://www.jq22.com/jquery/bootstrap-4.2.1.js',
    'https://www.jq22.com/jquery/jquery-migrate-1.2.1.min.js',
    'https://cdn.staticfile.org/jquery.tablesorter/2.31.1/js/extras/jquery.tablesorter.pager.min.js',
);
$css_online = array(
    'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css',
);
// http://html5shim.googlecode.com/svn/trunk/html5.js
/*
$ch = curl_init('http://tool.huixiang360.com/zhanzhang/ipaddress.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$a  = curl_exec($ch);
preg_match('/\[(.*)\]/', $a, $ip);
echo '您现在的IP是: ' , $ip[1] , "\n";
*/