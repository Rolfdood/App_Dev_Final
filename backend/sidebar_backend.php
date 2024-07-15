<?php

function print_UID($uid) {
  $user_id = strval($uid);
  
  while(strlen($user_id) < 11) {
    $user_id = "0".$user_id;
  }
  
  echo $user_id;
}
?>