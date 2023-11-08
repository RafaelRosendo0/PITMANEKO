<?php
session_start();

$lanchonete = $_POST["lanchonete"];


$_SESSION["lanchonete"] = $lanchonete;
