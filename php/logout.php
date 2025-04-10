<?php
// Este script encerra a sessão do usuário (logout).
session_start();
session_unset();
session_destroy();
header("Location: ../index.php");
exit();

?>
