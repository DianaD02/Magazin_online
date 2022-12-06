<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Vizualizare Inregistrari</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
    <h1>Clienti inregistrati</h1>
    <p><b>Toate inregistrarile din Clienti</b</p>
    <?php
        // connectare bazadedate
         include("Conectare.php");
        // se preiau inregistrarile din baza de date
        if ($result = $mysqli->query("SELECT * FROM clienti ORDER BY Client_id "))
        { // Afisare inregistrari pe ecran
            if ($result->num_rows > 0)
            {
            // afisarea inregistrarilor intr-o table
            echo "<table border='1' cellpadding='10'>";
            // antetul tabelului
            echo "<tr><th>ID</th><th>Username</th><th>Parola</th><th>Email</th><th>Strada</th><th>Oras</th><th>Tara</th><th>Cod Postal</th><th>Numar Card</th><th>Tip Card</th><th>Data expirarii card</th><th>Acceptare email</th><th>Nume</th><th>Nr Inreg RC</th><th>Cod Fiscal</th></tr>";
            while ($row = $result->fetch_object())
            {
                // definirea unei linii pt fiecare inregistrare
                echo "<tr>";
                echo "<td>" . $row->Client_id . "</td>";
                echo "<td>" . $row->username . "</td>";
                echo "<td>" . $row->password . "</td>";
                echo "<td>" . $row->email . "</td>";
                echo "<td>" . $row->Strada . "</td>";
                echo "<td>" . $row->Oras . "</td>";
                echo "<td>" . $row->Tara . "</td>";
                echo "<td>" . $row->CodPostal . "</td>";
                echo "<td>" . $row->NrCard . "</td>";
                echo "<td>" . $row->TipCard . "</td>";
                echo "<td>" . $row->DataExpCard . "</td>";
                echo "<td>" . $row->AcceptareEmail . "</td>";
                echo "<td>" . $row->Nume . "</td>";
                echo "<td>" . $row->NrInregRC . "</td>";
                echo "<td>" . $row->cod_fiscal . "</td>";
                echo "<td><a href='Clienti_Modificare.php?id=" . $row->Client_id . "'>Modificare</a></td>";
                echo "<td><a href='Clienti_Stergere.php?id=" .$row->Client_id . "'>Stergere</a></td>";
                echo "</tr>";
            }
                echo "</table>";
            }
            // daca nu sunt inregistrari se afiseaza un rezultat de eroare
            else
            {
                echo "Nu sunt inregistrari in tabela!";
            }
        }
        // eroare in caz de insucces in interogare
        else
        { 
            echo "Error: " . $mysqli->error; 
        }
        // se inchide
        $mysqli->close();
    ?>
    
    <a href="Clienti_Inserare.php">Adaugarea unei noi inregistrari</a>
  
</body>
</html>