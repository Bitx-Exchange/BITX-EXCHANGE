<?phprequire_once("models/config.php");if(!isUserLoggedIn()){echo '<meta http-equiv="refresh" content="0; URL=access_denied.php">';die();}if(!isUserAdmin($id)){echo '<meta http-equiv="refresh" content="0; URL=access_denied.php">';die();}?><link rel="stylesheet" type="text/css" href="assets/css/support.css" /><br /><br /><br /><div id="width-keeper">	<section class="message-box left">		<b class="title-point">Server Load(main):</b></br>		<table id="page">			<?php 			$var_load = sys_getloadavg();						foreach($var_load as $key => $value) {				echo "<tr><td>".$key." : ".$value."</tr><td>";			}			?>		</table>	</section></div>	<br /><div id="width-keeper">	<aside class="message-box right">		<b class="title-point">MySQL Load:</b></br>		<table id="page">						<?php			$mysqlload = explode("  ", mysql_stat());				foreach ($mysqlload as $key => $value){					echo "<tr><td>".$key." : ".$value."<td></tr>";				}			?>					</table>	</aside></div>	<br /><div id="width-keeper">	<aside class="message-box right">		<b class="title-point">Coin Status:</b></br>		<p class="content-p">		<table id="page">			<?php				$result = mysql_query("SELECT * FROM `Wallets` ORDER BY (id) ASC");								while($row = mysql_fetch_array($result))				{				$id = $row["Id"];				$pw = $row["Wallet_Password"];				$usr = $row["Wallet_Username"];				$wallet = new Wallet($id);				$id_check = $loggedInUser->user_id;				$requestkey = md5( hash('sha512', $id_check.$id.$usr.$pw));				$info = $wallet->GetInfo($id,$pw,$usr,$requestkey,$id_check);				echo "<tr>";				echo "<td>" . $row['Acronymn'] . "</td>";				echo "<td>" . $row['Wallet_IP'] . "</td>";				echo "<td style='width: 300px !important;'>";				foreach($info as $key => $value) {					echo $key.' : '.$value.'<hr class="five">';				}				echo"</td>";				echo "</tr>";								}			?>		</table>		</p>			<br />	</aside></div>