<!DOCTYPE html>
<html>
<head>
	<title>Recipe Builder</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0" />
	<link href="includes/default.css" rel="stylesheet" type="text/css" />
</head>
<!-- A php script where we pass recipe and items data and get the results -->
<?php include_once 'includes/recipe-finder.php'; ?>
<body>
	<div class="content">
		<h4>Recipe Finder</h4>
		<h3>Author: Farshid Kamal</h3>
		<h3>Date: 25/03/2014</h3>
		<h3><a href="doc/recipefinder.pdf">Guideline</a></h3>
		<h3>Basic workflow:</h3>
		<h2>
		
			<p>This is a test for News Media to create an application that will check a list of items in the fridge and recomend a menu from a recipe.</p>
			<ol>
				<li>Upload a local copy of recipe(txt) and save it in an array </li>
				<li>Upload a local copy of items(csv) and save it in an array </li>
				<li>Create a function in PHP and pass one receipe at a time with all items and return an array with status</li>
				<li>Show results according to guideline</li>
			</ol>
		</h2>
		<hr>
		<!-- A form with two elements, one for uploading .csv file and a button to recommend a receipe -->
		<form enctype='multipart/form-data' action='index.php' method='post'>
			Recipe data file: <input size='50' type='file' name='recipe'><br />
			Items data csv: <input size='50' type='file' name='items'><br />
			<input type='submit' name='submit' value='Get a recipe'>
			<h2>Please download recipe.txt <a href="data/recipe.txt">here</a> Right-clich (Save Link as)</h2>
			<h2>Please download items csv <a href="data/item-list-a.csv">here</a></h2>
		</form>	
	</div>
	<div class="results">
		<h3>Results:</h3>
		<?php 
		if (isset($results))
		{
			$takeoutCount = 0;
			for ($i=0; $i<count($results); $i++)
			{
				if ($results[$i][1] == 1) {
					echo $results[$i][0]."<br />";
					$takeoutCount++;
				}
			}
			if ($takeoutCount == 0) echo "Order Takeout";
		}
		?>
		
	
	</div>
</body>
</html>
