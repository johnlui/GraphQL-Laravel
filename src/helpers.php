<?php

if (!function_exists('cc')) {
  function cc($ha) {
    echo json_encode($ha, JSON_UNESCAPED_UNICODE);
    die;
  }
}