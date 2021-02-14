<?php
//1. maak een database aan
//2.maak een config.php aan en maak daar verbinding met de database
    $databaseHost = 'localhost';
    $databaseName = 'uitlegcrud';
    $databaseUsername = 'root';
    $databasePassword = '';
        $mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
//3.maak een index.php aan (homescreen)
    //-zet daarin: een table, met tr en td voor de namen
    //-Maak daarna een php loop, zodat die daaronder de resultaten laat zien van alle gegevens
            while($res = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>".$res['id']."</td>";
    //boven in zet je een link die naar add.html gaat, daar maak je de nieuwe data aan
//4. Maak een add.html aan, hierin maak je een form met action="add.php" en method post en name form1
    //zet in je form: naam, leeftijd, email en een knop.
    //Als je op de knop drukt, voert ie de php code uit van add.php

//5. maak een add.php file aan. Zet hierin alleen code.
                include_once("config.php"); //begin met deze code, zodat hij wordt verbonden met de database.

                if(isset($_POST['Submit'])) {
                    $name = mysqli_real_escape_string($mysqli, $_POST['name']);// begin met deze code (je moet natuurlijk ook age en email doen.)
                    // if isset post submit betekend, als er op de button wordt geklikt, zet hij de gegevens van name en alles in de database

                //check of er lege velden zijn;
                        if(empty($name) || empty($age) || empty($email)) {

                		if(empty($name)) {
                			echo "<font color='red'>Name field is empty.</font><br/>";
                		} // doe deze ook voor email en age enzo
                    //als ze zijn gevuld, zet ze in de database
                            $result = mysqli_query($mysqli, "INSERT INTO users(name,age,email) VALUES('$name','$age','$email')");
                		//maak ook een knop zodat je weet dat het successvol is toegevoegd
                            echo "<font color='green'>Data added successfully.";
                            //maak ook een knop aan die zorgt dat je terug gaat naar de homepage (index)
                            echo "<br/><a href='index.php'>View Result</a>";

//6. maak een delete functie aan, hierin zet je ook alleen maar php code. delete.php
    //begin weer met het includen van de database connectie
                            include("config.php");
            //daarna moet je het ID hebben, zodat je die uit de database kan verwijderen.
                            $id = $_GET['id'];
                            //daarna moet je de rij verwijderen uit de tabel:
                            $result = mysqli_query($mysqli, "DELETE FROM users WHERE id=$id");
                            //zorg ervoor dat je hierna terug gaat naar de homepage, zodat je de site niet hoeft te refreshen met de url link.
                            header("Location:index.php");
//7. maak een update functie aan, hierin zet je php code en de tabel met de oude gegevens erin, die zet je in html, samen met een kleine php code erbij
        //begin weer met het includen naar je connectie
                            include_once("config.php");
                            //zorg er daarna voor dat wanneer je op update klikt, dat je de data heb: id name age en email, zodat je die kan bewerken.
                                $id = mysqli_real_escape_string($mysqli, $_POST['id']); // doe dit voor alle velden
                                //check daarna weer of de velden zijn ingevuld
                                if(empty($name) || empty($age) || empty($email)) {

                                    if(empty($name)) {
                                        echo "<font color='red'>Name field is empty.</font><br/>";
                                    } //doe deze if weer voor elke mogelijkheid: age, email etc.

                                //zorg ervoor dat de tabel wordt geupdate wanneer alles is ingevuld en stuur de data daarna weer terug naar de homepage
                                } else {
                                    //updating the table
                                    $result = mysqli_query($mysqli, "UPDATE users SET name='$name',age='$age',email='$email' WHERE id=$id");

                                    header("Location: index.php");
                                }
                        }
                        // sluit je php tag en maak een nieuwe aan: <?php .. />
                        //in deze php tag zorg je ervoor dat je de ID van de url krijgt, ook select je de data die bij die ID hoort:
                    $id = $_GET['id'];

                    $result = mysqli_query($mysqli, "SELECT * FROM users WHERE id=$id");
                    //met deze while pakt hij alle data van name, age en email in dit geval
                    while($res = mysqli_fetch_array($result))
                    {
                        $name = $res['name'];
                        $age = $res['age'];
                        $email = $res['email'];
                    }
                    // maak hierna de tabel, zodat je ook daadwerkelijk je data kan veranderen
                    <form name="form1" method="post" action="edit.php">
		<table border="0">
			<tr>
				<td>Name</td>
				<td><input type="text" name="name" value="<?php echo $name;?>"></td>
			</tr> // bij value zet je een stukje php code neer, zodat hij standaard de name pakt van de oude gegevens.

               //eindig met de hidden ID en de knop om het ook daadwerkelijk te updaten
                <tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>

