# Introduction

API REST del sistema de finanzas personales. Proporciona endpoints para autenticación, gestión de usuarios, menús y roles con permisos granulares.

<aside>
    <strong>Base URL</strong>: <code>http://localhost</code>
</aside>

    Esta documentación describe todos los endpoints disponibles en la API del sistema de finanzas.

    ## Autenticación

    La mayoría de los endpoints requieren autenticación mediante **Bearer Token** (Laravel Sanctum).
    Para obtener un token, utiliza el endpoint `/api/login`. Luego incluye el token en el header:

    ```
    Authorization: Bearer {tu_token}
    ```

    ## Encriptación de contraseñas

    Las contraseñas se envían **encriptadas en AES-256-CBC** desde el cliente (CryptoJS).
    No envíes contraseñas en texto plano.

    ## Rate Limiting

    - Login: máximo 5 intentos por minuto.
    - Registro / recuperación de contraseña: máximo 3 intentos por minuto.

    <aside>Desplázate para ver ejemplos de código en diferentes lenguajes en el panel derecho.</aside>

