<?php
// Functions
include 'includes/tools.php';

// If there was a file upload start processing application
 
if (isset($_POST['submit'])) {
	if (is_uploaded_file($_FILES['items']['tmp_name']) && is_uploaded_file($_FILES['recipe']['tmp_name'])) {
		
		// Recipe array from recipe data file
		$recipeArray = getRecipeData($_FILES['recipe']['tmp_name']);
		
		// Items array from items data file
		$itemsArray = getItemsData($_FILES['items']['tmp_name']);
		
		for ($i=0; $i<count($recipeArray); $i++) {
			// For each recipe return this
			// A flag (if the recipe has all the items) 
			// Name of the recipe
			// Latest expiry data
			$results[$i] = getMeAMeal($recipeArray[$i], $itemsArray);
		}
	}
}
?>