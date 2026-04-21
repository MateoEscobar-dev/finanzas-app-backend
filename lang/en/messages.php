<?php

return [

    'auth' => [
        'credentials_incorrect'  => 'The username or password is incorrect.',
        'user_inactive'          => 'The user is inactive.',
        'session_started'        => 'Session started successfully.',
        'session_closed'         => 'Session closed successfully.',
        'unauthorized'           => 'Unauthorized.',
        'user_registered'        => 'User registered successfully.',
        'forgot_password_sent'   => 'If the email is registered, you will receive a link to reset your password.',
        'password_reset_success' => 'Password reset successfully.',
        'reset_token_invalid'    => 'The recovery token is invalid or has expired.',
    ],

    'two_factor' => [
        'already_enabled'    => '2FA is already enabled and confirmed for this account.',
        'generated'          => '2FA generated. Pending confirmation.',
        'scan_instruction'   => 'Scan the QR code with Google Authenticator, then verify with POST /api/2fa/verify.',
        'not_configured'     => '2FA has not been configured. Please call POST /api/2fa/enable first.',
        'invalid_code'       => 'Invalid or expired verification code.',
        'verified'           => '2FA verified successfully.',
    ],

    'general' => [
        'error_retry'       => 'There was an error, please try again.',
        'validation_failed' => 'The given data was invalid.',
        'record_not_found'  => 'Record not found.',
        'forbidden'         => 'You do not have permission to perform this action.',
    ],

    'user' => [
        'list_success'          => 'Users retrieved successfully.',
        'role_not_found'        => 'The selected role does not exist.',
        'created'               => 'User created successfully.',
        'create_error'          => 'There was an error creating the user.',
        'show_success'          => 'User retrieved successfully.',
        'not_found'             => 'User not found.',
        'updated'               => 'User updated successfully.',
        'update_error'          => 'There was an error updating the user.',
        'delete_own_forbidden'  => 'You cannot delete your own user.',
        'deleted'               => 'User deleted successfully.',
        'delete_error'          => 'There was an error deleting the user.',
        'activated'             => 'User activated successfully.',
        'deactivated'           => 'User deactivated successfully.',
        'history_success'       => 'User history retrieved successfully.',
        'language_updated'      => 'User language updated successfully.',
        'permissions_success'   => 'User permissions retrieved successfully.',
        'permissions_synced'    => 'Permissions synced successfully.',
        'roles_synced'          => 'Roles synced successfully.',
    ],

    'role' => [
        'list_success'        => 'Roles retrieved successfully.',
        'show_success'        => 'Role retrieved successfully.',
        'not_found'           => 'Role not found.',
        'created'             => 'Role created successfully.',
        'updated'             => 'Role updated successfully.',
        'deleted'             => 'Role deleted successfully.',
        'activated'           => 'Role activated successfully.',
        'deactivated'         => 'Role deactivated successfully.',
        'permissions_success' => 'Permissions retrieved successfully.',
        'permissions_synced'  => 'Role permissions synced successfully.',
        'has_users'           => 'The role has assigned users and cannot be deleted.',
    ],

    'permission' => [
        'list_success' => 'Permissions retrieved successfully.',
        'show_success' => 'Permission retrieved successfully.',
        'not_found'    => 'Permission not found.',
    ],

    'menu' => [
        'hierarchical_success' => 'Hierarchical menu retrieved successfully.',
        'list_success'         => 'Menus retrieved successfully.',
        'parent_not_found'     => 'The specified parent menu does not exist.',
        'created'              => 'Menu created successfully.',
        'show_success'         => 'Menu retrieved successfully.',
        'updated'              => 'Menu updated successfully.',
        'has_submenus'         => 'Cannot delete a menu that contains submenus.',
        'deleted'              => 'Menu deleted successfully.',
        'by_system_success'    => 'System menus retrieved successfully.',
    ],

];
