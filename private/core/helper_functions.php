<?php

function get_var($key, $default = "")
{

  if (isset($_POST[$key])) {
    return $_POST[$key];
  }
  return $default;
}


function get_select($key, $value)
{
  if (isset($_POST[$key])) {
    if ($_POST[$key] == $value) {
      return " selected ";
    }
  }
  return "";
}

function esc($var)
{
  return htmlspecialchars($var);
}

function random_string($length)
{
  $array = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'o', 'p', 'z', 'x', 'c', 'v', 'b', 'n', 'm', 'A', 'B', 'C', 'D', 'F', 'G', 'H', 'J', 'K', 'L', 'Q', 'W', 'E', 'R', 'T', 'Y', 'U', 'I', 'O', 'P', 'Z', 'X', 'C', 'V', 'B', 'N', 'M');
  $text = "";
  for ($x = 0; $x < $length; $x++) {
    $random = rand(0, 61);
    $text .= $array[$random];
  }
  return $text;
}

function get_date($date)
{


  return date("jS F, Y", strtotime($date));
}


function get_image($row)
{
  $image = $row->image;
  if (!file_exists($image)) {
    $image = ASSETS . "/user_female.png";
    if ($row->gender == 'male') {
      $image = ASSETS . '/user_male.png';
    }
  }
  return $image;
}

function views_path($view)
{

  if (file_exists("../private/views/" . $view . ".inc.php")) {
    return "../private/views/" . $view . ".inc.php";
  } else {
    return "../private/views/404.inc.php";
  }
}
