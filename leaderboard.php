<?php
function generate(){
	$file = file_get_contents("users.txt");
	$raw_userList = explode("\n", $file);
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
	$file = file_get_contents("users.txt");
	$raw_userList = explode("\n", $file);
	$new_userList = [];
	foreach($raw_userList as $userData){
		$userInfo = explode(",", $userData);
		$dict[$userInfo[0]]=$userInfo[2];
		$modifiedData = "";
		if($userInfo[0] == $user){
			$userInfo[2] = strval(intval($userInfo[2]) + 1);
			$modifiedData = $userInfo[0] . "," . $userInfo[1] . "," .$userInfo[2];
		} else{
			$modifiedData = $userData;
		}
		array_push($new_userList, $modifiedData);
	}
	$dict[$userInfo[0]]=$userInfo[2];
	var_dump($raw_userList);
	echo "<br><br>";
	var_dump($new_userList);
	for($line = 0; $line < count($new_userList); $line++){
		$new_userList[$line] .= "\n";
	}
	file_put_contents("users.txt", $new_userList);
}

# incrementScore("User");
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
		<button>Test</button>

	</body>
</html>