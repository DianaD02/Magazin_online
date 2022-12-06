<?php
    // Schimbați acest lucru cu informațiile despre conexiune.
    $host='localhost';
    $username='root';
    $password='';
    $db='magazin online';
    // Incerc sa ma conectez pe baza info de mai sus.
    $con = mysqli_connect($host, $username, $password, $db);
    if (mysqli_connect_errno()) {
        // Dacă există o eroare la conexiune, opriți scriptul și afișați eroarea.
        exit('Nu se poate conecta la MySQL: ' . mysqli_connect_error());
    }
    //.
    if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
        // Nu s-au putut obține datele care ar fi trebuit trimise.
        exit('Complare formular registration !');
    }
    // Asigurați-vă că valorile înregistrării trimise nu sunt goale.
    if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
        // One or more values are empty.
        exit('Completare registration form');
    }
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        exit('Email nu este valid!');
    }
    if (preg_match('/[A-Za-z0-9]+/', $_POST['username']) == 0) {
        exit('Username nu este valid!');
    }
    if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
        exit('Password trebuie sa fie intre 5 si 20 charactere!');
    }
    // verificam daca contul userului exista.
    if ($stmt = $con->prepare('SELECT Client_id, password FROM clienti WHERE username = ?')) {
        // hash parola folosind funcția PHP password_hash.
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        $stmt->store_result();
        // Memoram rezultatul, astfel încât să putem verifica dacă contul există în baza de date.
        if ($stmt->num_rows > 0) {
            // Username exista
            echo 'Username exists, alegeti altul!';
        } 
        else 
        {
            $user = htmlentities($_POST['username'], ENT_QUOTES);
            $pass = password_hash(htmlentities($_POST['password'], ENT_QUOTES),PASSWORD_DEFAULT);
            $em = htmlentities($_POST['email'], ENT_QUOTES);
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
            //htmlentities()-transforma caractere HTML in entitati ale acestora
            // verificam daca sunt completate
            if ($name == '' || $user == ''||$pass==''||$em==''||$str==''||$city=='' || $country=='' || $zip=='' || $numberC=='' || $typeC=='' || $expC=='' || $accEmail=='' )
            {
                // daca sunt goale se afiseaza un mesaj
                $error = 'ERROR: Campuri goale!';
            } 
            else
            {
                if ($stmt = $con->prepare('INSERT INTO clienti (username, password, email,Strada, Oras, Tara, CodPostal, NrCard, TipCard, DataExpCard, AcceptareEmail, Nume, NrInregRC, cod_fiscal) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?)')) {
                    // Nu dorim să expunem parole în baza noastră de date, așa că hash parola și utilizați //password_verify atunci când un utilizator se conectează.
                    //$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $stmt->bind_param('ssssssssssssss', $user, $pass, $em, $str, $city, $country, $zip, $numberC, $typeC, $expC,$accEmail,$name,$RC,$codF);
                    $stmt->execute();
                    echo 'Success inregistrat!';
                    header('Location: Index.html');
                } 
                else 
                {
                    // Ceva nu este în regulă cu declarația sql, verificați pentru a vă asigura că tabelul conturilor //există cu toate cele 3 câmpuri.
                    echo 'Nu se poate face prepare statement!';
                }
            }
           
        }
        $stmt->close();
    } else {
    // Ceva nu este în regulă cu declarația sql, verificați pentru a vă asigura că tabelul conturilor //există cu toate cele 3 câmpuri.
    echo 'Nu se poate face prepare statement!';
    }
    $con->close();
?>