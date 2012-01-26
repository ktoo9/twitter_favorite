<?php
  date_default_timezone_set('Asia/Tokyo');

echo getReply($_GET["replyid"]).getCurrent($_GET["orgid"]);

// ---------- In Reply To Function ----------
function getReply($myID) {

  $re_myarray = json_decode(file_get_contents("http://api.twitter.com/1/statuses/show/".$myID.".json"."?count=1"));
  $myresult = "";
  $name = $re_myarray->user->screen_name."<br>";
  $text = $re_myarray->text."<br>";
  $date = dateConvert($re_myarray->created_at);
  if (strcmp($re_myarray->in_reply_to_status_id,"") != 0) {
    $myresult .= getReply($re_myarray->in_reply_to_status_id);
  }
  $myresult .= $name.$text.$date."<hr>";

  return $myresult;
}

// ---------- Current Text Function ----------
function getCurrent($orgID) {

  $re_myarray = json_decode(file_get_contents("http://api.twitter.com/1/statuses/show/".$orgID.".json"."?count=1"));
  $myresult = "";
  $name = $re_myarray->user->screen_name."<br>";
  $text = $re_myarray->text."<br>";
  $date = dateConvert($re_myarray->created_at);
  $myresult .= $name.$text.$date."<hr>";

  return $myresult;
}

// ---------- Date Convert Function ----------
function dateConvert($convertStr) {

  $diff = mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")) - strtotime($convertStr);
  $day = (int)($diff / 86400);
  $hour = (int)($diff / 3600);
  $min = (int)($diff / 60);
  $sec = (int)($diff);

  $myresult = "";
  if ($sec < 60) {
    $myresult = $sec."s ago";
  } else if ($min < 60) {
    $myresult = $min."m ago";
  } else if ($hour < 24){
    $myresult = $hour."h ago";
  } else if ($day >= 1) {
    $myresult = $day."d ago";
  }

  return date("Y-m-d H:i",strtotime($convertStr))." ".$myresult;
}

?>


