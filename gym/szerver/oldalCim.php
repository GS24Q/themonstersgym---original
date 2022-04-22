<?php

function oldalCim(){

$protokol = "http://";


if (isset($_SERVER['HTTPS']) &&
    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
  $protokol = 'https://';
}
else {
  $protokol = 'http://';
}



$alapcim=$protokol.$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']."/";


return $alapcim;


}

?>