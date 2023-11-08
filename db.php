<?php

try {
    $PDO = new PDO('mysql:host=localhost;dbname=PIT;', 'root', '');
} catch (PDOException $erro) {
    echo 'Erro ao conectar com o MySQL: ' . $erro->getMessage();
};

