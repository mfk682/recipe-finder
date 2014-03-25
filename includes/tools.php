<?php

/**
 * @link https://www.codedevelopr.com/articles/reading-csv-files-into-php-array/
 */
// Add recipe data
function getRecipeData($jsonFile) {
	$jsonText = file_get_contents($jsonFile);
	return json_decode($jsonText, true);
}


// Add items data
function getItemsData($itemsFile) {
	$fileHandle = fopen($itemsFile, 'r');
	while (!feof($fileHandle) ) {
		$itemsArray[] = fgetcsv($fileHandle, 1024);
	}
	fclose($fileHandle);
	return $itemsArray;
}

// Get a meal
function getMeAMeal($recipeArray, $itemsArray) {
	// Loop through each ingradiant
	$getDateSort = array();
	$validItemCounter = 0;
	for ($i=0; $i<count($recipeArray['ingredients']); $i++) {
		$ItemDetailsArray = $recipeArray['ingredients'][$i];
		for ($j=0; $j<count($itemsArray); $j++) {
			if ($itemsArray[$j][0] == $ItemDetailsArray['item']) {
				// Item exists in the fridge
				if ($itemsArray[$j][2] == $ItemDetailsArray['unit']) {
					// They are same unit
					if ($itemsArray[$j][1] > $ItemDetailsArray['amount']) {
						// Date check - Make sure it works in one go
						$expDateArray = explode("/", $itemsArray[$j][3]);
						$expDate = mktime(0,0,0, $expDateArray[1], $expDateArray[0], $expDateArray[2]);
						$curDate = mktime(0,0,0,date("m"),date("d"),date("Y"));
						if ($expDate > $curDate) {
							// At this point the valid item exists, we will put a counter here to count number of ingradiants that are valid
							$getDateSort[$j] = $expDate;
							$validItemCounter++;
						}
					}	
				}
			}
		}
	}
	//
	$result[0] = $recipeArray['name'];
	($validItemCounter == count($recipeArray['ingredients'])) ? $result[1] = 1 : $result[1] = 0;
	(count($getDateSort) > 0) ? $result[2] = min($getDateSort) : $result[2] = '';
	
	return $result;
}
?>