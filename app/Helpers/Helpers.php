<?php

function getNameIdiom()
{
    $configLanguage = config('languages')[session('applocale')];
    return $configLanguage[0];
}
// Función para limpiar el formato COP y convertirlo en número
function cleanNumber($value) {
    return (float) str_replace(['$', '.', ','], '', $value);
}
function transformNumber($value) {
    // Asegurar que es un número
    if (!is_numeric($value)) {
        return null;
    }

    // Formatear con separadores de miles (.) y sin decimales
    return '$ ' . number_format($value, 0, ',', '.');
}
