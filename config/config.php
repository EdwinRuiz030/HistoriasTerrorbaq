<?php
// Configuración de la base de datos para página de historias de terror
define("HOST", "localhost");//Servidor donde se aloja la base de datos
define("DB", "historias_terror_db");//Nombre de la base de datos para historias de terror
define("USER", "root");//Usuario de la base de datos
define("PASSWORD", "");//Contraseña de usuario de la base de datos
define("CHARSET", "utf8");//Codificación de caracteres.

// Configuración de la aplicación de historias de terror
define("BASE_URL", "/" . basename(dirname(__DIR__)) . "/"); // Ruta base de la aplicación
define("URL", "http://" . $_SERVER['HTTP_HOST'] . "/" . basename(dirname(__DIR__)) . "/"); // URL completa

// Configuración de sesión para sitio de historias de terror
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 0); // Cambiar a 1 si usas HTTPS
ini_set('session.cookie_samesite', 'Lax');
ini_set('session.gc_maxlifetime', 3600); // 60 minutos - tiempo más largo para lectura de historias
ini_set('session.cookie_lifetime', 0); // La cookie de sesión expirará al cerrar el navegador

// Iniciar la sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Funciones para mensajes de terror efímeros (mensajes que aparecen y desaparecen como fantasmas)
function setFlashMessage($type, $message) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Inicializar el array de mensajes flash si no existe
    if (!isset($_SESSION['flash_messages'])) {
        $_SESSION['flash_messages'] = [];
    }
    
    // Agregar el mensaje al array
    $_SESSION['flash_messages'][] = [
        'type' => $type,
        'message' => $message,
        'timestamp' => time()
    ];
    
    // Mantener solo los mensajes de los últimos 5 minutos (para limpieza)
    $current_time = time();
    foreach ($_SESSION['flash_messages'] as $key => $msg) {
        if (($current_time - $msg['timestamp']) > 300) { // 5 minutos
            unset($_SESSION['flash_messages'][$key]);
        }
    }
    
    // Reindexar el array
    $_SESSION['flash_messages'] = array_values($_SESSION['flash_messages']);
}

// Función para obtener el primer mensaje de terror disponible
function getFlashMessage() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    if (!empty($_SESSION['flash_messages'])) {
        // Obtener el primer mensaje
        $flash = array_shift($_SESSION['flash_messages']);
        
        // Reindexar el array
        $_SESSION['flash_messages'] = array_values($_SESSION['flash_messages']);
        
        return $flash;
    }
    
    return null;
}

// Función para obtener todos los mensajes de terror y hacer que desaparezcan como niebla
function getAllFlashMessages() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    if (!empty($_SESSION['flash_messages'])) {
        $messages = $_SESSION['flash_messages'];
        $_SESSION['flash_messages'] = [];
        return $messages;
    }
    
    return [];
}

// Configuración específica para sitio de historias de terror
define("SITE_NAME", "Historias de Terror");
define("SITE_DESCRIPTION", "Las mejores historias de terror para mantenerte despierto toda la noche");
define("STORIES_PER_PAGE", 10); // Número de historias por página
define("MAX_COMMENT_LENGTH", 500); // Longitud máxima de comentarios
define("ALLOWED_IMAGE_TYPES", "jpg,jpeg,png,gif"); // Tipos de imagen permitidos
define("MAX_IMAGE_SIZE", 2 * 1024 * 1024); // 2MB máximo para imágenes

// Categorías de historias de terror disponibles
define("TERROR_CATEGORIES", [
    "fantasmas" => "Fantasmas y Apariciones",
    "psicologico" => "Terror Psicológico",
    "sobrenatural" => "Sobrenatural",
    "criaturas" => "Criaturas y Monstruos",
    "urbano" => "Leyendas Urbanas",
    "real" => "Basado en Hechos Reales"
]);

// Tipos de mensajes disponibles para el sistema de flash messages
define("MESSAGE_TYPES", [
    "success" => "Éxito",
    "error" => "Error",
    "warning" => "Advertencia",
    "info" => "Información",
    "terror" => "Mensaje de Terror" // Tipo especial para el sitio
]);
