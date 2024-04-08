<?php
session_start();
if (!isset($_SESSION["addScore"])) {
	$_SESSION["addScore"] = $_SESSION["score"];
} else {
	unset($_SESSION["addScore"]);
}
function generate(){
	$raw_userList = file("./users.txt", FILE_IGNORE_NEW_LINES);
	$dict = [];
	foreach($raw_userList as $userData){
		$userInfo = explode(",", $userData);
		$dict[$userInfo[0]]=$userInfo[2];
		arsort($dict);
	}
	echo "<table>",
		"<tr>",
		"<th>Rank</th>",
		"<th>Name</th>",
		"<th>Score</th>",
		"</tr>";
		$rank = 0;
	foreach($dict as $key=>$value){
		if($rank < 5){
			echo "<tr>",
		"<td>" . ++$rank . "</td>",
		"<td>" . $key . "</td>",
		"<td>" . $value . "</td>",
		"</tr>";
		}
	}
	echo "</table>";
}
function incrementScore($user){
	$raw_userList = file("./users.txt", FILE_IGNORE_NEW_LINES);
	$new_userList = [];
	foreach($raw_userList as $userData){
		$userInfo = explode(",", $userData);
		$dict[$userInfo[0]]=$userInfo[2];
		$modifiedData = "";
		if($userInfo[0] == $user){
			$userInfo[2] = strval(intval($userInfo[2]) + $_SESSION["addScore"]);
			$modifiedData = $userInfo[0] . "," . $userInfo[1] . "," .$userInfo[2];
		} else{
			$modifiedData = $userData;
		}
		array_push($new_userList, $modifiedData);
	}
	$dict[$userInfo[0]]=$userInfo[2];
	for($line = 0; $line < count($new_userList); $line++){
		$new_userList[$line] .= "\n";
	}
	file_put_contents("users.txt", $new_userList);
}

incrementScore($_SESSION["username"]);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Leaderboard</title>
		<meta charset="utf-8" />
		<link href="styles.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<h1>Leaderboard</h1>
		<?php
		generate();
		?>
	</body>
</html>
