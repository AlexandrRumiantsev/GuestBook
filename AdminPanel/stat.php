<head>
    <title>Статистика</title>
    <? require_once  '..\MyFramework\OneCollection.php';?>
</head>
<br><br><br>
<div style="overflow: auto;height: 700px; padding-top: 10px; width: 800px">
<?
error_reporting(0);
$stat = new userInfo();
$stat = $stat ->userInfoView();
?>
</div>