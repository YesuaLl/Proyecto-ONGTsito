<?php
// modeloVoluntario.php
include_once("AccesoDatos.php");

function correoExiste($conn, $correo) {
    $stmt = $conn->prepare("SELECT id FROM voluntarios WHERE CORREO = ?");
    $stmt->execute([$correo]);
    return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
}

function registrarVoluntario($conn, $nombre, $apellidoPaterno, $apellidoMaterno, $correo, $sexo, $telefono, $hashed_password) {
    $stmt = $conn->prepare("INSERT INTO voluntarios (NOMBRE, APELLIDOPATERNO, APELLIDOMATERNO, CORREO, SEXO, TELEFONO, CONTRASEÑA) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    return $stmt->execute([$nombre, $apellidoPaterno, $apellidoMaterno, $correo, $sexo, $telefono, $hashed_password]);
}
function obtenerVoluntarioPorId($conn, $id) {
    $stmt = $conn->prepare("SELECT * FROM voluntarios WHERE ID = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}