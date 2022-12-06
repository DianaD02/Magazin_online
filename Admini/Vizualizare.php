<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <title>SephoraAdmin</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <h1>Inregistrarile din tabela produse</h1>
    <p><b>Toate produsele</b</p>
</br>
<a href="Home.php">Inapoi la pagina principala</a>
</br>
            <?php
            // connectare bazadedate
            include("Conectare.php");
            // se preiau inregistrarile din baza de date
            if ($result = $mysqli->query("SELECT * FROM tbl_product ORDER BY id ")) { // Afisare inregistrari pe ecran
                if ($result->num_rows > 0) {
                    // afisarea inregistrarilor intr-o table
                    echo "<table border='1' cellpadding='30'>";
                    // antetul tabelului
                    echo "<tr><th>ID</th><th>Produs</th><th>Cod</th><th>Imagine</th><th>Descriere</th><th>Categorie</th><th>Pret</th></tr>";
                    while ($row = $result->fetch_object()) {
                        // definirea unei linii pt fiecare inregistrare
                        echo "<tr>";
                        echo "<td>" . $row->id . "</td>";
                        echo "<td>" . $row->name . "</td>";
                        echo "<td>" . $row->code . "</td>";
                        echo "<td>" . "<img src='$row->image' width='60px'>" . "</td>";
                        echo "<td>" . $row->descriere . "</td>";
                        echo "<td>" . $row->categorie . "</td>";
                        echo "<td>" . $row->price. "</td>";
                        echo "<td><a href='Modificare.php?id=" . $row->id . "'>Modificare</a></td>";
                        echo "<td><a href='Stergere.php?id=" . $row->id . "'>Stergere</a></td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                // daca nu sunt inregistrari se afiseaza un rezultat de eroare
                else {
                    echo "Nu sunt inregistrari in tabela!";
                }
            }
            // eroare in caz de insucces in interogare
            else {
                echo "Error: " . $mysqli->error;
            }
            // se inchide
            $mysqli->close();
            ?>
            <a href="Inserare.php">Adauga un nou produs</a>
</body>

</html>