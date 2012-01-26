<html>
<head>
<link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="stylesheet" href="css/jquery-ui-1.8.16.custom.css" type="text/css">
<?php require('php/GetTL.php'); ?>
<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="js/jquery_mydialog.js"></script>
</head>

<body>

<?php getSearchTL("earthquake_jp",0); ?>
<?php getSearchTL("eqbot",1); ?>
<?php getSearchTL("p2pquake",0); ?>
<?php getSearchTL("eew_jp",0); ?>

<div id="dialog" title="Basic dialog"></div> 
</body>
</html>