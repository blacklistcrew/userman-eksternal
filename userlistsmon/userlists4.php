<?php session_start(); ?>
<?php
if(!isset($_SESSION['usermikhmon'])){
	header("Location:login.php");
}
?>
<?php
require('../api.php');
include('../config.php');
$API = new RouterosAPI();
$API->debug = false;
if ($API->connect( $iphost, $userhost, $passwdhost )) {
	$API->write('/ip/hotspot/user/print', false);
	$API->write('?=profile='.$profile4.'');
	$ARRAY = $API->read();

	$API->write('/ip/hotspot/user/print', false);
	$API->write('=count-only=', false);
	$API->write('?=profile='.$profile4.'');
	$ARRAY2 = $API->read();

	$API->disconnect();
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Mikrotik Hotspot Monitor</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="pragma" content="no-cache" />
		<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;"/>
		<link rel="icon" href="favicon.ico" />
		<link rel="stylesheet" href="../css/style.css" media="screen">
		<script>
			function Reload() {
				location.reload();
			}
			function goBack() {
				window.history.back();
			}
		</script>
	</head>
	<body>
	<div class="main">
	<table class="tnav">
		<tr>
			<td style="text-align: center;" colspan=2>Mikrotik Hotspot Monitor</td>
		</tr>
		<tr>
			<td>Voucher <?php print_r($vname4);?> Aktif  : <?php print_r($ARRAY2);?></td>
			<td>
				<button class="material-icons" onclick="Reload()" title="Reload">autorenew</button>
				<button class="material-icons" onclick="location.href='../';" title="Dashboard">dashboard</button>
				<button class="material-icons" onclick="goBack()" title="Back">arrow_back</button>
			</td>
		</tr>
	</table>
	<br>
		<div style="overflow-x:auto;">
			<table class="tprint" >
				<tr>
					<th >User</th>
					<th >Profile</th>
					<th >Uptime</th>
				</tr>
				<tr><td>
				<?php
					$TotalReg = count($ARRAY);

					for ($i=0; $i<$TotalReg; $i++){$regtable = $ARRAY[$i];echo "" . $regtable['name'] . "<br />";}echo "</td><td>";
					for ($i=0; $i<$TotalReg; $i++){$regtable = $ARRAY[$i];echo "" . $regtable['profile'] . "<br />";}echo "</td><td>";
					for ($i=0; $i<$TotalReg; $i++){$regtable = $ARRAY[$i];echo "" . $regtable['uptime'] . "<br />";}echo "</td>";

				?>
				</tr>
			</table
		</div>
	</div>
	</body>
</html>
