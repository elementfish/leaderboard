<?php



$q = $_GET["name"]; // selected player
$r = $_GET["flag"]; // flag of score increase

$xmlLboard = simplexml_load_file("leaderboard.xml");

if (!empty($q)&& $r==1)
	for ($i = 0; $i < count($xmlLboard); $i++){	
		if ($xmlLboard->Record[$i]->Name == $q){	//find player
			
			
			$xmlLboard->Record[$i]->Score += 5;   // score increase
			
			// sort
			$j = $i;
			while ($j>0 && (double)$xmlLboard->Record[$j-1]->Score <= (double)$xmlLboard->Record[$j]->Score){
				
				$t = array(0 => (String) $xmlLboard->Record[$j-1]->Name, 1 => (Double) $xmlLboard->Record[$j-1]->Score);
				$xmlLboard->Record[$j-1]->Name = $xmlLboard->Record[$j]->Name;
				$xmlLboard->Record[$j-1]->Score = $xmlLboard->Record[$j]->Score;
				$xmlLboard->Record[$j]->Name = $t[0];
				$xmlLboard->Record[$j]->Score = $t[1];
				$j--;
			}
			
			$xmlLboard->asXML("leaderboard.xml");   // save xml
		}
	}
	
	
// echo html
	
for ($i = 0; $i < count($xmlLboard->Record); $i++){
	echo('<div class="player">');
	echo('<span class="name">' .  $xmlLboard->Record[$i]->Name . '</span>');
	echo('<span class="score">' . $xmlLboard->Record[$i]->Score . '</span>');
	echo('</div>');
}

	
	
?>