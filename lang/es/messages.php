<?php

return [

    'auth' => [
        'credentials_incorrect'  => 'El usuario o contraseña es incorrecto.',
        'user_inactive'          => 'El usuario está inactivo.',
        'session_started'        => 'Sesión iniciada correctamente.',
        'session_closed'         => 'Sesión cerrada correctamente.',
        'unauthorized'           => 'No autorizado.',
        'user_registered'        => 'Usuario registrado exitosamente.',
        'forgot_password_sent'   => 'Si el correo está registrado, recibirás un enlace para restablecer tu contraseña.',
        'password_reset_success' => 'Contraseña restablecida exitosamente.',
        'reset_token_invalid'    => 'El token de recuperación es inválido o ha expirado.',
    ],

    'two_factor' => [
        'already_enabled'    => 'El 2FA ya está habilitado y confirmado para esta cuenta.',
        'generated'          => '2FA generado. Pendiente de confirmación.',
        'scan_instruction'   => 'Escanea el código QR con Google Authenticator y luego verifica con POST /api/2fa/verify.',
        'not_configured'     => 'El 2FA no ha sido configurado. Primero llama a POST /api/2fa/enable.',
        'invalid_code'       => 'Código de verificación inválido o expirado.',
        'verified'           => '2FA verificado correctamente.',
    ],

    'general' => [
        'error_retry'       => 'Hubo un error, inténtalo de nuevo.',
        'validation_failed' => 'Los datos proporcionados no son válidos.',
        'record_not_found'  => 'Registro no encontrado.',
        'forbidden'         => 'No tienes permiso para realizar esta acción.',
    ],

    'user' => [
        'list_success'          => 'Usuarios obtenidos correctamente.',
        'role_not_found'        => 'El rol seleccionado no existe.',
        'created'               => 'Usuario creado exitosamente.',
        'create_error'          => 'Hubo un error al crear el usuario.',
        'show_success'          => 'Usuario obtenido correctamente.',
        'not_found'             => 'Usuario no encontrado.',
        'updated'               => 'Usuario actualizado exitosamente.',
        'update_error'          => 'Hubo un error al actualizar el usuario.',
        'delete_own_forbidden'  => 'No puedes eliminar tu propio usuario.',
        'deleted'               => 'Usuario eliminado exitosamente.',
        'delete_error'          => 'Hubo un error al eliminar el usuario.',
        'activated'             => 'Usuario activado exitosamente.',
        'deactivated'           => 'Usuario desactivado exitosamente.',
        'history_success'       => 'Historial del usuario obtenido correctamente.',
        'language_updated'      => 'Idioma del usuario actualizado exitosamente.',
        'permissions_success'   => 'Permisos del usuario obtenidos correctamente.',
        'permissions_synced'    => 'Permisos sincronizados exitosamente.',
        'roles_synced'          => 'Roles sincronizados exitosamente.',
    ],

    'role' => [
        'list_success'        => 'Roles obtenidos correctamente.',
        'show_success'        => 'Rol obtenido correctamente.',
        'not_found'           => 'Rol no encontrado.',
        'created'             => 'Rol creado exitosamente.',
        'updated'             => 'Rol actualizado exitosamente.',
        'deleted'             => 'Rol eliminado exitosamente.',
        'activated'           => 'Rol activado exitosamente.',
        'deactivated'         => 'Rol desactivado exitosamente.',
        'permissions_success' => 'Permisos obtenidos correctamente.',
        'permissions_synced'  => 'Permisos del rol sincronizados exitosamente.',
        'has_users'           => 'El rol tiene usuarios asignados y no puede eliminarse.',
    ],

    'permission' => [
        'list_success' => 'Permisos obtenidos correctamente.',
        'show_success' => 'Permiso obtenido correctamente.',
        'not_found'    => 'Permiso no encontrado.',
    ],

    'menu' => [
        'hierarchical_success' => 'Menú jerárquico obtenido correctamente.',
        'list_success'         => 'Menús obtenidos correctamente.',
        'parent_not_found'     => 'El menú padre especificado no existe.',
        'created'              => 'Menú creado correctamente.',
        'show_success'         => 'Menú obtenido correctamente.',
        'updated'              => 'Menú actualizado correctamente.',
        'has_submenus'         => 'No se puede eliminar un menú que contiene submenús.',
        'deleted'              => 'Menú eliminado correctamente.',
        'by_system_success'    => 'Menús del sistema obtenidos correctamente.',
    ],

];
