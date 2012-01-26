<?php
  date_default_timezone_set('Asia/Tokyo');

// ---------- Search User ----------
function getSearchTL($searchStr,$floatBool) {

  if (strcmp($searchStr,"") == 0) return;

  $array = array();
  for ($i = 1; $i <= 1; $i++) {
    $url = "http://api.twitter.com/1/statuses/user_timeline/".$searchStr.".json"."?include_rts=true&page=".$i;
    $myarray = json_decode(file_get_contents($url));
    $array = array_merge($array, $myarray);
  }

  foreach($array as $myresult) {
    $text = addLink($myresult->text)."<br>";
    if (strcmp($myresult->in_reply_to_status_id,"") != 0) {
      $ID = $myresult->in_reply_to_status_id;
      $orgID = $myresult->id;
      $date = "<p>".dateConvert($myresult->created_at)." "."<a href=\"#\" class=\"dialog_link\" replyid=".$ID." orgid=".$orgID.">▲</a>"."</p>";
    } else {
      $date = "<p>".dateConvert($myresult->created_at)."</p>";
    }
    $result .= $text.$date."<hr>";
  }
createHTML($searchStr, $result, $floatBool);
}

// ---------- Link Function ----------
function addLink($mystring) {
  $myresult = preg_replace("/(http:\/\/[\w\d\/%#$&?()~_.=+-]+)/i", "<a href=\""."$1"."\" target=\"_blank\">"."$1"."</a>", $mystring);
  $myresult = preg_replace("/@([a-z_0-9]+)/i", "<a href=\"http://twitter.com/"."$1"."\" target=\"_blank\">@"."$1"."</a>", $myresult);
  return $myresult;
}

function addUserLink($mystring) {
  return "<a href=\"http://twitter.com/".$mystring."\" target=\"_blank\" style=\"text-decoration:none;\">".$mystring."</a>";
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

// ---------- Create HTML Function ----------
function createHTML($mytitle, $mytext, $myfloatBool) {

$float = "float:left;";
if ($myfloatBool == 1) $float = null;
//$userURL = "http://twitter.com/".$mystring;

print<<<EOF
<div class="tlBox" id=$mytitle style=$float>
<div class="title"><a href="http://twitter.com/{$mytitle}" target="_blank" style="text-decoration:none;"><font color="#ffffff">$mytitle</font></a></div>
<div class="textbox">$mytext</div>
</div>
EOF;
}

?>
