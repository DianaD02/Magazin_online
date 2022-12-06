<?php // connectare bazadedate
include("Conectare.php");
//Modificare datelor
// se preia id din pagina vizualizare
$error = '';
if (!empty($_POST['id'])) {
    if (isset($_POST['submit'])) { // verificam daca id-ul din URL este unul valid
        if (is_numeric($_POST['id'])) { // preluam variabilele din URL/form
            $id = $_POST['id'];
            $nume = htmlentities($_POST['nume'], ENT_QUOTES);
            $code = htmlentities($_POST['code'], ENT_QUOTES);
            $imagine = htmlentities($_POST['imagine'], ENT_QUOTES);
            $price = htmlentities($_POST['price'], ENT_QUOTES);
            $descriere = htmlentities($_POST['descriere'], ENT_QUOTES);
            $categorie = htmlentities($_POST['categorie'], ENT_QUOTES);
            // verificam daca numele, prenumele, an si grupa nu sunt goale
            if ($nume == '' || $code == '' || $imagine == '' || $price == '' || $descriere == '' || $categorie == '') { // daca sunt goale afisam mesaj de eroare
                echo "<div> ERROR: Completati campurile obligatorii!</div>";
            } else { // daca nu sunt erori se face update name, code, image, price, descriere, categorie
                if ($stmt = $mysqli->prepare("UPDATE tbl_product SET
name=?,code=?,image=?,price=?,descriere=?, categorie=? WHERE id='" . $id . "'")) {
                    $stmt->bind_param(
                        "sssdss",
                        $nume,
                        $code,
                        $imagine,
                        $price,
                        $descriere,
                        $categorie
                    );
                    $stmt->execute();
                    $stmt->close();
                } // mesaj de eroare in caz ca nu se poate face update
                else {
                    echo "ERROR: nu se poate executa update.";
                }
            }
        }
        // daca variabila 'id' nu este valida, afisam mesaj de eroare
        else {
            echo "id incorect!";
        }
    }
} ?>
<html>

<head>
    <title> <?php if ($_GET['id'] != '') {
                echo "Modificare inregistrare";
            } ?> </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
</head>

<body>
    <h1><?php if ($_GET['id'] != '') {
            echo "Modificare Inregistrare";
        } ?></h1>
    <?php if ($error != '') {
        echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>";
    } ?>
    <form action="" method="post">
        <div>
            <?php if ($_GET['id'] != '') { ?>
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
                <p>ID: <?php echo $_GET['id'];
                        if ($result = $mysqli->query("SELECT * FROM tbl_product where id='" . $_GET['id'] . "'")) {
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_object(); ?></p>
                <strong>Nume: </strong> <input type="text" name="nume" value="<?php echo $row->name; ?>" /><br />
                <strong>Code: </strong> <input type="text" name="code" value="<?php echo $row->code; ?>" /><br />
                <strong>Imagine: </strong> <input type="text" name="imagine" value="<?php echo $row->image; ?>" /><br />
                <strong>Pret: </strong> <input type="text" name="price" value="<?php echo $row->price; ?>" /><br />
                <strong>Descriere: </strong> <input type="text" name="descriere" value="<?php echo $row->descriere; ?>" /><br />
                <strong>Categorie: </strong> <input type="text" name="categorie" value="<?php echo $row->categorie;}}} ?>" /><br />
                <br />
                <input type="submit" name="submit" value="Submit" />
                <a href="Vizualizare.php">Index</a>
        </div>
    </form>
</body>

</html>