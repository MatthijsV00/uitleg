<html>
<head>
    <title>Add Data</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>

<body>
<div id="link-container">
<a href="index.php"id="link">Home</a>
</div>
<br/><br/>

<form action="add.php" method="post" name="form1">
    <table class="styled-table">
        <tr class="active-row">
            <td>Name*</td>
            <td><input type="text" name="name"></td>
        </tr>
        <tr class="active-row">
            <td>Age*</td>
            <td><input type="text" name="age"></td>
        </tr>
        <tr class="active-row">
            <td>Email*</td>
            <td><input type="text" name="email"></td>
        </tr>
        <tr class="active-row">
            <td></td>
            <td><input type="submit" name="Submit" value="Add"></td>
        </tr>
    </table>
</form>
</body>
</html>
<?php
//including the database connection file
include_once("config.php");

if(isset($_POST['Submit'])) {	
	$name = mysqli_real_escape_string($mysqli, $_POST['name']);
	$age = mysqli_real_escape_string($mysqli, $_POST['age']);
	$email = mysqli_real_escape_string($mysqli, $_POST['email']);
		
	// checking empty fields
	if(empty($name) || empty($age) || empty($email)) {

		if(empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}

		if(empty($age)) {
			echo "<font color='red'>Age field is empty.</font><br/>";
		}

		if(empty($email)) {
			echo "<font color='red'>Email field is empty.</font><br/>";
		}
		


	} else { 
		// if all the fields are filled (not empty) 
			
		//insert data to database	
		$result = mysqli_query($mysqli, "INSERT INTO users(name,age,email) VALUES('$name','$age','$email')");

		//display success message
		echo "<font color='green'>Data added successfully.";
		echo "<br/><a href='index.php'>View Result</a>";
	}
}
?>

