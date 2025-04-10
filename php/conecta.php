<!--
Este script estabelece a conexão com o banco de dados MySQL.
Configura os parâmetros de acesso como servidor, usuário, senha e nome do banco.
Se houver erro na conexão, o script será encerrado com uma mensagem de erro.
-->


<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "patasdigitais";

$conexao = new mysqli($servidor, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}
?>
