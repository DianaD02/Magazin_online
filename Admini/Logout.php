<?php
session_start();
session_destroy();
// Redirectare paginaprincipala produse:
header('Location: Index.html');
?>
