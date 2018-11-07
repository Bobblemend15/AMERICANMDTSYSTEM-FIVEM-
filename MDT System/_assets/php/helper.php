<?php

    /*
    *   @author Owen Morgan (OM Solutions)
    *   @copyright OM Solutions 2018
    */
?>
<?php
	require('connection.php');

	$streets = ['Abattoir Avenue','Abe Milton Parkway','Ace Jones Drive','Adam\'s Apple Boulevard','Aguja Street','Alta Place','Alta Street','Amarillo Vista','Amarillo Way','Americano Way','Atlee Street','Autopia Parkway','Banham Canyon Drive','Barbareno Road','Bay City Avenue','Bay City Incline','Baytree Canyon Road','Boulevard Del Perro','Bridge Street','Brouge Avenue','Buccaneer Way','Buen Vino Road','Caesars Place','Calais Avenue','Capital Boulevard','Carcer Way','Carson Avenue','Chum Street','Chupacabra Street ','Clinton Avenue ','Cockingend Drive ','Conquistador Street ','Cortes Street ','Cougar Avenue ','Covenant Avenue ','Cox Way ','Crusade Road ','Davis Avenue ','Decker Street ','Didion Drive ','Dorset Drive ','Dorset Place ','Dry Dock Street ','Dunstable Drive ','Dunstable Lane ','Dutch London Street ','Eastbourne Way ','East Galileo Avenue ','East Mirror Drive ','Eclipse Boulevard ','Edwood Way ','Elgin Avenue ','El Burro Boulevard ','El Rancho Boulevard ','Equality Way ','Exceptionalists Way ','Fantastic Place ','Fenwell Place ','Forum Drive ','Fudge Lane ','Galileo Road ','Gentry Lane ','Ginger Street ','Glory Way ','Goma Street ','Greenwich Parkway ','Greenwich Place ','Greenwich Way ','Grove Street ','Hanger Way ','Hangman Avenue ','Hardy Way ','Hawick Avenue ','Heritage Way ','Hillcrest Avenue ','Hillcrest Ridge Access Road ','Imagination Court ','Industry Passage ','Ineseno Road ','Integrity Way ','Invention Court ','Innocence Boulevard ','Jamestown Street ','Kimble Hill Drive ','Kortz Drive ','Labor Place ','Laguna Place ','Lake Vinewood Drive ','Las Lagunas Boulevard ','Liberty Street ','Lindsay Circus ','Little Bighorn Avenue ','Low Power Street ','Macdonald Street ','Mad Wayne Thunder Drive ','Magellan Avenue ','Marathon Avenue ','Marlowe Drive ','Melanoma Street ','Meteor Street ','Milton Road ','Mirror Park Boulevard ','Mirror Place ','Morningwood Boulevard ','Mount Haan Drive ','Mount Haan Road ','Mount Vinewood Drive ','Movie Star Way ','Mutiny Road ','New Empire Way ','Nikola Avenue ','Nikola Place ','Normandy Drive ','North Archer Avenue ','North Conker Avenue ','North Sheldon Avenue ','North Rockford Drive ','Occupation Avenue ','Orchardville Avenue ','Palomino Avenue ','Peaceful Street ','Perth Street ','Picture Perfect Drive ','Plaice Place ','Playa Vista ','Popular Street ','Portola Drive ','Power Street ','Prosperity Street ','Prosperity Street Promenade ','Red Desert Avenue ','Richman Street ','Rockford Drive ','Roy Lowenstein Boulevard ','Rub Street ','Sam Austin Drive ','San Andreas Avenue ','Sandcastle Way ','San Vitus Boulevard ','Senora Road ','Shank Street ','Signal Street ','Sinner Street ','Sinners Passage ','South Arsenal Street ','South Boulevard Del Perro ','South Mo Milton Drive ','South Rockford Drive ','South Shambles Street ','Spanish Avenue ','Steele Way ','Strangeways Drive ','Strawberry Avenue ','Supply Street ','Sustancia Road ','Swiss Street ','Tackle Street ','Tangerine Street ','Tongva Drive ','Tower Way ','Tug Street ','Utopia Gardens ','Vespucci Boulevard ','Vinewood Boulevard ','Vinewood Park Drive ','Vitus Street ','Voodoo Place ','West Eclipse Boulevard ','West Galileo Avenue ','West Mirror Drive ','Whispymound Drive ','Wild Oats Drive ','York Street ','Zancudo Barranca'];

	function LogUserIn( $collar,$password,$sessionid )
	{
		global $con;

		$q = $con->query("SELECT userid,collar,password,last_ip FROM mdt_users WHERE collar = '{$collar}'");
		$a = mysqli_fetch_assoc($q);

		if($q->num_rows > 0){
			if(password_verify($password, $a['password'])){
				$sql = $con->query("INSERT INTO mdt_sessions VALUES(NULL, '{$sessionid}', '{$a['userid']}', '{$_SERVER['REMOTE_ADDR']}', " . time() .")");
				$sql2 = $con->query("UPDATE mdt_users SET last_ip = '{$_SERVER['REMOTE_ADDR']}' WHERE userid = '{$a['userid']}'");
				$q = $con->query("INSERT INTO logs VALUES (NULL, '{$a['userid']}', 'Has created a new session " . $_SERVER['REMOTE_ADDR'] . ".', 'Session', " . time() .", 1)");

				if($_SERVER['REMOTE_ADDR'] != $a['last_ip']){
					$con->query("INSERT INTO logs VALUES (NULL, '{$a['userid']}', 'Has logged in from another IP, possible account breach. Old IP: " . $a['last_ip'] . " | New IP: " . $_SERVER['REMOTE_ADDR'] . ".', 'Security', " . time() .", 1)");
				}
				return true;
			}else{
				$q = $con->query("INSERT INTO logs VALUES (NULL, '{$a['userid']}', 'Failed to sign in from the IP " . $_SERVER['REMOTE_ADDR'] . ".', 'Security', " . time() .", 1)");
				return false;
			}
		}else{
			return false;
		}
	}

	function getUsers()
	{
		global $con;

		$q = $con->query("SELECT * FROM mdt_users");
		$users = array();

		while($a = mysqli_fetch_assoc($q)){
			//if(haveGeneralPerm($a['userid'], 1024) == false){
				$users[] = $a;
			//}
		}

		return $users;
	}

	function getUserInfo($userid)
	{
		global $con;

		$q = $con->query("SELECT * FROM mdt_users WHERE userid = '{$userid}'");
		$a = mysqli_fetch_assoc($q);

		$array = array(
			'userid' => $a['userid'],
			'first_name' => $a['first_name'],
			'surname' => $a['surname'],
			'email' => $a['email'],
			'steamid' => $a['steamid'],
			'password' => $a['password'],
			'email'=> $a['email'],
			'collar' => $a['collar'],
			'groups' => $a['groups'],
			'last_ip' => $a['last_ip'],
			'joindate' => $a['joindate']
		);

		return $array;

	}

	function getGroupInfo($groupid)
	{
		global $con;

		$q = $con->query("SELECT * FROM usergroups WHERE id = '{$groupid}'");
		$a = mysqli_fetch_assoc($q);

		return $a;
	}

	function updateVehicle($vehicleid,$name,$vrm,$status,$owner,$insurer,$markers)
	{
		global $con;

		$q = $con->query("UPDATE vehicles SET vehicle = '{$name}', vrm = '{$vrm}', status = '{$status}', owner = '{$owner}', insurer = '{$insurer}', markers = '{$markers}' WHERE vehicleid = '{$vehicleid}'");

		return;
	}

	function civHasMarker($civid,$marker)
	{
		global $con;

		$query = $con->query("SELECT * FROM civilians WHERE civid = '{$civid}'");
		$array = mysqli_fetch_assoc($query);

		$allowed = explode(',',$array['markers']);

		foreach($allowed as $check){
			if ($check == $marker){
				return true;
			}
		}

		return false;
	}

	function getMarkers()
	{
		global $con;

		$q = $con->query("SELECT * FROM markers");
		$markers = array();
		
		while($a = mysqli_fetch_assoc($q)){
			$markers[] = $a;
		}

		return $markers;
	}

	function destroySession($sessionid)
	{
		global $con;

		$q = $con->query("DELETE FROM mdt_sessions WHERE session_id = '{$sessionid}'");

		return;
	}

	function updateCiv($civid,$name,$dob,$address)
	{
		global $con;

		$q = $con->query("UPDATE civilians SET name = '{$name}', dob = '{$dob}', address = '{$address}' WHERE civid = '{$civid}'");

		return;
	}

	function createCiv($admin,$name,$dob,$address)
	{
		global $con;

		$q = $con->query("INSERT INTO civilians VALUES(NULL,'{$name}','{$dob}','{$address}','')");

		newLogEntry($admin,"Has created the civilian " . $name,"Civilian Management");

		return;
	}

	function createCall($admin,$type,$location,$civilian,$description)
	{
		global $con;

		$date = time();

		$q = $con->query("INSERT INTO calls VALUES(NULL,'{$type}','{$location}','{$description}','Not Set','Not Set','Not Set','{$civilian}','1','{$date}')");

		$newCall = mysqli_fetch_assoc($con->query("SELECT * FROM calls WHERE `description` = '{$description}' AND `location` = '{$location}' AND `dateline` = '{$date}'"));
		newLogEntry($admin,"Has created the call " . $newCall['callid'] . ".","Calls");

		return;
	}

	function searchCivs($name,$dob)
	{
		global $con;
		global $streets;

		$q = $con->query("SELECT * FROM civilians WHERE name = '{$name}' AND dob = '{$dob}'");

		if($q->num_rows > 0){
			$a = mysqli_fetch_assoc($q);

			return $a['civid'];
		}else{
			$random_street_number = rand(0,172);
			$random_house_number = rand(0,100);
			$address = $random_house_number . ' ' . $streets[$random_street_number] . ", Birmingham, West Midlands";
			$q2 = $con->query("INSERT INTO civilians VALUES(NULL,'{$name}','{$dob}','{$address}','')");
			$q = $con->query("SELECT * FROM civilians WHERE name = '{$name}' AND dob = '{$dob}'");
			$a = mysqli_fetch_assoc($q);
			return $a['civid'];
		}
	}

	function searchVehicle($vrm)
	{
		global $con;

		$q = $con->query("SELECT * FROM vehicles WHERE vrm = '{$vrm}'");

		if($q->num_rows > 0){
			$a = mysqli_fetch_assoc($q);

			return $a['vehicleid'];
		}else{
			$insurance_number = "QQ" . mt_rand(100000, 999999) . chr(rand(65,90));
			$q2 = $con->query("INSERT INTO vehicles VALUES(NULL,'Unknown','{$vrm}','','Insured','','{$insurance_number}','','')");
			$q = $con->query("SELECT * FROM vehicles WHERE vrm = '{$vrm}'");
			$a = mysqli_fetch_assoc($q);
			return $a['vehicleid'];
		}
	}

	function getVehiclesForCiv($civid)
	{
		global $con;

		$q = $con->query("SELECT * FROM vehicles WHERE owner = '{$civid}'");
		$vehicles = array();

		while($a = mysqli_fetch_assoc($q)){
			$vehicles[] = $a;
		}

		return $vehicles;
	}

	function getVehicleInfo($vehicleid)
	{
		global $con;

		$q = $con->query("SELECT * FROM vehicles WHERE vehicleid = '{$vehicleid}'");
		$a = mysqli_fetch_assoc($q);

		return $a;
	}

	function getCivInfo($civid)
	{
		global $con;

		$q = $con->query("SELECT * FROM civilians WHERE civid = '{$civid}'");
		$a = mysqli_fetch_assoc($q);

		return $a;
	}

	function createVehicle($admin,$type,$vrm,$owner,$status,$insurer,$markers)
	{
		global $con;

		$q = $con->query("SELECT * FROM vehicles WHERE vrm = '{$vrm}'");
		$insurance_number = "QQ" . mt_rand(100000, 999999) . chr(rand(65,90));

		if($q->num_rows == 0){
			$formatted_vrm = substr($vrm,0,8);
			$q = $con->query("INSERT INTO vehicles VALUES(NULL,'{$type}','{$formatted_vrm}','{$owner}','{$status}','{$insurer}','{$insurance_number}','','{$markers}')");

			newLogEntry($admin,"Has created the vehicle with the VRM of " . $vrm,"Civilain Management");
		}
	}

	function isAllowedToDriver($vehicleid,$civid)
	{
		global $con;

		$allowed = getAllowedDriversForVehicle($vehicleid);

		foreach($allowed as $check){
			if ($check['civid'] == $civid){
				return true;
			}
		}

		return false;
	}

	function getAllowedDriversForVehicle($vehicleid)
	{
		global $con;

		$q = $con->query("SELECT * FROM vehicles WHERE vehicleid = '{$vehicleid}'");
		$a = mysqli_fetch_assoc($q);
		$allowed = array();

		$drivers = explode(',',$a['registered_drivers']);

		foreach($drivers as $driver){
			$q2 = $con->query("SELECT * FROM civilians WHERE civid = '{$driver}'");
			$a2 = mysqli_fetch_assoc($q2);
			$allowed[] = $a2;
		}

		return $allowed;
	}

	function getVehicleOwner($ownerid)
	{
		global $con;

		$q = $con->query("SELECT * FROM civilians WHERE civid = '{$ownerid}'");
		$a = mysqli_fetch_assoc($q);

		return $a;
	}

	function getVehicles()
	{
		global $con;

		$q = $con->query("SELECT * FROM vehicles");
		$vehicles = array();

		while($a = mysqli_fetch_assoc($q)){
			$vehicles[] = $a;
		}

		return $vehicles;
	}

	function getCivs()
	{
		global $con;

		$q = $con->query("SELECT * FROM civilians");
		$civs = array();

		while($a = mysqli_fetch_assoc($q)){
			$civs[] = $a;
		}

		return $civs;
	}

	function memberOfGroup($userid, $groupid)
	{
		global $con;

		$array = getUserInfo($userid);

		$usergroups = explode(',', $array['groups']);

        return in_array($groupid, $usergroups);
	}

	function groupHasPerm($groupid,$perm)
	{
		global $con;

		$allowed = false;

		if (!is_int($perm)) {
            $perm = intval($perm);
        }

        $grpq = $con->query("SELECT * FROM usergroups WHERE id = '{$groupid}'");
        $grp = mysqli_fetch_assoc($grpq);

        if (count($grp)) {
            if ($grp['perms'] & $perm) {
               	return true;
            }
        }

        return $allowed;
	}

	function haveGeneralPerm($userid, $perm)
	{
		global $con;

		$allowed = false;

        if (!is_int($perm)) {
            $perm = intval($perm);
        }

        $user = getUserInfo($userid);

        if (count($user)) {
            $groups = explode(",", $user['groups']);

            foreach ($groups as $group) {
                $grpq = $con->query("SELECT * FROM usergroups WHERE id = '{$group}'");
                $grp = mysqli_fetch_assoc($grpq);

                if ($grpq->num_rows > 0) {
                    if ($grp['perms'] & $perm) {
                    	return true;
                    }
                }
            }
        }

        return $allowed;
	}

	function getCallerById($id)
	{
		global $con;

		$q = $con->query("SELECT * FROM civilians WHERE civid = '{$id}'");

		if($q->num_rows > 0){
			$a = mysqli_fetch_assoc($q);
			return $a;
		}else{
			return false;
		}
	}

	function getUnitInfo($unitid)
	{
		global $con;

		$q = $con->query("SELECT * FROM units WHERE unitid = '{$unitid}'");
		$a = mysqli_fetch_assoc($q);

		return $a;
	}

	function getUnitForUser($collar)
	{
		global $con;

		$q = $con->query("SELECT * FROM units WHERE collar = '{$collar}'");

		if($q->num_rows > 0){
			$a = mysqli_fetch_assoc($q);
			return $a;
		}else{
			return false;
		}
	}

	function getUnitsForCall($callid)
	{
		global $con;

		$unitsq = $con->query("SELECT * FROM units WHERE callid = '{$callid}'");
		$callUnits = array();

		while ($unit = mysqli_fetch_assoc($unitsq)) {
			$result = getUnitInfo($unit['unitid']);

			$callUnits[] = $result;
		}

		return $callUnits;
	}

	function getClosedCalls()
	{
		global $con;

		$calls = array();

		$q = $con->query("SELECT * FROM calls WHERE status = '4' ORDER BY callid DESC");

		while($call = mysqli_fetch_assoc($q)){
			$array = array(
				'callid' => $call['callid'],
				'type' => $call['type'],
				'location' => $call['location'],
				'description' => $call['description'],
				'police_grade' => $call['police_grade'],
				'rmu_grade' => $call['rmu_grade'],
				'channel' => $call['channel'],
				'caller' => getCallerById($call['caller']),
				'status' => $call['status'],
				'units' => getUnitsForCall($call['callid']),
				'dateline' => strtoupper(date('dMY',$call['dateline'])),
				'created' => date('jS F Y \a\t G\:i', $call['dateline'])
			);

			$calls[] = $array;
		}

		return $calls;
	}

	function getActiveCalls($order)
	{
		global $con;

		$calls = array();

		if($order == 'ASC'){
			$q = $con->query("SELECT * FROM calls WHERE status != '4' ORDER BY callid ASC");
		}else{
			$q = $con->query("SELECT * FROM calls WHERE status != '4' ORDER BY callid DESC");
		}

		while($call = mysqli_fetch_assoc($q)){
			$array = array(
				'callid' => $call['callid'],
				'type' => $call['type'],
				'location' => $call['location'],
				'description' => $call['description'],
				'police_grade' => $call['police_grade'],
				'rmu_grade' => $call['rmu_grade'],
				'channel' => $call['channel'],
				'caller' => getCallerById($call['caller']),
				'status' => $call['status'],
				'units' => getUnitsForCall($call['callid']),
				'dateline' => strtoupper(date('dMY',$call['dateline'])),
				'created' => date('jS F Y \a\t G\:i', $call['dateline'])
			);

			$calls[] = $array;
		}

		return $calls;
	}

	function getCallInfo($callid)
	{
		global $con;

		$q = $con->query("SELECT * FROM calls WHERE callid = '{$callid}'");
		$call = mysqli_fetch_assoc($q);

		$array = array(
			'callid' => $call['callid'],
			'type' => $call['type'],
			'location' => $call['location'],
			'description' => $call['description'],
			'rmu_grade' => $call['rmu_grade'],
			'police_grade' => $call['police_grade'],
			'channel' => $call['channel'],
			'caller' => getCallerById($call['caller']),
			'status' => $call['status'],
			'units' => getUnitsForCall($call['callid']),
			'dateline' => strtoupper(date('dMY',$call['dateline'])),
			'created' => date('jS F Y \a\t G\:i', $call['dateline'])
		);

		return $array;
	}

	function updateCallStatus($callid, $status)
	{
		global $con;

		if($status == 4){
			$units = getUnitsForCall($callid);

			foreach($units as $unit){
				clearUnit($unit['unitid']);
			}
		}

		$q = $con->query("UPDATE calls SET status = '{$status}' WHERE callid = '{$callid}'");

		return;
	}

	function getAvailableUnits()
	{
		global $con;

		$units = array();
		$q = $con->query("SELECT * FROM units WHERE collar != ''");

		while($a = mysqli_fetch_assoc($q)){
			$units[] = $a;
		}

		return $units;
	}

	function getRemarks($callid)
	{
		global $con;

		$remarks = array();
		$q = $con->query("SELECT * FROM remarks WHERE callid = '{$callid}'");

		while($array = mysqli_fetch_assoc($q)){
			$array = array(
				'remarkid' => $array['remarkid'],
				'content' => $array['content'],
				'unit' => $array['unit'],
				'dateline' => $array['dateline']
			);

			$remarks[] = $array;
		}

		return $remarks;
	}

	function updateUnitStatus($unit, $status)
	{
		global $con;

		$q = $con->query("UPDATE units SET status = '{$status}' WHERE unitid = '{$unit}'");

		$unit = getUnitInfo($unit);
		$message = $unit['unit'] . ' has updated their status to ' . $status . ' on log ' . $unit['callid'];
		newLogEntry('SYSTEM', $message, 'Patrol');

		return;
	}

	function newLogEntry($user, $content, $cat)
	{
		global $con;

		$date = time();

		$q = $con->query("INSERT INTO logs VALUES (NULL, '{$user}', '{$content}', '{$cat}', '{$date}', 1)");

		return;
	}

	function getLogs($type)
	{
		global $con;

		$q = $con->query("SELECT * FROM logs WHERE category = '{$type}' AND visible = 1 ORDER BY dateline DESC LIMIT 7");
		$logs = array();

		while($array = mysqli_fetch_assoc($q)){
			$logs[] = $array;
		}

		return $logs;
	}

	function getAdminLogs()
	{
		global $con;

		$q = $con->query("SELECT * FROM logs WHERE (category = 'Admin' OR category = 'Security' OR category = 'Session' OR category = 'Civilian Management' OR category = 'Calls') AND visible = 1 ORDER BY dateline DESC");
		$logs = array();

		while($array = mysqli_fetch_assoc($q)){
			$logs[] = $array;
		}

		return $logs;
	}

	function getUnits($cat)
	{
		global $con;

		$q = $con->query("SELECT * FROM units WHERE cat = '{$cat}' AND collar = ''");
		$units = array();

		while($a = mysqli_fetch_assoc($q)){
			$units[] = $a;
		}

		return $units;
	}

	function signOn($collar, $unit)
	{
		global $con;

		$userinfo = mysqli_fetch_assoc($con->query("SELECT * FROM mdt_users WHERE collar = '{$collar}'"));

		$q = $con->query("INSERT INTO units VALUES(NULL,'{$unit}',0,2,'{$collar}','{$userinfo['steamid']}','')");

		return;
	}

	function attachUnitToCall($callid, $unitid)
	{
		global $con;

		$q = $con->query("UPDATE units SET callid = '{$callid}', status = '5' WHERE unitid = '{$unitid}'");

		$uq = $con->query("SELECT * FROM units WHERE unitid = '{$unitid}'");
		$ua = mysqli_fetch_assoc($uq);

		$cq = $con->query("SELECT * FROM calls WHERE callid = '{$callid}'");
		$ca = mysqli_fetch_assoc($cq);

		sendMessage(strtoupper($ua['unit']), 'CONTROL', 'You have been attached to Log ' . $callid .', it is marked as a ' . $ca['police_grade'] . ' / ' . $ca['rmu_grade'] . ' call.');

		$message  = strtoupper($ua['unit']) . ' has been assigned to log ' . $callid;
		newLogEntry('SYSTEM', $message, 'Patrol');

		return;
	}

	function signUnitOff($unitid)
	{
		global $con;

		$q = $con->query("DELETE FROM units WHERE unitid = '{$unitid}'");

		return;
	}

	function clearUnit($unitid)
	{
		global $con;

		$unit = getUnitInfo($unitid);

		$q = $con->query("UPDATE units SET status = 2, callid = 0 WHERE unitid = '{$unitid}'");

		$message = $unit['unit'] . ' has been cleared from log ' . $unit['callid'];
		newLogEntry('SYSTEM', $message, 'Patrol');

		return;
	}

	function createPanicButton($unitid)
	{
		global $con;

		$unit = getUnitInfo($unitid);
		$date = time();

		$q = $con->query("INSERT INTO calls VALUES(NULL, 'Panic Button', 'Das {$unit['collar']}', 'Panic button activation by {$unit['unit']}', 'Grade 1', 'CAT 1', 'Not Set', '0', '3', '{$date}')");

		$newq = $con->query("SELECT * FROM calls WHERE type = 'Panic Button' AND description = 'Panic button activation by {$unit['unit']}' AND status != 4 ORDER BY callid DESC LIMIT 1");

		$a = mysqli_fetch_assoc($newq);

		$q3 = $con->query("UPDATE units SET callid = '{$a['callid']}', status = '6' WHERE unitid = '{$unitid}'");

		$availableUnits = getAvailableUnits();

		foreach($availableUnits as $unit){
			if($unit['callid'] == 0){
				attachUnitToCall($a['callid'], $unit['unitid']);
			}
		}

	}

	function sendGlobalMessage($message)
	{
		global $con;

		$units = getAvailableUnits();

		foreach($units as $unit){
			sendMessage(strtoupper($unit['unit']),'CONTROL',$message);
		}

		newLogEntry('SYSTEM', 'The tactical advisor has sent a global message with the message ' . $message, 'Patrol');

		return;
	}

	function sendMessage($recive, $post, $message)
	{
		global $con;

		$date = time();

		$q = $con->query("INSERT INTO messages VALUES (NULL, '{$recive}', '{$post}', '{$message}', '{$date}', '1')");

		return;
	}

	function newRemark($unit, $content, $callid)
	{
		global $con;

		$date = time();

		$q = $con->query("INSERT INTO remarks VALUES (NULL, '{$unit}', '{$content}', '{$date}', '{$callid}')");

		return;
	}

	function updateCall($callid, $police_grade, $rmu_grade, $inc)
	{
		global $con;

		$q = $con->query("UPDATE calls SET channel = '{$inc}', police_grade = '{$police_grade}', rmu_grade = '{$rmu_grade}' WHERE callid = '{$callid}'");

		return;
	}

	function getRecentMessages($unit)
	{
		global $con;

		$messages = array();
		$q = $con->query("SELECT * FROM messages WHERE (recive = '{$unit}' OR post = '{$unit}') AND visible = 1 ORDER by messageid DESC LIMIT 7");

		while($a = mysqli_fetch_assoc($q)){
			$messages[] = $a;
		}

		return $messages;
	}

	function getInbox($userid)
	{
		global $con;

		$messages = array();
		$q = $con->query("SELECT * FROM messages WHERE recive = '{$userid}' ORDER by messageid DESC LIMIT 5");

		while($a = mysqli_fetch_assoc($q)){
			$messages[] = $a;
		}

		return $messages;
	}

	function getmdt_users()
	{
		global $con;

		$q = $con->query("SELECT * FROM mdt_users");
		$mdt_users = array();

		while($a = mysqli_fetch_assoc($q)){
				$mdt_users[] = $a;
		}

		return $mdt_users;
	}

	function getmdt_usersGroups($userid)
	{
		global $con;

		$user = getUserInfo($userid);

		$groups = explode(',',$user['groups']);
		$mdt_usersGroups = array();

		foreach($groups as $group){
			$q = $con->query("SELECT * FROM usergroups WHERE id = '{$group}'");
			$a = mysqli_fetch_assoc($q);

			$mdt_usersGroups[] = $a;
		}

		return $mdt_usersGroups;
	}

	function deleteCiv($admin,$civid)
	{
		global $con;

		$civInfo = getCivInfo($civid);

		$q = $con->query("DELETE FROM civilians WHERE civid = '{$civid}'");

		newLogEntry($admin,'Has deleted the Civilian ' . $civInfo['name'],'Civilian Management');

		return;
	}

	function deleteVehicle($admin,$vehicleid)
	{
		global $con;

		$vehicleInfo = getVehicleInfo($vehicleid);

		$q = $con->query("DELETE FROM vehicles WHERE vehicleid = '{$vehicleid}'");

		newLogEntry($admin,'Has deleted the Vehicle ' . $vehicleInfo['vrm'],'Civilian Management');

		return;
	}

	function getUserGroups()
	{
		global $con;

		$groups = array();

		$q = $con->query("SELECT * FROM usergroups");

		while($a = mysqli_fetch_assoc($q)){
			$groups[] = $a;
		}

		return $groups;
	}

	function updateUser($admin,$userid,$first_name,$surname,$steamid,$email,$collar,$password)
	{
		global $con;

		$user = getUserInfo($userid);

		if($password == ''){
			$encrypted_password = $user['password'];
		}else{
			$encrypted_password = password_hash($password, PASSWORD_DEFAULT);
			newLogEntry($admin, 'Has changed the password for user ' . $first_name . ' ' . $surname, 'Admin');
		}

		$q = $con->query("UPDATE mdt_users SET first_name = '{$first_name}', steamid = '{$steamid}', surname = '{$surname}', email = '{$email}', collar = '{$collar}', password = '{$encrypted_password}' WHERE userid = '{$userid}'");

		newLogEntry($admin, 'Has edited user ' . $first_name . ' ' . $surname, 'Admin');

		return;
	}

	function updateUsersGroups($admin,$userid,$groups)
	{
		global $con;

		$q = $con->query("UPDATE mdt_users SET groups = '{$groups}' WHERE userid = '{$userid}'");

		$user = getUserInfo($userid);

		newLogEntry($admin, 'Has edited the access perms for ' . $user['first_name'] . ' ' . $user['surname'], 'Admin');

		return;
	}

	function createCadReport($userid,$incident,$cad,$located,$otherUnits,$arrested,$person,$arrestedFor,$foundItems,$whatHappened)
	{
		global $con;

		$q = $con->query("INSERT INTO reports VALUES(NULL,'{$userid}','{$incident}','{$cad}','{$located}','{$otherUnits}','{$arrested}','{$person}','{$arrestedFor}','{$foundItems}','{$whatHappened}'," . time() . ")");

		return;
	}

	function getCADReports()
	{
		global $con;

		$reports = array();

		$q = $con->query("SELECT * FROM reports");

		while($a = mysqli_fetch_assoc($q)){
			$reports[] = $a;
		}

		return $reports;
	}

	function getReportInfo($id)
	{
		global $con;

		$q = $con->query("SELECT * FROM reports WHERE id = '{$id}'");
		$a = mysqli_fetch_assoc($q);

		return $a;
	}

	function createUser($admin,$first_name,$surname,$email,$steamid,$collar,$password,$ugroups)
	{
		global $con;

		$encrypted_password = password_hash($password, PASSWORD_DEFAULT);

		$q = $con->query("SELECT * FROM mdt_users WHERE email = '{$email}'");

		if($q->num_rows == 0){
			$a = $con->query("INSERT INTO mdt_users VALUES(NULL,'{$first_name}','{$surname}','{$email}','{$steamid}','{$encrypted_password}','{$collar}','{$ugroups}'," . time() . ",1,'')");
		}

		newLogEntry($admin, 'Has created the user ' . $first_name . ' ' . $surname, 'Admin');

		return;
	}

	function getPerms()
	{
		global $con;

		$q = $con->query("SELECT * FROM user_perms");
		$perms = array();

		while($a = mysqli_fetch_assoc($q)){
			$perms[] = $a;
		}

		return $perms;
	}

	function updateUsergroup($admin,$groupid,$name,$perms)
	{
		global $con;

		$q = $con->query("UPDATE usergroups SET name = '{$name}', perms = '{$perms}' WHERE id = '{$groupid}'");

		$q2 = $con->query("SELECT * FROM usergroups WHERE id = '{$groupid}'");
		$a2 = mysqli_fetch_assoc($q2);

		newLogEntry($admin, 'Has editted the usergroup ' . $a2['name'], 'Admin');
	}

	function endShift($admin)
	{
		global $con;

		$q = $con->query("SELECT * FROM units");

		while($a = mysqli_fetch_assoc($q)){
			$q2 = $con->query("UPDATE units SET collar = '', steamid = '', callid = 0, status = 11 WHERE unitid = '{$a['unitid']}'");
		}

		$q3 = $con->query("SELECT * FROM calls");

		while($a3 = mysqli_fetch_assoc($q3)){
			$q4 = $con->query("UPDATE calls SET status = 4 WHERE callid = '{$a3['callid']}'");
		}

		$logsQ = $con->query("UPDATE logs SET visible = 0 WHERE category = 'Patrol'");
		$messagesQ = $con->query("UPDATE messages SET visible = 0 WHERE recive = 'CONTROL' OR post = 'CONTROL'");

		newLogEntry($admin, 'Has ended the shift at ' . date('jS F Y \a\t G\:i'), 'Admin');

		return;
	}

	function changePassword($userid,$new_password,$confirm_password)
	{
		global $con;

		if($new_password == $confirm_password){
			$encrypted_password = password_hash($new_password, PASSWORD_DEFAULT);

			$q = $con->query("UPDATE mdt_users SET password = '{$encrypted_password}' WHERE userid = '{$userid}'");
		}

		return;
	}

	function getPois()
	{
		global $con;

		$q = $con->query("SELECT * FROM pois");
		$pois = array();

		while($a = mysqli_fetch_assoc($q)){
			$pois[] = $a;
		}

		return $pois;
	}

	function getVois()
	{
		global $con;

		$q = $con->query("SELECT * FROM vois");
		$vois = array();

		while($a = mysqli_fetch_assoc($q)){
			$vois[] = $a;
		}

		return $vois;
	}

	function createPoi($civ,$image,$reason,$notes)
	{
		global $con;

		$q = $con->query("INSERT INTO pois VALUES(NULL,'{$civ}','{$image}','{$reason}','{$notes}')");

		return;
	}

	function createVoi($vehicle,$image,$reason,$notes)
	{
		global $con;

		$q = $con->query("INSERT INTO vois VALUES(NULL,'{$vehicle}','{$image}','{$reason}','{$notes}')");

		return;
	}

	function getPoiInfo($poi)
	{
		global $con;

		$q = $con->query("SELECT * FROM pois WHERE id = '{$poi}'");

		$a = mysqli_fetch_assoc($q);

		return $a;
	}

	function getVoiInfo($voi)
	{
		global $con;

		$q = $con->query("SELECT * FROM vois WHERE id = '{$voi}'");

		$a = mysqli_fetch_assoc($q);

		return $a;
	}

	function updatePoi($id,$image,$reason,$notes)
	{
		global $con;

		$q = $con->query("UPDATE pois SET image = '{$image}', reason = '{$reason}', notes = '{$notes}' WHERE id = '{$id}'");

		return;
	}

	function updateVoi($id,$image,$reason,$notes)
	{
		global $con;

		$q = $con->query("UPDATE vois SET image = '{$image}', reason = '{$reason}', notes = '{$notes}' WHERE id = '{$id}'");

		return;
	}

	function clearPoi($id)
	{
		global $con;

		$q = $con->query("DELETE FROM pois WHERE id = '{$id}'");

		return;
	}

	function clearVoi($id)
	{
		global $con;

		$q = $con->query("DELETE FROM vois WHERE id = '{$id}'");

		return;
	}

	function getCadsForUser($userid)
	{
		global $con;

		$q = $con->query("SELECT * FROM reports WHERE user = '{$userid}'");
		$reports = array();

		while($a = mysqli_fetch_assoc($q)){
			$reports[] = $a;
		}

		return $reports;
	}

	function timeAgo($time_ago)
	{
		$cur_time   = time();
        $time_elapsed   = $cur_time - $time_ago;
        $seconds    = $time_elapsed ;
        $minutes    = round($time_elapsed / 60);
        $hours      = round($time_elapsed / 3600);
        $days       = round($time_elapsed / 86400);
        $weeks      = round($time_elapsed / 604800);
        $months     = round($time_elapsed / 2600640);
        $years      = round($time_elapsed / 31207680);
        // Seconds
        if ($seconds <= 60) {
            return "Just now";
        }
        //Minutes
        elseif ($minutes <=60) {
            if ($minutes==1) {
                return "One minute ago";
            } else {
                return "$minutes mins ago";
            }
        }
        //Hours
        elseif ($hours <=24) {
            if ($hours==1) {
                return "An hour ago";
            } else {
                return "$hours hrs ago";
            }
        }
        //Days
        elseif ($days <= 7) {
            if ($days==1) {
                return "Yesterday";
            } else {
                return "$days days ago";
            }
        }
        //Weeks
        elseif ($weeks <= 4.3) {
            if ($weeks==1) {
                return "A week ago";
            } else {
                return "$weeks weeks ago";
            }
        }
        //Months
        elseif ($months <=12) {
            if ($months==1) {
                return "A month ago";
            } else {
                return "$months months ago";
            }
        }
        //Years
        else {
            if ($years==1) {
                return "One year ago";
            } else {
                return "$years years ago";
            }
        }
	}

	function getMessagesBetween($user,$otheruser)
	{
		global $con;

		$q = $con->query("SELECT * FROM messages WHERE (post = '{$otheruser}' AND recive = '{$user}') OR (recive = '{$otheruser}' AND post = '{$user}')");
		$messages = array();

		while($a = mysqli_fetch_assoc($q)){
			$messages[] = $a;
		}

		return $messages;
	}
?>