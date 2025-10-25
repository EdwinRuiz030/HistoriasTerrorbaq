<?php
/**
 * Archivo de configuración para sitio de Historias de Terror
 *
 * Este archivo contiene todas las configuraciones necesarias para el funcionamiento
 * del sitio web de historias de terror. Incluye configuración de base de datos,
 * sesiones, URLs y funciones de mensajería.
 *
 * Uso básico:
 *
 * // Acceder a constantes de configuración
 * echo SITE_NAME; // Muestra: "Historias de Terror"
 * echo DB; // Muestra: "historias_terror_db"
 *
 * // Usar funciones de mensajes flash
 * setFlashMessage('success', 'Historia guardada exitosamente');
 * setFlashMessage('terror', '¡Cuidado! Esta historia es realmente aterradora');
 *
 * // Obtener categorías disponibles
 * $categorias = TERROR_CATEGORIES;
 * foreach($categorias as $key => $nombre) {
 *     echo "<option value='$key'>$nombre</option>";
 * }
 *
 * @version 1.0
 * @author Configuración adaptada para HistoriasTerrorbaq
 */

// Verificar que el archivo se está incluyendo correctamente
if (!defined('SITE_NAME')) {
    die('Error: Configuración no cargada correctamente');
}
?>
