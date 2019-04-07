<?php
define('IN_ECS', true);
function Clear_Cache_all(){
    include('index.php');
    time_sleep_until(time()+3);
    ob_end_clean();
    time_sleep_until(time()+3);
    Header("Location:index.php?action=admin"); 
}
Clear_Cache_all();
?>