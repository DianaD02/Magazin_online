<?php
session_start();

$host='localhost';
$username='root';
$password='';
$db='magazin online';

$connect = mysqli_connect($host, $username, $password, $db);
if(!mysqli_connect_errno())
    echo 'Conectat la baza de date: '.$db;

///verificare daca exista sau au fost trimise datele din formular 
if(!isset($_POST['username'], $_POST['password'])) 
            exit("Completati datele de autentificare");

if ($stmt = $connect->prepare('SELECT id, password FROM utilizatori WHERE username = ?')) {
    // Parametrii de legare (s = șir, i = int, b = blob etc.), în cazul nostru numele de utilizator este un șir, //așa că vom folosi „s”
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    // Stocați rezultatul astfel încât să putem verifica dacă contul există în baza de date.
    $stmt->store_result();

if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        // Contul există, acum verificăm parola.
        // Notă: nu uitați să utilizați password_hash în fișierul de înregistrare pentru a stoca parolele hash.
        
if (password_verify($_POST['password'], $password)) {
            // Verification success! User has loggedin!
            // Creați sesiuni, astfel încât să știm că utilizatorul este conectat, acestea acționează practic ca cookie-//uri, dar rețin datele de pe server.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            echo 'Bine ati venit, ' . $_SESSION['name'] . '!';
            header('Location: Home.php');
        } else {
            // password incorrect
            echo '<div> Incorrect username sau password! </div>';
        
        }
    } else {
        // username incorect
            echo '<div>Incorrect username sau password!</div>';
    }
    $stmt->close();
}
?>