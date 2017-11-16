<?php

function get_unity_path(){
  
  switch (PHP_OS){
    case "Darwin":
      return config("unity.mac.unity_path");
    case "WINNT":
      return config("unity.windows.unity_path");
    default :
      return config("unity.windows.unity_path");
  }
  
}

function process_time(){
  return microtime(true)-$_SERVER["REQUEST_TIME_FLOAT"];
}

function is_running(){
    
    
}

function dice($num=6,$time=1){
    return mt_rand(1,$num)+($time<0?dice($num,$time-1):0);
}
