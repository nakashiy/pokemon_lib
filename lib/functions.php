<?php
function h($str, $charset = 'UTF-8')
{
    return htmlspecialchars($str, ENT_QUOTES, $charset);
}
function console($data){
  echo '<script>';
  echo 'console.log('.json_encode($data).')';
  echo '</script>';
}