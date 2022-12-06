<?php 
// connectare bazadedate
    include("Conectare.php");
    //Modificare datelor
    // se preia id din pagina vizualizare
    $error='';
    if (!empty($_POST['id']))
    { 
        if (isset($_POST['submit']))
        { 
            // verificam daca id-ul din URL este unul valid
            if (is_numeric($_POST['id']))
            { 
            // preluam variabilele din URL/form
                $id = $_POST['id'];
                $username = htmlentities($_POST['username'], ENT_QUOTES);
                $password = htmlentities($_POST['password'], ENT_QUOTES);
                $email = htmlentities($_POST['email'], ENT_QUOTES);
                $strada = htmlentities($_POST['strada'], ENT_QUOTES);
                $oras = htmlentities($_POST['oras'], ENT_QUOTES);
                $tara = htmlentities($_POST['tara'], ENT_QUOTES);
                $codPostal = htmlentities($_POST['codPostal'], ENT_QUOTES);
                $nrCard = htmlentities($_POST['nrCard'], ENT_QUOTES);
                $tipCard = htmlentities($_POST['tipCard'], ENT_QUOTES);
                $dataExpCard = htmlentities($_POST['dataExpCard'], ENT_QUOTES);
                $acceptareEmail = htmlentities($_POST['acceptareEmail'], ENT_QUOTES);
                $nume = htmlentities($_POST['nume'], ENT_QUOTES);
                $nrInregRC = htmlentities($_POST['nrInregRC'], ENT_QUOTES);
                $codFiscal = htmlentities($_POST['codFiscal'], ENT_QUOTES);
                // verificam daca numele, prenumele, an si grupa nu sunt goale
                if ($nume == '' || $username == ''||$password==''||$email==''||$strada==''||$oras=='' || $tara=='' || $codPostal=='' || $nrCard=='' || $tipCard=='' || $dataExpCard=='' || $acceptareEmail=='' || $nrInregRC=='' || $codFiscal=='')
                { // daca sunt goale afisam mesaj de eroare
                    echo "<div> ERROR: Completati campurile obligatorii!</div>";
                }
                else
                { 
                    // daca nu sunt erori se face update name, code, image, price, descriere, categorie
                    if ($stmt = $mysqli->prepare("UPDATE clienti SET username=?, password=?, email=?, Strada=?, Oras=?, Tara=?, CodPostal=?, NrCard=?, TipCard=?, DataExpCard=?, AcceptareEmail=?, Nume=?, NrInregRC=?, cod_fiscal=? WHERE Client_id='".$id."'"))
                    {
                        $stmt->bind_param("ssssssssssssss", $username, $password, $email, $strada, $oras, $tara, $codPostal, $nrCard, $tipCard, $dataExpCard,$acceptareEmail,$nume,$nrInregRC,$codFiscal);
                        $stmt->execute();
                        $stmt->close();
                    }
                    // mesaj de eroare in caz ca nu se poate face update
                    else
                    {
                        echo "ERROR: nu se poate executa update.";}
                    }
            }
    // daca variabila 'id' nu este valida, afisam mesaj de eroare
    else
    {
        echo "id incorect!";
    } 
        }
    }
?>
<html> 
<head>
    <title> <?php if ($_GET['id'] != '') { echo "Modificare inregistrare"; }?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf8"/></head>
<body>
    <h1>
    <?php 
        if ($_GET['id'] != '') { echo "Modificare Inregistrare"; }
    ?>
    </h1>
    <?php 
    if ($error != '') {echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";} 
    ?>
    <form action="" method="post">
        <div>
            <?php if ($_GET['id'] != '') { ?>
            <input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
            <p>ID: <?php echo $_GET['id'];
            if ($result = $mysqli->query("SELECT * FROM clienti where Client_id='".$_GET['id']."'"))
            {
            if ($result->num_rows > 0){
                 $row = $result->fetch_object();?></p>
            <strong>Username: </strong> <input type="text" name="username" value="<?php echo$row->username; ?>"/><br/>
            <strong>Parola: </strong> <input type="text" name="password" value="<?php echo$row->password; ?>"/><br/>
            <strong>Email: </strong> <input type="text" name="email" value="<?php echo$row->email; ?>"/><br/>
            <strong>Strada: </strong> <input type="text" name="strada" value="<?php echo$row->Strada; ?>"/><br/>
            <strong>Oras: </strong> <input type="text" name="oras" value="<?php echo$row->Oras; ?>"/><br/>
            <strong>Tara: </strong> <input type="text" name="tara" value="<?php echo$row->Tara; ?>"/><br/>
            <strong>Cod Postal: </strong> <input type="text" name="codPostal" value="<?php echo$row->CodPostal; ?>"/><br/>
            <strong>Numar Card: </strong> <input type="text" name="nrCard" value="<?php echo$row->NrCard; ?>"/><br/>
            <strong>Tip Card: </strong> <input type="text" name="tipCard" value="<?php echo$row->TipCard; ?>"/><br/>
            <strong>Data expirarii card: </strong> <input type="text" name="dataExpCard" value="<?php echo$row->DataExpCard; ?>"/><br/>
            <strong>Acceptare Email: </strong> <input type="text" name="acceptareEmail" value="<?php echo$row->AcceptareEmail; ?>"/><br/>
            <strong>Nume: </strong> <input type="text" name="nume" value="<?php echo$row->Nume; ?>"/><br/>
            <strong>Numar inregistrare RC: </strong> <input type="text" name="nrInregRC" value="<?php echo$row->NrInregRC; ?>"/><br/>
            <strong>Cod Fiscal: </strong> <input type="text" name="codFiscal" value="<?php echo$row->cod_fiscal; }}} ?>"/><br/>
            <br/>
            <input type="submit" name="submit" value="Submit" />
            <a href="Clienti_Vizualizare.php">Index</a>
        
        </div>
    </form>
</body>
</html>