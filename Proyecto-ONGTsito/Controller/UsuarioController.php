<?php
require_once("Model/Usuario.php");

class UsuarioController {
     public function login() {
        $mensaje = "";

        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
            header("Location: eventos.php");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $usuario = $_POST["email"] ?? "";
            $contrasena = $_POST["password"] ?? "";

            $oUsu = new Usuario();
            $oUsu->setUsuario($usuario);
            $oUsu->setContrasena($contrasena);

            try {
                if ($oUsu->validarLogin()) {
                    // Usuario validado: obtener datos completos del voluntario/admin
                    if ($oUsu->getRol() === "voluntario") {
                        $datos = Usuario::obtenerPorCorreo($usuario);
                        $_SESSION["id_voluntario"] = $datos["id"] ?? null;
                        $_SESSION["nombre_voluntario"] = $datos["NOMBRE"] ?? "";
                        $_SESSION["ap_paterno_voluntario"] = $datos["APELLIDOPATERNO"] ?? "";
                        $_SESSION["ap_materno_voluntario"] = $datos["APELLIDOMATERNO"] ?? "";
                        
                        $_SESSION["esAdmin"] = false;
                    } else {
                        // Para admin solo sesión básica
                        $_SESSION["esAdmin"] = true;
                    }

                    $_SESSION["loggedin"] = true;
                    $_SESSION["usuario"] = $oUsu->getUsuario();
                    $_SESSION["rol"] = $oUsu->getRol();

                    header("Location: eventos.php");
                    exit;
                } else {
                    $mensaje = "Usuario o contraseña incorrectos.";
                }
            } catch (Exception $e) {
                $mensaje = "Error al conectar con la base de datos." . $e->getMessage();
            }
        }

        include("view/usuarios/login.php");
    }

    public function registrar() {
        $mensaje = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = trim($_POST["nombre"]);
            $apellidoPaterno = trim($_POST["apellidoPaterno"]);
            $apellidoMaterno = trim($_POST["apellidoMaterno"]);
            $correo = trim($_POST["correo"]);
            $sexo = $_POST["sexo"] ?? "";
            $telefono = trim($_POST["telefono"]);
            $password = $_POST["password"] ?? "";
            $confirm_password = $_POST["confirm_password"] ?? "";

            if (empty($nombre) || empty($apellidoPaterno) || empty($apellidoMaterno) || empty($correo) || empty($sexo) || empty($password) || empty($confirm_password)) {
                $mensaje = "Por favor, completa todos los campos requeridos.";
            } elseif ($password !== $confirm_password) {
                $mensaje = "Las contraseñas no coinciden.";
            } elseif (strlen($password) < 6) {
                $mensaje = "La contraseña debe tener al menos 6 caracteres.";
            } elseif (Usuario::correoExiste($correo)) {
                $mensaje = "Este correo ya está registrado. <a href='login.php'>Inicia sesión</a>.";
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $registrado = Usuario::registrar([
                    'NOMBRE' => $nombre,
                    'APELLIDOPATERNO' => $apellidoPaterno,
                    'APELLIDOMATERNO' => $apellidoMaterno,
                    'CORREO' => $correo,
                    'SEXO' => $sexo,
                    'TELEFONO' => $telefono,
                    'CONTRASENA' => $hashed_password
                ]);

                if ($registrado) {
                    // Al registrar, obtenemos los datos para la sesión
                    $datos = Usuario::obtenerPorCorreo($correo);
                    $_SESSION["id_voluntario"] = $datos["id"] ?? null;
                    $_SESSION["nombre_voluntario"] = $datos["NOMBRE"] ?? "";
                    $_SESSION["ap_paterno_voluntario"] = $datos["APELLIDOPATERNO"] ?? "";
                    $_SESSION["ap_materno_voluntario"] = $datos["APELLIDOMATERNO"] ?? "";
                    //$_SESSION["pais_voluntario"] = $datos["PAIS"] ?? "";

                    $_SESSION["loggedin"] = true;
                    $_SESSION["usuario"] = $correo;
                    $_SESSION["rol"] = "voluntario";
                    $_SESSION["esAdmin"] = false;

                    header("Location: eventos.php");
                    exit;
                } else {
                    $mensaje = "Error al registrar. Intenta nuevamente.";
                }
            }
        }

        include("view/usuarios/registrar.php");
    }

    // 
    public function index() {
        if (!($_SESSION["esAdmin"] ?? false)) {
            header("Location: index.php");
            exit;
        }

        $usuarios = Usuario::obtenerTodosVoluntarios();
        include("view/usuarios/lista.php");
    }

    //Edita la contraseña del usuario
    public function editar() {
        $id = $_GET["id"] ?? null;
        $usuarioLog = $_SESSION["usuario"] ?? "";
        $esAdmin = $_SESSION["esAdmin"] ?? false;

        if (!$id) {
            header("Location: usuarios.php");
            exit;
        }

        $usuario = Usuario::obtenerPorId($id);

        // Solo el dueño o el admin puede editar
        if (!$esAdmin && $usuario["CORREO"] !== $usuarioLog) {
            header("Location: usuarios.php");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nueva = $_POST["nueva"] ?? '';
            $confirmar = $_POST["confirmar"] ?? '';

            if ($nueva === $confirmar && strlen($nueva) >= 6) {
                Usuario::actualizarContrasena($id, $nueva);
                header("Location: usuarios.php");
                exit;
            } else {
                $error = "Las contraseñas no coinciden o son muy cortas.";
            }
        }

        include("view/usuarios/editar.php");
    }

    public function eliminar() {
        if (!($_SESSION["esAdmin"] ?? false)) {
            header("Location: index.php");
            exit;
        }

        $id = $_GET["id"] ?? null;
        if ($id) {
            Usuario::eliminar($id);
        }

        header("Location: usuarios.php");
        exit;
    }
}
