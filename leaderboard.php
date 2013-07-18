<? php
	function cmp($a, $b){
		return ( (double) $a -> Score < (double) $b -> Score)? -1:1;
	}
	function leaderboardsort($d){
		$a = array();
		foreach($d -> Record as $r){
			$a[] = $r
		}
		usort($a, 'cmp');
		return $a
	}

	$q = $_GET["q"];
	$xmlLboard = new DOMDocument();
	$xmlLboard->load("leaderboard.xml");
	
	$dataLboard = $xmlLboard -> getElementsByTagName("Record");
	
	if (!empty($q))
		for ($i = 0; $i < $dataLboard -> length; $i++){	
			if ($dataLboard -> item($i) -> childNodes -> item(0) -> nodeValue == $q){
				$dataLboard -> item($i) -> childNodes -> item(0) -> nodeValue += 5;
				;
				$xmlLboard -> saveXML($dataLboard -> item($i));
			}
	
	
	
	$sortedData = leaderboardsort($dataLboard);
	
	for ($i = 0; $i < count($sortedData); $i++){
		echo('<div class="player">');
		echo('<span class="name">' .  $sortedData[i] -> Name . '</span>');
		echo('<span class="score">' . $sortedData[i] -> Score . '</span>');
		echo('</div>');
	}
	
	
?>