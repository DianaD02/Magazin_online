<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: Index.html');
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Home</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>

<body class="loggedin">
    <nav class="navtop">
        <div>
            <h1>Home</h1>
            <a href="Magazin.php"><i class="fas fa-usercircle"></i>Shop</a>
            <a href="Logout.php"><i class="fas fa-sign-outalt"></i>Logout</a>
        </div>
    </nav>
    <div class="content">
        <h2>Pagina cu parola</h2>
        <p>Bine ati revenit, <?= $_SESSION['name'] ?>!</p>
    </div>
</body>

</html>