<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Secret Santa</title>
	<link rel="stylesheet" href="css/layout.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="js/general.js"></script>
</head>
<body>
	<div class="wrapper">
		<h1 style="text-align: center;">Secret Santa Matcher</h1>
		<div class="intro">
			<p>A web application that allows you and your group of friends to be matched up with a partner for Kris Kringle (Sercret Santa)!</p>
			<a href="#" id="help-btn">Help?</a>
			<div class="clear"></div>
		</div>
		<section id="help">
			<h2 style="margin: 0 0 5px 0;">HELP</h2>
			<ol>
				<li>List the names of all people participating in the "People Involved" field.</li>
				<li>If a certain pair of people cannot receive each other, list both their names in the "Restrictions" field.</li>
				<ul>
					<li>Example - If Bob does not want to receive Sarah as a partner, enter "Bob, Sarah" into the "Restrictions" field.</li>
				</ul>
				<li>If you press the "Add +" button, a new restriction field will be available for you to add more restrictions.</li>
				<li>Press the "MATCH" button to generate a table of givers and takers!</li>
			</ol>
		</section>

		<section id="inputs">
			<form action="index.php" method="POST">
				<div class="form-field">
					<label for="users">People Involved: <small>(seperate by comma | <span style="cursor: help; border-bottom: 1px dashed" title="Duplicate names will be ignored">names must be unquie</span>)</small></label>
					<input type="text" name="users" id="users" placeholder="Person1, Person2, etc">
				</div>

				<div class="form-field">
					<label for="restrictions">Restrictions:</label>
					<input type="text" name="restrictions[]" placeholder="Person1, Person2" class="restrictions">
					<button id="add-restriction">Add +</button>
					<button id="remove-restriction">Remove -</button>
				</div>

				<div class="form-field" style="text-align: right;">
					<input type="submit" name="match" value="Match" id="match">
				</div>
			</form>
		</section>

		<section id="matches">
			Use the form above to get started!
		</section>

		<footer>Created by Mehmet Uyanik | 2015</footer>
	</div>
</body>
</html>