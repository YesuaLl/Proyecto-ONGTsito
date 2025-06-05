<?php
try {
    $conexion = new PDO(
        "mysql:host=localhost;dbname=tsito1", "root", "201103",
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'")
    );
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ Conexión exitosa a la base de datos.";
} catch (PDOException $e) {
    echo "❌ Error de conexión: " . $e->getMessage();
}
?>
