<?php
// Functions
include 'includes/tools.php';

// If there was a file upload start processing application
 
if (isset($_POST['submit'])) {
	if (is_uploaded_file($_FILES['items']['tmp_name']) && is_uploaded_file($_FILES['recipe']['tmp_name'])) {
		
		// Class declaration
		$myTools = new Tools;
		
		// Recipe array from recipe data file
		$recipeArray = $myTools->getRecipeData($_FILES['recipe']['tmp_name']);
		
		// Items array from items data file
		$itemsArray = $myTools->getItemsData($_FILES['items']['tmp_name']);
		
		for ($i=0; $i<count($recipeArray); $i++) {
			// For each recipe return this
			// A flag (if the recipe has all the items) 
			// Name of the recipe
			// Latest expiry data
			$results[$i] = $myTools->getMeAMeal($recipeArray[$i], $itemsArray);
		}
	}
}
?>