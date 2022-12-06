<?php
    include("Conectare.php");
    $error='';
    if (isset($_POST['submit']))
    {
        // preluam datele de pe formular
        $user = htmlentities($_POST['user'], ENT_QUOTES);
        $pass = htmlentities($_POST['pass'], ENT_QUOTES);
        $em = htmlentities($_POST['em'], ENT_QUOTES);
        $str = htmlentities($_POST['str'], ENT_QUOTES);
        $city = htmlentities($_POST['city'], ENT_QUOTES);
        $country = htmlentities($_POST['country'], ENT_QUOTES);
        $zip = htmlentities($_POST['zip'], ENT_QUOTES);
        $numberC = htmlentities($_POST['numberC'], ENT_QUOTES);
        $typeC = htmlentities($_POST['typeC'], ENT_QUOTES);
        $expC = htmlentities($_POST['expC'], ENT_QUOTES);
        $accEmail = htmlentities($_POST['accEmail'], ENT_QUOTES);
        $name = htmlentities($_POST['name'], ENT_QUOTES);
        $RC = htmlentities($_POST['RC'], ENT_QUOTES);
        $codF = htmlentities($_POST['codF'], ENT_QUOTES);
        // verificam daca sunt completate
        if ($name == '' || $user == ''||$pass==''||$em==''||$str==''||$city=='' || $country=='' || $zip=='' || $numberC=='' || $typeC=='' || $expC=='' || $accEmail=='' || $RC=='' || $codF=='')
        {
            // daca sunt goale se afiseaza un mesaj
            $error = 'ERROR: Campuri goale!';
        } 
        else 
        {
            // inserare
            if ($stmt = $mysqli->prepare("INSERT into clienti (username, password, email, Strada, Oras, Tara, CodPostal, NrCard, TipCard, DataExpCard, AcceptareEmail, Nume, NrInregRC, cod_fiscal) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?)"))
            {
                $stmt->bind_param("ssssssssssssss", $user, $pass, $em, $str, $city, $country, $zip, $numberC, $typeC, $expC,$accEmail,$name,$RC,$codF);
                $stmt->execute();
                $stmt->close();
            }
            // eroare le inserare
            else
            {
                echo "ERROR: Nu se poate executa insert.";
            }
        }
    }
    // se inchide conexiune mysqli
    $mysqli->close();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title><?php echo "Inserare inregistrare"; ?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head> 
<body>
    <h1><?php echo "Inserare inregistrare"; ?></h1>
    <?php if ($error != '') {
    echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";} ?>
    <form action="" method="post">
        <div>
            <strong>Username: </strong> <input type="text" name="user" value=""/><br/>
            <strong>Parola: </strong> <input type="text" name="pass" value=""/><br/>
            <strong>Email: </strong> <input type="text" name="em" value=""/><br/>
            <strong>Strada: </strong> <input type="text" name="str" value=""/><br/>
            <strong>Oras: </strong> <input type="text" name="city" value=""/><br/>
            <strong>Tara: </strong> <input type="text" name="country" value=""/><br/>
            <strong>Cod Postal: </strong> <input type="text" name="zip" value=""/><br/>
            <strong>Numar Card: </strong> <input type="text" name="numberC" value=""/><br/>
            <strong>Tip Card: </strong> <input type="text" name="typeC" value=""/><br/>
            <strong>Data expirarii card: </strong> <input type="text" name="expC" value=""/><br/>
            <strong>Acceptare Email: </strong> <input type="text" name="accEmail" value=""/><br/>
            <strong>Nume: </strong> <input type="text" name="name" value=""/><br/>
            <strong>Numar inregistrare RC: </strong> <input type="text" name="RC" value=""/><br/>
            <strong>Cod Fiscal: </strong> <input type="text" name="codF" value=""/><br/>
            <br/>
            <input type="submit" name="submit" value="Submit" />
            <a href="Clienti_Vizualizare.php">Index</a>
        </div>
    </form>
</body>
</html>