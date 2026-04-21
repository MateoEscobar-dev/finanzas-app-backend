<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Laravel API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://localhost";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.9.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.9.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-autenticacion" class="tocify-header">
                <li class="tocify-item level-1" data-unique="autenticacion">
                    <a href="#autenticacion">Autenticación</a>
                </li>
                                    <ul id="tocify-subheader-autenticacion" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="autenticacion-POSTapi-login">
                                <a href="#autenticacion-POSTapi-login">Iniciar sesión</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="autenticacion-POSTapi-register">
                                <a href="#autenticacion-POSTapi-register">Registrar nuevo usuario</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="autenticacion-POSTapi-forgot-password">
                                <a href="#autenticacion-POSTapi-forgot-password">Recuperar contraseña</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="autenticacion-POSTapi-reset-password">
                                <a href="#autenticacion-POSTapi-reset-password">Restablecer contraseña</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="autenticacion-POSTapi-logout">
                                <a href="#autenticacion-POSTapi-logout">Cerrar sesión</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="autenticacion-GETapi-me">
                                <a href="#autenticacion-GETapi-me">Obtener usuario autenticado</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-autenticacion-de-dos-factores-2fa" class="tocify-header">
                <li class="tocify-item level-1" data-unique="autenticacion-de-dos-factores-2fa">
                    <a href="#autenticacion-de-dos-factores-2fa">Autenticación de Dos Factores (2FA)</a>
                </li>
                                    <ul id="tocify-subheader-autenticacion-de-dos-factores-2fa" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="autenticacion-de-dos-factores-2fa-POSTapi-2fa-enable">
                                <a href="#autenticacion-de-dos-factores-2fa-POSTapi-2fa-enable">Habilitar autenticación de dos factores</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="autenticacion-de-dos-factores-2fa-POSTapi-2fa-verify">
                                <a href="#autenticacion-de-dos-factores-2fa-POSTapi-2fa-verify">Verificar código de dos factores</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-usuarios" class="tocify-header">
                <li class="tocify-item level-1" data-unique="usuarios">
                    <a href="#usuarios">Usuarios</a>
                </li>
                                    <ul id="tocify-subheader-usuarios" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="usuarios-GETapi-users">
                                <a href="#usuarios-GETapi-users">Listar usuarios</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="usuarios-POSTapi-users">
                                <a href="#usuarios-POSTapi-users">Crear usuario</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="usuarios-GETapi-users--id-">
                                <a href="#usuarios-GETapi-users--id-">Obtener usuario</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="usuarios-PUTapi-users--id-">
                                <a href="#usuarios-PUTapi-users--id-">Actualizar usuario</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="usuarios-DELETEapi-users--id-">
                                <a href="#usuarios-DELETEapi-users--id-">Eliminar usuario</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="usuarios-POSTapi-users--id--activate">
                                <a href="#usuarios-POSTapi-users--id--activate">Activar usuario</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="usuarios-POSTapi-users--id--deactivate">
                                <a href="#usuarios-POSTapi-users--id--deactivate">Desactivar usuario</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="usuarios-GETapi-users--id--history">
                                <a href="#usuarios-GETapi-users--id--history">Historial del usuario</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="usuarios-POSTapi-users--id--language">
                                <a href="#usuarios-POSTapi-users--id--language">Actualizar idioma del usuario</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="usuarios-GETapi-users--id--permissions">
                                <a href="#usuarios-GETapi-users--id--permissions">Permisos del usuario</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="usuarios-POSTapi-users--id--permissions">
                                <a href="#usuarios-POSTapi-users--id--permissions">Sincronizar permisos directos del usuario</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="usuarios-POSTapi-users--id--roles">
                                <a href="#usuarios-POSTapi-users--id--roles">Asignar roles al usuario</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-menu" class="tocify-header">
                <li class="tocify-item level-1" data-unique="menu">
                    <a href="#menu">Menú</a>
                </li>
                                    <ul id="tocify-subheader-menu" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="menu-GETapi-menu-hierarchical">
                                <a href="#menu-GETapi-menu-hierarchical">Menú jerárquico</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="menu-GETapi-menu-by-system--idSistema-">
                                <a href="#menu-GETapi-menu-by-system--idSistema-">Menús por sistema</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="menu-GETapi-menu">
                                <a href="#menu-GETapi-menu">Listar menús</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="menu-POSTapi-menu">
                                <a href="#menu-POSTapi-menu">Crear menú</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="menu-GETapi-menu--id-">
                                <a href="#menu-GETapi-menu--id-">Obtener menú</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="menu-PUTapi-menu--id-">
                                <a href="#menu-PUTapi-menu--id-">Actualizar menú</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="menu-DELETEapi-menu--id-">
                                <a href="#menu-DELETEapi-menu--id-">Eliminar menú</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-roles-y-permisos" class="tocify-header">
                <li class="tocify-item level-1" data-unique="roles-y-permisos">
                    <a href="#roles-y-permisos">Roles y Permisos</a>
                </li>
                                    <ul id="tocify-subheader-roles-y-permisos" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="roles-y-permisos-GETapi-roles">
                                <a href="#roles-y-permisos-GETapi-roles">Listar roles</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="roles-y-permisos-POSTapi-roles">
                                <a href="#roles-y-permisos-POSTapi-roles">Crear rol</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="roles-y-permisos-GETapi-roles--id-">
                                <a href="#roles-y-permisos-GETapi-roles--id-">Obtener rol</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="roles-y-permisos-PUTapi-roles--id-">
                                <a href="#roles-y-permisos-PUTapi-roles--id-">Actualizar rol</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="roles-y-permisos-DELETEapi-roles--id-">
                                <a href="#roles-y-permisos-DELETEapi-roles--id-">Eliminar rol</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="roles-y-permisos-POSTapi-roles--id--activate">
                                <a href="#roles-y-permisos-POSTapi-roles--id--activate">Activar rol</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="roles-y-permisos-POSTapi-roles--id--deactivate">
                                <a href="#roles-y-permisos-POSTapi-roles--id--deactivate">Desactivar rol</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="roles-y-permisos-POSTapi-roles--id--permissions">
                                <a href="#roles-y-permisos-POSTapi-roles--id--permissions">Sincronizar permisos del rol</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-permisos" class="tocify-header">
                <li class="tocify-item level-1" data-unique="permisos">
                    <a href="#permisos">Permisos</a>
                </li>
                                    <ul id="tocify-subheader-permisos" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="permisos-GETapi-permissions">
                                <a href="#permisos-GETapi-permissions">Listar permisos</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="permisos-GETapi-permissions--id-">
                                <a href="#permisos-GETapi-permissions--id-">Obtener permiso</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: April 21, 2026</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<p>API REST del sistema de finanzas personales. Proporciona endpoints para autenticación, gestión de usuarios, menús y roles con permisos granulares.</p>
<aside>
    <strong>Base URL</strong>: <code>http://localhost</code>
</aside>
<pre><code>Esta documentación describe todos los endpoints disponibles en la API del sistema de finanzas.

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

&lt;aside&gt;Desplázate para ver ejemplos de código en diferentes lenguajes en el panel derecho.&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>To authenticate requests, include an <strong><code>Authorization</code></strong> header with the value <strong><code>"Bearer {BEARER_TOKEN}"</code></strong>.</p>
<p>All authenticated endpoints are marked with a <code>requires authentication</code> badge in the documentation below.</p>
<p>Obtén tu token autenticándote en <code>POST /api/login</code> e inclúyelo como <b>Bearer Token</b> en el header <code>Authorization</code>.</p>

        <h1 id="autenticacion">Autenticación</h1>

    

                                <h2 id="autenticacion-POSTapi-login">Iniciar sesión</h2>

<p>
</p>

<p>Autentica al usuario con sus credenciales y devuelve un Bearer Token de Sanctum.
Si el usuario tiene 2FA activo, el campo <code>requires_2fa</code> será <code>true</code> y deberá
verificarse en <code>POST /api/2fa/verify</code> antes de acceder a recursos protegidos.</p>

<span id="example-requests-POSTapi-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"usuario@ejemplo.com\",
    \"password\": \"U2FsdGVkX1+abc123...\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "usuario@ejemplo.com",
    "password": "U2FsdGVkX1+abc123..."
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-login">
            <blockquote>
            <p>Example response (200, Sesión iniciada):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Sesi&oacute;n iniciada correctamente&quot;,
    &quot;data&quot;: {
        &quot;token&quot;: &quot;1|aBcDeFgHiJkLmN...&quot;,
        &quot;token_type&quot;: &quot;Bearer&quot;,
        &quot;requires_2fa&quot;: false,
        &quot;user&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Juan P&eacute;rez&quot;,
            &quot;email&quot;: &quot;usuario@ejemplo.com&quot;,
            &quot;first_name&quot;: &quot;Juan&quot;,
            &quot;second_name&quot;: null,
            &quot;first_last_name&quot;: &quot;P&eacute;rez&quot;,
            &quot;second_last_name&quot;: null,
            &quot;phone&quot;: &quot;****&quot;,
            &quot;phone_ext&quot;: null,
            &quot;active&quot;: 1,
            &quot;imagen&quot;: null,
            &quot;lang&quot;: &quot;es&quot;,
            &quot;has_2fa&quot;: false,
            &quot;roles&quot;: [
                &quot;User&quot;
            ],
            &quot;permissions&quot;: [
                &quot;ver-usuarios&quot;
            ]
        }
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (200, 2FA requerido):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Sesi&oacute;n iniciada correctamente&quot;,
    &quot;data&quot;: {
        &quot;token&quot;: &quot;2|xYzAbC...&quot;,
        &quot;token_type&quot;: &quot;Bearer&quot;,
        &quot;requires_2fa&quot;: true,
        &quot;user&quot;: {
            &quot;id&quot;: 2,
            &quot;name&quot;: &quot;Mar&iacute;a L&oacute;pez&quot;,
            &quot;email&quot;: &quot;maria@ejemplo.com&quot;
        }
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Credenciales incorrectas):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Las credenciales son incorrectas&quot;,
    &quot;errors&quot;: &quot;&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Usuario inactivo):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;El usuario se encuentra inactivo&quot;,
    &quot;errors&quot;: &quot;&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Validación fallida):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Los datos proporcionados no son v&aacute;lidos&quot;,
    &quot;errors&quot;: {
        &quot;email&quot;: [
            &quot;El correo electr&oacute;nico es obligatorio.&quot;
        ]
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (429, Demasiados intentos):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Too Many Requests&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-login"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-login">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-login" data-method="POST"
      data-path="api/login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-login"
                    onclick="tryItOut('POSTapi-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-login"
                    onclick="cancelTryOut('POSTapi-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-login"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-login"
               value="usuario@ejemplo.com"
               data-component="body">
    <br>
<p>Correo electrónico registrado. Example: <code>usuario@ejemplo.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-login"
               value="U2FsdGVkX1+abc123..."
               data-component="body">
    <br>
<p>Contraseña encriptada en AES-256-CBC (CryptoJS). No envíar en texto plano. Example: <code>U2FsdGVkX1+abc123...</code></p>
        </div>
        </form>

                    <h2 id="autenticacion-POSTapi-register">Registrar nuevo usuario</h2>

<p>
</p>

<p>Crea una nueva cuenta de usuario en el sistema. El usuario recibe automáticamente
el rol <code>User</code> y un Bearer Token listo para usar.
La contraseña debe enviarse encriptada en AES-256-CBC.</p>

<span id="example-requests-POSTapi-register">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/register" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"document\": \"12345678\",
    \"first_name\": \"Juan\",
    \"second_name\": \"Carlos\",
    \"first_last_name\": \"Pérez\",
    \"second_last_name\": \"Gómez\",
    \"email\": \"nuevo@ejemplo.com\",
    \"password\": \"U2FsdGVkX1+xyz...\",
    \"phone\": \"+573001234567\",
    \"phone_ext\": \"101\",
    \"birth_day\": \"1990-05-15\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/register"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "document": "12345678",
    "first_name": "Juan",
    "second_name": "Carlos",
    "first_last_name": "Pérez",
    "second_last_name": "Gómez",
    "email": "nuevo@ejemplo.com",
    "password": "U2FsdGVkX1+xyz...",
    "phone": "+573001234567",
    "phone_ext": "101",
    "birth_day": "1990-05-15"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-register">
            <blockquote>
            <p>Example response (201, Usuario creado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Usuario registrado exitosamente&quot;,
    &quot;data&quot;: {
        &quot;token&quot;: &quot;3|pQrStUvW...&quot;,
        &quot;token_type&quot;: &quot;Bearer&quot;,
        &quot;user&quot;: {
            &quot;id&quot;: 5,
            &quot;name&quot;: &quot;Juan P&eacute;rez&quot;,
            &quot;email&quot;: &quot;nuevo@ejemplo.com&quot;,
            &quot;first_name&quot;: &quot;Juan&quot;,
            &quot;second_name&quot;: &quot;Carlos&quot;,
            &quot;first_last_name&quot;: &quot;P&eacute;rez&quot;,
            &quot;second_last_name&quot;: &quot;G&oacute;mez&quot;,
            &quot;phone&quot;: &quot;****&quot;,
            &quot;active&quot;: 1,
            &quot;lang&quot;: &quot;es&quot;,
            &quot;has_2fa&quot;: false,
            &quot;roles&quot;: [
                &quot;User&quot;
            ],
            &quot;permissions&quot;: []
        }
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Validación fallida):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Los datos proporcionados no son v&aacute;lidos&quot;,
    &quot;errors&quot;: {
        &quot;email&quot;: [
            &quot;El correo electr&oacute;nico ya est&aacute; registrado.&quot;
        ]
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (429, Demasiados intentos):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Too Many Requests&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-register" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-register"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-register"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-register">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-register" data-method="POST"
      data-path="api/register"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-register', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-register"
                    onclick="tryItOut('POSTapi-register');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-register"
                    onclick="cancelTryOut('POSTapi-register');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-register"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/register</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>document</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="document"                data-endpoint="POSTapi-register"
               value="12345678"
               data-component="body">
    <br>
<p>Número de documento de identidad (único, máx. 20 caracteres). Example: <code>12345678</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>first_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="first_name"                data-endpoint="POSTapi-register"
               value="Juan"
               data-component="body">
    <br>
<p>Primer nombre (máx. 100 caracteres). Example: <code>Juan</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>second_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="second_name"                data-endpoint="POSTapi-register"
               value="Carlos"
               data-component="body">
    <br>
<p>Segundo nombre (opcional, máx. 100 caracteres). Example: <code>Carlos</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>first_last_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="first_last_name"                data-endpoint="POSTapi-register"
               value="Pérez"
               data-component="body">
    <br>
<p>Primer apellido (máx. 100 caracteres). Example: <code>Pérez</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>second_last_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="second_last_name"                data-endpoint="POSTapi-register"
               value="Gómez"
               data-component="body">
    <br>
<p>Segundo apellido (opcional, máx. 100 caracteres). Example: <code>Gómez</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-register"
               value="nuevo@ejemplo.com"
               data-component="body">
    <br>
<p>Correo electrónico válido y único (último máx. 255 caracteres). Example: <code>nuevo@ejemplo.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-register"
               value="U2FsdGVkX1+xyz..."
               data-component="body">
    <br>
<p>Contraseña encriptada AES-256-CBC (mínimo 8 caracteres, 1 mayúscula, 1 número, 1 especial). Example: <code>U2FsdGVkX1+xyz...</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="POSTapi-register"
               value="+573001234567"
               data-component="body">
    <br>
<p>Teléfono en formato E.164 (ej: +573001234567). Example: <code>+573001234567</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone_ext</code></b>&nbsp;&nbsp;
<small>numeric</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone_ext"                data-endpoint="POSTapi-register"
               value="101"
               data-component="body">
    <br>
<p>Extensión telefónica (opcional, 1-10 dígitos). Example: <code>101</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>birth_day</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="birth_day"                data-endpoint="POSTapi-register"
               value="1990-05-15"
               data-component="body">
    <br>
<p>Fecha de nacimiento en formato YYYY-MM-DD. Debe ser mayor de 18 años. Example: <code>1990-05-15</code></p>
        </div>
        </form>

                    <h2 id="autenticacion-POSTapi-forgot-password">Recuperar contraseña</h2>

<p>
</p>

<p>Envía un enlace de recuperación al correo registrado.
La respuesta es genérica para no revelar si el email existe en el sistema.</p>

<span id="example-requests-POSTapi-forgot-password">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/forgot-password" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"usuario@ejemplo.com\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/forgot-password"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "usuario@ejemplo.com"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-forgot-password">
            <blockquote>
            <p>Example response (200, Enlace enviado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Si el correo est&aacute; registrado, recibir&aacute;s un enlace de recuperaci&oacute;n&quot;,
    &quot;data&quot;: []
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Validación fallida):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Los datos proporcionados no son v&aacute;lidos&quot;,
    &quot;errors&quot;: {
        &quot;email&quot;: [
            &quot;El correo electr&oacute;nico es obligatorio.&quot;
        ]
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (429, Demasiados intentos):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Too Many Requests&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-forgot-password" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-forgot-password"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-forgot-password"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-forgot-password" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-forgot-password">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-forgot-password" data-method="POST"
      data-path="api/forgot-password"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-forgot-password', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-forgot-password"
                    onclick="tryItOut('POSTapi-forgot-password');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-forgot-password"
                    onclick="cancelTryOut('POSTapi-forgot-password');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-forgot-password"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/forgot-password</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-forgot-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-forgot-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-forgot-password"
               value="usuario@ejemplo.com"
               data-component="body">
    <br>
<p>Correo electrónico asociado a la cuenta. Example: <code>usuario@ejemplo.com</code></p>
        </div>
        </form>

                    <h2 id="autenticacion-POSTapi-reset-password">Restablecer contraseña</h2>

<p>
</p>

<p>Restablece la contraseña del usuario usando el token enviado por correo.
Todos los tokens de sesión son invalidados tras el reset exitoso.
La nueva contraseña debe enviarse encriptada en AES-256-CBC.</p>

<span id="example-requests-POSTapi-reset-password">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/reset-password" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"token\": \"a1b2c3d4e5f6...\",
    \"email\": \"usuario@ejemplo.com\",
    \"password\": \"U2FsdGVkX1+newpass...\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/reset-password"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "token": "a1b2c3d4e5f6...",
    "email": "usuario@ejemplo.com",
    "password": "U2FsdGVkX1+newpass..."
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-reset-password">
            <blockquote>
            <p>Example response (200, Contraseña restablecida):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Contrase&ntilde;a restablecida exitosamente&quot;,
    &quot;data&quot;: []
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Token inválido o expirado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;El token de recuperaci&oacute;n es inv&aacute;lido o ha expirado&quot;,
    &quot;errors&quot;: &quot;&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Validación fallida):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Los datos proporcionados no son v&aacute;lidos&quot;,
    &quot;errors&quot;: {
        &quot;token&quot;: [
            &quot;El token es obligatorio.&quot;
        ]
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (429, Demasiados intentos):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Too Many Requests&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-reset-password" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-reset-password"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-reset-password"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-reset-password" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-reset-password">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-reset-password" data-method="POST"
      data-path="api/reset-password"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-reset-password', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-reset-password"
                    onclick="tryItOut('POSTapi-reset-password');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-reset-password"
                    onclick="cancelTryOut('POSTapi-reset-password');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-reset-password"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/reset-password</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-reset-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-reset-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>token</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="token"                data-endpoint="POSTapi-reset-password"
               value="a1b2c3d4e5f6..."
               data-component="body">
    <br>
<p>Token de recuperación recibido por correo. Example: <code>a1b2c3d4e5f6...</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-reset-password"
               value="usuario@ejemplo.com"
               data-component="body">
    <br>
<p>Correo electrónico de la cuenta. Example: <code>usuario@ejemplo.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-reset-password"
               value="U2FsdGVkX1+newpass..."
               data-component="body">
    <br>
<p>Nueva contraseña encriptada AES-256-CBC. Example: <code>U2FsdGVkX1+newpass...</code></p>
        </div>
        </form>

                    <h2 id="autenticacion-POSTapi-logout">Cerrar sesión</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Invalida el token de acceso actual del usuario autenticado.
Para cerrar todas las sesiones activas en todos los dispositivos,
usar el endpoint de eliminación de todos los tokens.</p>

<span id="example-requests-POSTapi-logout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/logout" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/logout"
);

const headers = {
    "Authorization": "Bearer {BEARER_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-logout">
            <blockquote>
            <p>Example response (200, Sesión cerrada):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Sesi&oacute;n cerrada correctamente&quot;,
    &quot;data&quot;: []
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, No autenticado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-logout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-logout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-logout"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-logout">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-logout" data-method="POST"
      data-path="api/logout"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-logout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-logout"
                    onclick="tryItOut('POSTapi-logout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-logout"
                    onclick="cancelTryOut('POSTapi-logout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-logout"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/logout</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-logout"
               value="Bearer {BEARER_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {BEARER_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="autenticacion-GETapi-me">Obtener usuario autenticado</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retorna los datos del usuario actualmente autenticado, incluyendo
sus roles, permisos y estado del 2FA.</p>

<span id="example-requests-GETapi-me">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/me" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/me"
);

const headers = {
    "Authorization": "Bearer {BEARER_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-me">
            <blockquote>
            <p>Example response (200, Datos del usuario):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Sesi&oacute;n iniciada correctamente&quot;,
    &quot;data&quot;: {
        &quot;user&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Juan P&eacute;rez&quot;,
            &quot;email&quot;: &quot;usuario@ejemplo.com&quot;,
            &quot;first_name&quot;: &quot;Juan&quot;,
            &quot;second_name&quot;: null,
            &quot;first_last_name&quot;: &quot;P&eacute;rez&quot;,
            &quot;second_last_name&quot;: null,
            &quot;phone&quot;: &quot;****&quot;,
            &quot;phone_ext&quot;: null,
            &quot;active&quot;: 1,
            &quot;imagen&quot;: null,
            &quot;lang&quot;: &quot;es&quot;,
            &quot;has_2fa&quot;: false,
            &quot;roles&quot;: [
                &quot;Admin&quot;
            ],
            &quot;permissions&quot;: [
                &quot;ver-usuarios&quot;,
                &quot;crear-usuarios&quot;
            ]
        }
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, No autenticado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-me" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-me"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-me"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-me" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-me">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-me" data-method="GET"
      data-path="api/me"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-me', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-me"
                    onclick="tryItOut('GETapi-me');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-me"
                    onclick="cancelTryOut('GETapi-me');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-me"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/me</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-me"
               value="Bearer {BEARER_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {BEARER_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-me"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-me"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="autenticacion-de-dos-factores-2fa">Autenticación de Dos Factores (2FA)</h1>

    

                                <h2 id="autenticacion-de-dos-factores-2fa-POSTapi-2fa-enable">Habilitar autenticación de dos factores</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Genera un secreto TOTP y devuelve la URL del código QR y la clave manual
para configurar una app autenticadora (Google Authenticator, Authy, etc.).
El 2FA no queda activo hasta que se verifique un código con <code>POST /api/2fa/verify</code>.</p>

<span id="example-requests-POSTapi-2fa-enable">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/2fa/enable" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/2fa/enable"
);

const headers = {
    "Authorization": "Bearer {BEARER_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-2fa-enable">
            <blockquote>
            <p>Example response (200, Secreto generado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Secreto 2FA generado. Escanea el QR con tu app autenticadora.&quot;,
    &quot;data&quot;: {
        &quot;qr_code_url&quot;: &quot;data:image/png;base64,iVBORw0KGgo...&quot;,
        &quot;manual_entry_key&quot;: &quot;JBSWY3DPEHPK3PXP&quot;,
        &quot;message&quot;: &quot;Escanea el c&oacute;digo QR con Google Authenticator o ingresa la clave manualmente.&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, No autenticado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (409, 2FA ya está activo):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;La autenticaci&oacute;n de dos factores ya est&aacute; habilitada&quot;,
    &quot;errors&quot;: &quot;&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-2fa-enable" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-2fa-enable"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-2fa-enable"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-2fa-enable" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-2fa-enable">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-2fa-enable" data-method="POST"
      data-path="api/2fa/enable"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-2fa-enable', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-2fa-enable"
                    onclick="tryItOut('POSTapi-2fa-enable');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-2fa-enable"
                    onclick="cancelTryOut('POSTapi-2fa-enable');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-2fa-enable"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/2fa/enable</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-2fa-enable"
               value="Bearer {BEARER_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {BEARER_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-2fa-enable"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-2fa-enable"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="autenticacion-de-dos-factores-2fa-POSTapi-2fa-verify">Verificar código de dos factores</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Verifica el código TOTP de 6 dígitos generado por la app autenticadora.
Si el 2FA aún no estaba confirmado, lo activa en este paso.
Devuelve un nuevo Bearer Token con acceso completo.</p>

<span id="example-requests-POSTapi-2fa-verify">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/2fa/verify" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"code\": \"123456\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/2fa/verify"
);

const headers = {
    "Authorization": "Bearer {BEARER_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "code": "123456"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-2fa-verify">
            <blockquote>
            <p>Example response (200, Código válido):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Autenticaci&oacute;n de dos factores verificada&quot;,
    &quot;data&quot;: {
        &quot;token&quot;: &quot;4|dEfGhIjK...&quot;,
        &quot;token_type&quot;: &quot;Bearer&quot;,
        &quot;verified&quot;: true
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, No autenticado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Código inválido):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;El c&oacute;digo ingresado es incorrecto&quot;,
    &quot;errors&quot;: &quot;&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, 2FA no configurado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;El 2FA no ha sido configurado. Usa POST /api/2fa/enable primero.&quot;,
    &quot;errors&quot;: &quot;&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Validación fallida):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Los datos proporcionados no son v&aacute;lidos&quot;,
    &quot;errors&quot;: {
        &quot;code&quot;: [
            &quot;El campo code debe tener 6 d&iacute;gitos.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-2fa-verify" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-2fa-verify"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-2fa-verify"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-2fa-verify" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-2fa-verify">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-2fa-verify" data-method="POST"
      data-path="api/2fa/verify"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-2fa-verify', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-2fa-verify"
                    onclick="tryItOut('POSTapi-2fa-verify');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-2fa-verify"
                    onclick="cancelTryOut('POSTapi-2fa-verify');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-2fa-verify"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/2fa/verify</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-2fa-verify"
               value="Bearer {BEARER_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {BEARER_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-2fa-verify"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-2fa-verify"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="code"                data-endpoint="POSTapi-2fa-verify"
               value="123456"
               data-component="body">
    <br>
<p>Código TOTP de 6 dígitos de la app autenticadora. Example: <code>123456</code></p>
        </div>
        </form>

                <h1 id="usuarios">Usuarios</h1>

    

                                <h2 id="usuarios-GETapi-users">Listar usuarios</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retorna una lista paginada de usuarios del sistema.
Soporta búsqueda por nombre, email o documento.</p>

<span id="example-requests-GETapi-users">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/users?take=10&amp;skip=0&amp;search=Juan" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/users"
);

const params = {
    "take": "10",
    "skip": "0",
    "search": "Juan",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer {BEARER_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-users">
            <blockquote>
            <p>Example response (200, Lista de usuarios):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Success&quot;,
    &quot;message&quot;: &quot;Usuarios obtenidos exitosamente&quot;,
    &quot;data&quot;: {
        &quot;records&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Juan P&eacute;rez&quot;,
                &quot;email&quot;: &quot;usuario@ejemplo.com&quot;,
                &quot;active&quot;: 1,
                &quot;roles&quot;: [
                    {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Administrator&quot;
                    }
                ]
            }
        ],
        &quot;pagination&quot;: {
            &quot;total&quot;: 50,
            &quot;take&quot;: 10,
            &quot;skip&quot;: 0,
            &quot;pages&quot;: 5,
            &quot;current_page&quot;: 1
        }
    },
    &quot;code&quot;: 200
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, No autenticado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Sin permiso):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;No tienes permiso para realizar esta acci&oacute;n.&quot;,
    &quot;code&quot;: 403
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-users" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-users"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-users"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-users" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-users">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-users" data-method="GET"
      data-path="api/users"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-users', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-users"
                    onclick="tryItOut('GETapi-users');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-users"
                    onclick="cancelTryOut('GETapi-users');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-users"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/users</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-users"
               value="Bearer {BEARER_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {BEARER_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>take</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="take"                data-endpoint="GETapi-users"
               value="10"
               data-component="query">
    <br>
<p>Número de registros a retornar (1-100). Por defecto: 10. Example: <code>10</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>skip</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="skip"                data-endpoint="GETapi-users"
               value="0"
               data-component="query">
    <br>
<p>Número de registros a saltar (offset). Por defecto: 0. Example: <code>0</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>search</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="search"                data-endpoint="GETapi-users"
               value="Juan"
               data-component="query">
    <br>
<p>Término de búsqueda (nombre, email o documento). Example: <code>Juan</code></p>
            </div>
                </form>

                    <h2 id="usuarios-POSTapi-users">Crear usuario</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Crea un nuevo usuario en el sistema y le asigna los roles indicados.
La contraseña debe enviarse encriptada en AES-256-CBC.</p>

<span id="example-requests-POSTapi-users">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/users" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"document\": \"1036961469\",
    \"first_name\": \"Harol\",
    \"second_name\": \"Mateo\",
    \"first_last_name\": \"Escobar\",
    \"second_last_name\": \"Correa\",
    \"email\": \"mateo@ejemplo.com\",
    \"password\": \"{\\\"salt\\\":\\\"...\\\",\\\"iv\\\":\\\"...\\\",\\\"ciphertext\\\":\\\"...\\\"}\",
    \"phone\": \"+573138853031\",
    \"phone_ext\": \"124\",
    \"birth_day\": \"1997-10-20\",
    \"address\": \"n\",
    \"lang\": \"es\",
    \"roles\": [
        1,
        2
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/users"
);

const headers = {
    "Authorization": "Bearer {BEARER_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "document": "1036961469",
    "first_name": "Harol",
    "second_name": "Mateo",
    "first_last_name": "Escobar",
    "second_last_name": "Correa",
    "email": "mateo@ejemplo.com",
    "password": "{\"salt\":\"...\",\"iv\":\"...\",\"ciphertext\":\"...\"}",
    "phone": "+573138853031",
    "phone_ext": "124",
    "birth_day": "1997-10-20",
    "address": "n",
    "lang": "es",
    "roles": [
        1,
        2
    ]
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-users">
            <blockquote>
            <p>Example response (201, Usuario creado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Success&quot;,
    &quot;message&quot;: &quot;Usuario creado exitosamente&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 10,
        &quot;name&quot;: &quot;Harol Escobar&quot;
    },
    &quot;code&quot;: 201
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Sin permiso):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;No tienes permiso para realizar esta acci&oacute;n.&quot;,
    &quot;code&quot;: 403
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Validación fallida):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;Los datos proporcionados no son v&aacute;lidos&quot;,
    &quot;errors&quot;: {
        &quot;email&quot;: [
            &quot;El correo electr&oacute;nico ya est&aacute; registrado.&quot;
        ]
    },
    &quot;code&quot;: 422
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-users" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-users"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-users"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-users" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-users">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-users" data-method="POST"
      data-path="api/users"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-users', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-users"
                    onclick="tryItOut('POSTapi-users');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-users"
                    onclick="cancelTryOut('POSTapi-users');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-users"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/users</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-users"
               value="Bearer {BEARER_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {BEARER_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>document</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="document"                data-endpoint="POSTapi-users"
               value="1036961469"
               data-component="body">
    <br>
<p>Documento de identidad (único, máx. 20 caracteres). Example: <code>1036961469</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>first_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="first_name"                data-endpoint="POSTapi-users"
               value="Harol"
               data-component="body">
    <br>
<p>Primer nombre (máx. 100 caracteres). Example: <code>Harol</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>second_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="second_name"                data-endpoint="POSTapi-users"
               value="Mateo"
               data-component="body">
    <br>
<p>Segundo nombre (opcional). Example: <code>Mateo</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>first_last_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="first_last_name"                data-endpoint="POSTapi-users"
               value="Escobar"
               data-component="body">
    <br>
<p>Primer apellido (máx. 100 caracteres). Example: <code>Escobar</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>second_last_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="second_last_name"                data-endpoint="POSTapi-users"
               value="Correa"
               data-component="body">
    <br>
<p>Segundo apellido (opcional). Example: <code>Correa</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-users"
               value="mateo@ejemplo.com"
               data-component="body">
    <br>
<p>Correo electrónico válido y único. Example: <code>mateo@ejemplo.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-users"
               value="{"salt":"...","iv":"...","ciphertext":"..."}"
               data-component="body">
    <br>
<p>Contraseña encriptada AES-256-CBC. Example: <code>{"salt":"...","iv":"...","ciphertext":"..."}</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="POSTapi-users"
               value="+573138853031"
               data-component="body">
    <br>
<p>Teléfono en formato E.164. Example: <code>+573138853031</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone_ext</code></b>&nbsp;&nbsp;
<small>numeric</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone_ext"                data-endpoint="POSTapi-users"
               value="124"
               data-component="body">
    <br>
<p>Extensión (opcional). Example: <code>124</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>birth_day</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="birth_day"                data-endpoint="POSTapi-users"
               value="1997-10-20"
               data-component="body">
    <br>
<p>Fecha de nacimiento YYYY-MM-DD. Mayor de 18 años. Example: <code>1997-10-20</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address"                data-endpoint="POSTapi-users"
               value="n"
               data-component="body">
    <br>
<p>validation.max. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>lang</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="lang"                data-endpoint="POSTapi-users"
               value="es"
               data-component="body">
    <br>
<p>Example: <code>es</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>es</code></li> <li><code>en</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>roles</code></b>&nbsp;&nbsp;
<small>integer[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="roles[0]"                data-endpoint="POSTapi-users"
               data-component="body">
        <input type="number" style="display: none"
               name="roles[1]"                data-endpoint="POSTapi-users"
               data-component="body">
    <br>
<p>IDs de roles a asignar (opcional).</p>
        </div>
        </form>

                    <h2 id="usuarios-GETapi-users--id-">Obtener usuario</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retorna los datos completos de un usuario específico, incluyendo roles y permisos.</p>

<span id="example-requests-GETapi-users--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/users/1" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/users/1"
);

const headers = {
    "Authorization": "Bearer {BEARER_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-users--id-">
            <blockquote>
            <p>Example response (200, Usuario encontrado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Success&quot;,
    &quot;message&quot;: &quot;Usuario obtenido exitosamente&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Juan P&eacute;rez&quot;,
        &quot;roles&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Administrator&quot;
            }
        ]
    },
    &quot;code&quot;: 200
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Sin permiso):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;No tienes permiso para realizar esta acci&oacute;n.&quot;,
    &quot;code&quot;: 403
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, No encontrado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;El usuario no fue encontrado&quot;,
    &quot;code&quot;: 404
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-users--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-users--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-users--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-users--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-users--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-users--id-" data-method="GET"
      data-path="api/users/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-users--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-users--id-"
                    onclick="tryItOut('GETapi-users--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-users--id-"
                    onclick="cancelTryOut('GETapi-users--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-users--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/users/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-users--id-"
               value="Bearer {BEARER_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {BEARER_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-users--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-users--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-users--id-"
               value="1"
               data-component="url">
    <br>
<p>ID del usuario. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="usuarios-PUTapi-users--id-">Actualizar usuario</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Actualiza los datos de un usuario existente. Solo se procesan los campos enviados.
Si se envía <code>roles</code>, se sincronizan con <code>syncRoles()</code>. La contraseña es opcional.</p>

<span id="example-requests-PUTapi-users--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/users/1" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"document\": \"bngzmiyvdljnikhw\",
    \"first_name\": \"Juan\",
    \"second_name\": \"y\",
    \"first_last_name\": \"k\",
    \"second_last_name\": \"c\",
    \"email\": \"actualizado@ejemplo.com\",
    \"password\": \"{\\\"salt\\\":\\\"...\\\",\\\"iv\\\":\\\"...\\\",\\\"ciphertext\\\":\\\"...\\\"}\",
    \"phone\": \"+36\",
    \"phone_ext\": \"449171\",
    \"birth_day\": \"1998-05-18\",
    \"address\": \"n\",
    \"lang\": \"es\",
    \"roles\": [
        1
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/users/1"
);

const headers = {
    "Authorization": "Bearer {BEARER_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "document": "bngzmiyvdljnikhw",
    "first_name": "Juan",
    "second_name": "y",
    "first_last_name": "k",
    "second_last_name": "c",
    "email": "actualizado@ejemplo.com",
    "password": "{\"salt\":\"...\",\"iv\":\"...\",\"ciphertext\":\"...\"}",
    "phone": "+36",
    "phone_ext": "449171",
    "birth_day": "1998-05-18",
    "address": "n",
    "lang": "es",
    "roles": [
        1
    ]
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-users--id-">
            <blockquote>
            <p>Example response (200, Actualizado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Success&quot;,
    &quot;message&quot;: &quot;Usuario actualizado exitosamente&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Juan P&eacute;rez&quot;
    },
    &quot;code&quot;: 200
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Sin permiso):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;No tienes permiso para realizar esta acci&oacute;n.&quot;,
    &quot;code&quot;: 403
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, No encontrado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;El usuario no fue encontrado&quot;,
    &quot;code&quot;: 404
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-users--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-users--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-users--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-users--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-users--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-users--id-" data-method="PUT"
      data-path="api/users/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-users--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-users--id-"
                    onclick="tryItOut('PUTapi-users--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-users--id-"
                    onclick="cancelTryOut('PUTapi-users--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-users--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/users/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/users/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-users--id-"
               value="Bearer {BEARER_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {BEARER_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-users--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-users--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-users--id-"
               value="1"
               data-component="url">
    <br>
<p>ID del usuario a actualizar. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>document</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="document"                data-endpoint="PUTapi-users--id-"
               value="bngzmiyvdljnikhw"
               data-component="body">
    <br>
<p>validation.max. Example: <code>bngzmiyvdljnikhw</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>first_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="first_name"                data-endpoint="PUTapi-users--id-"
               value="Juan"
               data-component="body">
    <br>
<p>Primer nombre. Example: <code>Juan</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>second_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="second_name"                data-endpoint="PUTapi-users--id-"
               value="y"
               data-component="body">
    <br>
<p>validation.max. Example: <code>y</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>first_last_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="first_last_name"                data-endpoint="PUTapi-users--id-"
               value="k"
               data-component="body">
    <br>
<p>validation.max. Example: <code>k</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>second_last_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="second_last_name"                data-endpoint="PUTapi-users--id-"
               value="c"
               data-component="body">
    <br>
<p>validation.max. Example: <code>c</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="PUTapi-users--id-"
               value="actualizado@ejemplo.com"
               data-component="body">
    <br>
<p>Correo electrónico. Example: <code>actualizado@ejemplo.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="PUTapi-users--id-"
               value="{"salt":"...","iv":"...","ciphertext":"..."}"
               data-component="body">
    <br>
<p>Contraseña AES-256-CBC (opcional). Example: <code>{"salt":"...","iv":"...","ciphertext":"..."}</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="PUTapi-users--id-"
               value="+36"
               data-component="body">
    <br>
<p>Must match the regex /^+[1-9]\d{1,14}$/. Example: <code>+36</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone_ext</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone_ext"                data-endpoint="PUTapi-users--id-"
               value="449171"
               data-component="body">
    <br>
<p>validation.digits_between. Example: <code>449171</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>birth_day</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="birth_day"                data-endpoint="PUTapi-users--id-"
               value="1998-05-18"
               data-component="body">
    <br>
<p>Must be a valid date in the format <code>Y-m-d</code>. validation.before_or_equal. Example: <code>1998-05-18</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address"                data-endpoint="PUTapi-users--id-"
               value="n"
               data-component="body">
    <br>
<p>validation.max. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>lang</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="lang"                data-endpoint="PUTapi-users--id-"
               value="es"
               data-component="body">
    <br>
<p>Example: <code>es</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>es</code></li> <li><code>en</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>roles</code></b>&nbsp;&nbsp;
<small>integer[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="roles[0]"                data-endpoint="PUTapi-users--id-"
               data-component="body">
        <input type="number" style="display: none"
               name="roles[1]"                data-endpoint="PUTapi-users--id-"
               data-component="body">
    <br>
<p>IDs de roles a sincronizar (opcional).</p>
        </div>
        </form>

                    <h2 id="usuarios-DELETEapi-users--id-">Eliminar usuario</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Elimina permanentemente un usuario junto con sus roles, permisos y tokens.
No se puede eliminar al usuario autenticado.</p>

<span id="example-requests-DELETEapi-users--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/users/5" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/users/5"
);

const headers = {
    "Authorization": "Bearer {BEARER_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-users--id-">
            <blockquote>
            <p>Example response (200, Eliminado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Success&quot;,
    &quot;message&quot;: &quot;Usuario eliminado exitosamente&quot;,
    &quot;data&quot;: [],
    &quot;code&quot;: 200
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Cuenta propia):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;No puedes eliminar tu propia cuenta&quot;,
    &quot;code&quot;: 403
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, No encontrado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;El usuario no fue encontrado&quot;,
    &quot;code&quot;: 404
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-users--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-users--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-users--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-users--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-users--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-users--id-" data-method="DELETE"
      data-path="api/users/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-users--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-users--id-"
                    onclick="tryItOut('DELETEapi-users--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-users--id-"
                    onclick="cancelTryOut('DELETEapi-users--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-users--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/users/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-users--id-"
               value="Bearer {BEARER_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {BEARER_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-users--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-users--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-users--id-"
               value="5"
               data-component="url">
    <br>
<p>ID del usuario a eliminar. Example: <code>5</code></p>
            </div>
                    </form>

                    <h2 id="usuarios-POSTapi-users--id--activate">Activar usuario</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Activa un usuario que se encontraba inactivo.</p>

<span id="example-requests-POSTapi-users--id--activate">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/users/3/activate" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/users/3/activate"
);

const headers = {
    "Authorization": "Bearer {BEARER_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-users--id--activate">
            <blockquote>
            <p>Example response (200, Activado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Success&quot;,
    &quot;message&quot;: &quot;Usuario activado exitosamente&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 3,
        &quot;active&quot;: 1
    },
    &quot;code&quot;: 200
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Sin permiso):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;No tienes permiso para realizar esta acci&oacute;n.&quot;,
    &quot;code&quot;: 403
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, No encontrado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;El usuario no fue encontrado&quot;,
    &quot;code&quot;: 404
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-users--id--activate" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-users--id--activate"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-users--id--activate"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-users--id--activate" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-users--id--activate">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-users--id--activate" data-method="POST"
      data-path="api/users/{id}/activate"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-users--id--activate', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-users--id--activate"
                    onclick="tryItOut('POSTapi-users--id--activate');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-users--id--activate"
                    onclick="cancelTryOut('POSTapi-users--id--activate');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-users--id--activate"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/users/{id}/activate</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-users--id--activate"
               value="Bearer {BEARER_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {BEARER_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-users--id--activate"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-users--id--activate"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="POSTapi-users--id--activate"
               value="3"
               data-component="url">
    <br>
<p>ID del usuario a activar. Example: <code>3</code></p>
            </div>
                    </form>

                    <h2 id="usuarios-POSTapi-users--id--deactivate">Desactivar usuario</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Desactiva un usuario impidiéndole iniciar sesión.</p>

<span id="example-requests-POSTapi-users--id--deactivate">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/users/3/deactivate" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/users/3/deactivate"
);

const headers = {
    "Authorization": "Bearer {BEARER_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-users--id--deactivate">
            <blockquote>
            <p>Example response (200, Desactivado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Success&quot;,
    &quot;message&quot;: &quot;Usuario desactivado exitosamente&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 3,
        &quot;active&quot;: 0
    },
    &quot;code&quot;: 200
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Sin permiso):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;No tienes permiso para realizar esta acci&oacute;n.&quot;,
    &quot;code&quot;: 403
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, No encontrado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;El usuario no fue encontrado&quot;,
    &quot;code&quot;: 404
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-users--id--deactivate" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-users--id--deactivate"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-users--id--deactivate"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-users--id--deactivate" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-users--id--deactivate">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-users--id--deactivate" data-method="POST"
      data-path="api/users/{id}/deactivate"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-users--id--deactivate', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-users--id--deactivate"
                    onclick="tryItOut('POSTapi-users--id--deactivate');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-users--id--deactivate"
                    onclick="cancelTryOut('POSTapi-users--id--deactivate');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-users--id--deactivate"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/users/{id}/deactivate</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-users--id--deactivate"
               value="Bearer {BEARER_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {BEARER_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-users--id--deactivate"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-users--id--deactivate"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="POSTapi-users--id--deactivate"
               value="3"
               data-component="url">
    <br>
<p>ID del usuario a desactivar. Example: <code>3</code></p>
            </div>
                    </form>

                    <h2 id="usuarios-GETapi-users--id--history">Historial del usuario</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retorna el historial de cambios y actividad registrada del usuario especificado.</p>

<span id="example-requests-GETapi-users--id--history">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/users/1/history" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/users/1/history"
);

const headers = {
    "Authorization": "Bearer {BEARER_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-users--id--history">
            <blockquote>
            <p>Example response (200, Historial obtenido):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Success&quot;,
    &quot;message&quot;: &quot;Historial obtenido exitosamente&quot;,
    &quot;data&quot;: {
        &quot;user&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Juan P&eacute;rez&quot;
        },
        &quot;logs&quot;: [
            {
                &quot;id&quot;: 10,
                &quot;operation&quot;: &quot;UPDATE OF THE REGISTRY&quot;,
                &quot;reason&quot;: &quot;User information updated&quot;
            }
        ]
    },
    &quot;code&quot;: 200
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Sin permiso):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;No tienes permiso para realizar esta acci&oacute;n.&quot;,
    &quot;code&quot;: 403
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, No encontrado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;El usuario no fue encontrado&quot;,
    &quot;code&quot;: 404
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-users--id--history" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-users--id--history"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-users--id--history"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-users--id--history" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-users--id--history">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-users--id--history" data-method="GET"
      data-path="api/users/{id}/history"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-users--id--history', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-users--id--history"
                    onclick="tryItOut('GETapi-users--id--history');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-users--id--history"
                    onclick="cancelTryOut('GETapi-users--id--history');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-users--id--history"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/users/{id}/history</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-users--id--history"
               value="Bearer {BEARER_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {BEARER_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-users--id--history"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-users--id--history"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-users--id--history"
               value="1"
               data-component="url">
    <br>
<p>ID del usuario. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="usuarios-POSTapi-users--id--language">Actualizar idioma del usuario</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-users--id--language">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/users/1/language" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"lang\": \"en\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/users/1/language"
);

const headers = {
    "Authorization": "Bearer {BEARER_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "lang": "en"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-users--id--language">
            <blockquote>
            <p>Example response (200, Idioma actualizado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Success&quot;,
    &quot;message&quot;: &quot;Idioma actualizado exitosamente&quot;,
    &quot;data&quot;: {
        &quot;lang&quot;: &quot;en&quot;
    },
    &quot;code&quot;: 200
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, No encontrado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;El usuario no fue encontrado&quot;,
    &quot;code&quot;: 404
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-users--id--language" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-users--id--language"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-users--id--language"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-users--id--language" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-users--id--language">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-users--id--language" data-method="POST"
      data-path="api/users/{id}/language"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-users--id--language', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-users--id--language"
                    onclick="tryItOut('POSTapi-users--id--language');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-users--id--language"
                    onclick="cancelTryOut('POSTapi-users--id--language');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-users--id--language"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/users/{id}/language</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-users--id--language"
               value="Bearer {BEARER_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {BEARER_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-users--id--language"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-users--id--language"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="POSTapi-users--id--language"
               value="1"
               data-component="url">
    <br>
<p>ID del usuario. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>lang</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="lang"                data-endpoint="POSTapi-users--id--language"
               value="en"
               data-component="body">
    <br>
<p>Código de idioma (es|en). Example: <code>en</code></p>
        </div>
        </form>

                    <h2 id="usuarios-GETapi-users--id--permissions">Permisos del usuario</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retorna los permisos directos y los permisos heredados por rol, diferenciados.</p>

<span id="example-requests-GETapi-users--id--permissions">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/users/1/permissions" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/users/1/permissions"
);

const headers = {
    "Authorization": "Bearer {BEARER_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-users--id--permissions">
            <blockquote>
            <p>Example response (200, Permisos obtenidos):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Success&quot;,
    &quot;message&quot;: &quot;Permisos obtenidos exitosamente&quot;,
    &quot;data&quot;: {
        &quot;direct_permissions&quot;: [
            &quot;users.add&quot;
        ],
        &quot;role_permissions&quot;: [
            &quot;users.view&quot;,
            &quot;users.edit&quot;
        ]
    },
    &quot;code&quot;: 200
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Sin permiso):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;No tienes permiso para realizar esta acci&oacute;n.&quot;,
    &quot;code&quot;: 403
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, No encontrado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;El usuario no fue encontrado&quot;,
    &quot;code&quot;: 404
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-users--id--permissions" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-users--id--permissions"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-users--id--permissions"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-users--id--permissions" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-users--id--permissions">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-users--id--permissions" data-method="GET"
      data-path="api/users/{id}/permissions"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-users--id--permissions', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-users--id--permissions"
                    onclick="tryItOut('GETapi-users--id--permissions');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-users--id--permissions"
                    onclick="cancelTryOut('GETapi-users--id--permissions');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-users--id--permissions"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/users/{id}/permissions</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-users--id--permissions"
               value="Bearer {BEARER_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {BEARER_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-users--id--permissions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-users--id--permissions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-users--id--permissions"
               value="1"
               data-component="url">
    <br>
<p>ID del usuario. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="usuarios-POSTapi-users--id--permissions">Sincronizar permisos directos del usuario</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Reemplaza los permisos directos con los enviados. Usa <code>syncPermissions()</code> de Spatie.</p>

<span id="example-requests-POSTapi-users--id--permissions">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/users/1/permissions" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"permissions\": [
        \"users.add\",
        \"users.edit\"
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/users/1/permissions"
);

const headers = {
    "Authorization": "Bearer {BEARER_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "permissions": [
        "users.add",
        "users.edit"
    ]
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-users--id--permissions">
            <blockquote>
            <p>Example response (200, Sincronizados):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Success&quot;,
    &quot;message&quot;: &quot;Permisos sincronizados exitosamente&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;permissions&quot;: [
            &quot;users.add&quot;
        ]
    },
    &quot;code&quot;: 200
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Sin permiso):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;No tienes permiso para realizar esta acci&oacute;n.&quot;,
    &quot;code&quot;: 403
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Permiso inválido):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;Los datos proporcionados no son v&aacute;lidos&quot;,
    &quot;errors&quot;: {
        &quot;permissions.0&quot;: [
            &quot;Uno o m&aacute;s permisos especificados no existen.&quot;
        ]
    },
    &quot;code&quot;: 422
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-users--id--permissions" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-users--id--permissions"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-users--id--permissions"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-users--id--permissions" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-users--id--permissions">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-users--id--permissions" data-method="POST"
      data-path="api/users/{id}/permissions"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-users--id--permissions', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-users--id--permissions"
                    onclick="tryItOut('POSTapi-users--id--permissions');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-users--id--permissions"
                    onclick="cancelTryOut('POSTapi-users--id--permissions');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-users--id--permissions"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/users/{id}/permissions</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-users--id--permissions"
               value="Bearer {BEARER_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {BEARER_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-users--id--permissions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-users--id--permissions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="POSTapi-users--id--permissions"
               value="1"
               data-component="url">
    <br>
<p>ID del usuario. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>permissions</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="permissions[0]"                data-endpoint="POSTapi-users--id--permissions"
               data-component="body">
        <input type="text" style="display: none"
               name="permissions[1]"                data-endpoint="POSTapi-users--id--permissions"
               data-component="body">
    <br>
<p>Nombres de permisos a asignar.</p>
        </div>
        </form>

                    <h2 id="usuarios-POSTapi-users--id--roles">Asignar roles al usuario</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Reemplaza los roles del usuario con los enviados. Usa <code>syncRoles()</code> de Spatie.</p>

<span id="example-requests-POSTapi-users--id--roles">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/users/1/roles" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"roles\": [
        1,
        2
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/users/1/roles"
);

const headers = {
    "Authorization": "Bearer {BEARER_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "roles": [
        1,
        2
    ]
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-users--id--roles">
            <blockquote>
            <p>Example response (200, Roles sincronizados):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Success&quot;,
    &quot;message&quot;: &quot;Roles sincronizados exitosamente&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;roles&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Administrator&quot;
            }
        ]
    },
    &quot;code&quot;: 200
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Sin permiso):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;No tienes permiso para realizar esta acci&oacute;n.&quot;,
    &quot;code&quot;: 403
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Rol inválido):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;Los datos proporcionados no son v&aacute;lidos&quot;,
    &quot;errors&quot;: {
        &quot;roles.0&quot;: [
            &quot;Uno o m&aacute;s roles especificados no existen.&quot;
        ]
    },
    &quot;code&quot;: 422
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-users--id--roles" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-users--id--roles"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-users--id--roles"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-users--id--roles" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-users--id--roles">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-users--id--roles" data-method="POST"
      data-path="api/users/{id}/roles"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-users--id--roles', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-users--id--roles"
                    onclick="tryItOut('POSTapi-users--id--roles');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-users--id--roles"
                    onclick="cancelTryOut('POSTapi-users--id--roles');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-users--id--roles"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/users/{id}/roles</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-users--id--roles"
               value="Bearer {BEARER_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {BEARER_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-users--id--roles"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-users--id--roles"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="POSTapi-users--id--roles"
               value="1"
               data-component="url">
    <br>
<p>ID del usuario. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>roles</code></b>&nbsp;&nbsp;
<small>integer[]</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="roles[0]"                data-endpoint="POSTapi-users--id--roles"
               data-component="body">
        <input type="number" style="display: none"
               name="roles[1]"                data-endpoint="POSTapi-users--id--roles"
               data-component="body">
    <br>
<p>IDs de roles a asignar.</p>
        </div>
        </form>

                <h1 id="menu">Menú</h1>

    

                                <h2 id="menu-GETapi-menu-hierarchical">Menú jerárquico</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retorna todos los menús en estructura jerárquica (padre-hijo) visibles.
Útil para construir la navegación de la aplicación.</p>

<span id="example-requests-GETapi-menu-hierarchical">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/menu/hierarchical" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/menu/hierarchical"
);

const headers = {
    "Authorization": "Bearer {BEARER_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-menu-hierarchical">
            <blockquote>
            <p>Example response (200, Menú jerárquico):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Men&uacute; jer&aacute;rquico obtenido exitosamente&quot;,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;key&quot;: &quot;dashboard&quot;,
            &quot;label&quot;: &quot;Dashboard&quot;,
            &quot;icon&quot;: &quot;bx-home&quot;,
            &quot;link&quot;: &quot;/dashboard&quot;,
            &quot;is_title&quot;: false,
            &quot;order&quot;: 1,
            &quot;flag_visible&quot;: true,
            &quot;children&quot;: []
        },
        {
            &quot;id&quot;: 2,
            &quot;key&quot;: &quot;admin&quot;,
            &quot;label&quot;: &quot;Administraci&oacute;n&quot;,
            &quot;icon&quot;: &quot;bx-cog&quot;,
            &quot;link&quot;: null,
            &quot;is_title&quot;: true,
            &quot;order&quot;: 2,
            &quot;flag_visible&quot;: true,
            &quot;children&quot;: [
                {
                    &quot;id&quot;: 3,
                    &quot;key&quot;: &quot;usuarios&quot;,
                    &quot;label&quot;: &quot;Usuarios&quot;,
                    &quot;icon&quot;: &quot;bx-user&quot;,
                    &quot;link&quot;: &quot;/admin/usuarios&quot;,
                    &quot;is_title&quot;: false,
                    &quot;order&quot;: 1,
                    &quot;flag_visible&quot;: true,
                    &quot;children&quot;: []
                }
            ]
        }
    ]
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, No autenticado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-menu-hierarchical" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-menu-hierarchical"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-menu-hierarchical"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-menu-hierarchical" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-menu-hierarchical">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-menu-hierarchical" data-method="GET"
      data-path="api/menu/hierarchical"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-menu-hierarchical', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-menu-hierarchical"
                    onclick="tryItOut('GETapi-menu-hierarchical');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-menu-hierarchical"
                    onclick="cancelTryOut('GETapi-menu-hierarchical');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-menu-hierarchical"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/menu/hierarchical</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-menu-hierarchical"
               value="Bearer {BEARER_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {BEARER_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-menu-hierarchical"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-menu-hierarchical"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="menu-GETapi-menu-by-system--idSistema-">Menús por sistema</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retorna todos los menús jerárquicos que pertenecen a un sistema específico.
Útil para construir la navegación de un módulo específico.</p>

<span id="example-requests-GETapi-menu-by-system--idSistema-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/menu/by-system/1" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/menu/by-system/1"
);

const headers = {
    "Authorization": "Bearer {BEARER_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-menu-by-system--idSistema-">
            <blockquote>
            <p>Example response (200, Menús del sistema):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Men&uacute;s del sistema obtenidos exitosamente&quot;,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;key&quot;: &quot;dashboard&quot;,
            &quot;label&quot;: &quot;Dashboard&quot;,
            &quot;icon&quot;: &quot;bx-home&quot;,
            &quot;link&quot;: &quot;/dashboard&quot;,
            &quot;is_title&quot;: false,
            &quot;order&quot;: 1,
            &quot;id_sistema&quot;: 1,
            &quot;children&quot;: []
        }
    ]
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, No autenticado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-menu-by-system--idSistema-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-menu-by-system--idSistema-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-menu-by-system--idSistema-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-menu-by-system--idSistema-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-menu-by-system--idSistema-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-menu-by-system--idSistema-" data-method="GET"
      data-path="api/menu/by-system/{idSistema}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-menu-by-system--idSistema-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-menu-by-system--idSistema-"
                    onclick="tryItOut('GETapi-menu-by-system--idSistema-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-menu-by-system--idSistema-"
                    onclick="cancelTryOut('GETapi-menu-by-system--idSistema-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-menu-by-system--idSistema-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/menu/by-system/{idSistema}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-menu-by-system--idSistema-"
               value="Bearer {BEARER_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {BEARER_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-menu-by-system--idSistema-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-menu-by-system--idSistema-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>idSistema</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="idSistema"                data-endpoint="GETapi-menu-by-system--idSistema-"
               value="1"
               data-component="url">
    <br>
<p>ID del sistema. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="menu-GETapi-menu">Listar menús</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retorna todos los menús visibles paginados, ordenados por el campo <code>order</code>.
Incluye items de todos los niveles jerárquicos en lista plana.</p>

<span id="example-requests-GETapi-menu">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/menu" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/menu"
);

const headers = {
    "Authorization": "Bearer {BEARER_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-menu">
            <blockquote>
            <p>Example response (200, Lista de menús):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Men&uacute;s obtenidos exitosamente&quot;,
    &quot;data&quot;: {
        &quot;current_page&quot;: 1,
        &quot;data&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;key&quot;: &quot;dashboard&quot;,
                &quot;label&quot;: &quot;Dashboard&quot;,
                &quot;icon&quot;: &quot;bx-home&quot;,
                &quot;link&quot;: &quot;/dashboard&quot;,
                &quot;parent_key&quot;: null,
                &quot;is_title&quot;: false,
                &quot;collapsed&quot;: false,
                &quot;order&quot;: 1,
                &quot;flag_visible&quot;: true,
                &quot;id_sistema&quot;: 1
            }
        ],
        &quot;per_page&quot;: 15,
        &quot;total&quot;: 20
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, No autenticado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-menu" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-menu"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-menu"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-menu" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-menu">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-menu" data-method="GET"
      data-path="api/menu"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-menu', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-menu"
                    onclick="tryItOut('GETapi-menu');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-menu"
                    onclick="cancelTryOut('GETapi-menu');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-menu"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/menu</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-menu"
               value="Bearer {BEARER_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {BEARER_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-menu"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-menu"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="menu-POSTapi-menu">Crear menú</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Crea un nuevo ítem de menú. Si se especifica <code>parent_key</code>, el menú
se anida como hijo del padre indicado.</p>

<span id="example-requests-POSTapi-menu">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/menu" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"key\": \"reportes\",
    \"label\": \"Reportes\",
    \"icon\": \"bx-bar-chart\",
    \"link\": \"\\/reportes\",
    \"parent_key\": \"admin\",
    \"is_title\": false,
    \"collapsed\": true,
    \"id_sistema_pantalla\": 5,
    \"order\": 3,
    \"padre_id\": 0,
    \"icon_id\": 12,
    \"flag_detalle\": false,
    \"flag_visible\": true,
    \"id_sistema\": 1,
    \"bt_login\": \"admin\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/menu"
);

const headers = {
    "Authorization": "Bearer {BEARER_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "key": "reportes",
    "label": "Reportes",
    "icon": "bx-bar-chart",
    "link": "\/reportes",
    "parent_key": "admin",
    "is_title": false,
    "collapsed": true,
    "id_sistema_pantalla": 5,
    "order": 3,
    "padre_id": 0,
    "icon_id": 12,
    "flag_detalle": false,
    "flag_visible": true,
    "id_sistema": 1,
    "bt_login": "admin"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-menu">
            <blockquote>
            <p>Example response (201, Menú creado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Men&uacute; creado exitosamente&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 10,
        &quot;key&quot;: &quot;reportes&quot;,
        &quot;label&quot;: &quot;Reportes&quot;,
        &quot;icon&quot;: &quot;bx-bar-chart&quot;,
        &quot;link&quot;: &quot;/reportes&quot;,
        &quot;is_title&quot;: false,
        &quot;collapsed&quot;: true,
        &quot;order&quot;: 3,
        &quot;flag_visible&quot;: true,
        &quot;children&quot;: []
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, No autenticado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, Padre no encontrado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;El men&uacute; padre no fue encontrado&quot;,
    &quot;errors&quot;: []
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Validación fallida):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Los datos proporcionados no son v&aacute;lidos&quot;,
    &quot;errors&quot;: {
        &quot;key&quot;: [
            &quot;El campo key ya existe.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-menu" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-menu"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-menu"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-menu" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-menu">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-menu" data-method="POST"
      data-path="api/menu"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-menu', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-menu"
                    onclick="tryItOut('POSTapi-menu');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-menu"
                    onclick="cancelTryOut('POSTapi-menu');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-menu"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/menu</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-menu"
               value="Bearer {BEARER_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {BEARER_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-menu"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-menu"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>key</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="key"                data-endpoint="POSTapi-menu"
               value="reportes"
               data-component="body">
    <br>
<p>Identificador único del menú. Example: <code>reportes</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>label</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="label"                data-endpoint="POSTapi-menu"
               value="Reportes"
               data-component="body">
    <br>
<p>Etiqueta visible del menú. Example: <code>Reportes</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>icon</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="icon"                data-endpoint="POSTapi-menu"
               value="bx-bar-chart"
               data-component="body">
    <br>
<p>Ícono del menú (clase CSS). Example: <code>bx-bar-chart</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>link</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="link"                data-endpoint="POSTapi-menu"
               value="/reportes"
               data-component="body">
    <br>
<p>URL o ruta del menú. Example: <code>/reportes</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>parent_key</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="parent_key"                data-endpoint="POSTapi-menu"
               value="admin"
               data-component="body">
    <br>
<p>Clave del menú padre (para anidamiento). Example: <code>admin</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_title</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-menu" style="display: none">
            <input type="radio" name="is_title"
                   value="true"
                   data-endpoint="POSTapi-menu"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-menu" style="display: none">
            <input type="radio" name="is_title"
                   value="false"
                   data-endpoint="POSTapi-menu"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Indica si es un título de sección. Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>collapsed</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-menu" style="display: none">
            <input type="radio" name="collapsed"
                   value="true"
                   data-endpoint="POSTapi-menu"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-menu" style="display: none">
            <input type="radio" name="collapsed"
                   value="false"
                   data-endpoint="POSTapi-menu"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Indica si el menú comienza colapsado. Example: <code>true</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>id_sistema_pantalla</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id_sistema_pantalla"                data-endpoint="POSTapi-menu"
               value="5"
               data-component="body">
    <br>
<p>ID de la pantalla del sistema. Example: <code>5</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>order</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="order"                data-endpoint="POSTapi-menu"
               value="3"
               data-component="body">
    <br>
<p>Orden de aparición. Example: <code>3</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>padre_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="padre_id"                data-endpoint="POSTapi-menu"
               value="0"
               data-component="body">
    <br>
<p>ID del padre en sistema legado. Example: <code>0</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>icon_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="icon_id"                data-endpoint="POSTapi-menu"
               value="12"
               data-component="body">
    <br>
<p>ID del ícono en catálogo. Example: <code>12</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>flag_detalle</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-menu" style="display: none">
            <input type="radio" name="flag_detalle"
                   value="true"
                   data-endpoint="POSTapi-menu"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-menu" style="display: none">
            <input type="radio" name="flag_detalle"
                   value="false"
                   data-endpoint="POSTapi-menu"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Indica si tiene vista de detalle. Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>flag_visible</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-menu" style="display: none">
            <input type="radio" name="flag_visible"
                   value="true"
                   data-endpoint="POSTapi-menu"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-menu" style="display: none">
            <input type="radio" name="flag_visible"
                   value="false"
                   data-endpoint="POSTapi-menu"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Indica si el menú es visible. Por defecto: true. Example: <code>true</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>id_sistema</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id_sistema"                data-endpoint="POSTapi-menu"
               value="1"
               data-component="body">
    <br>
<p>ID del sistema al que pertenece. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>bt_login</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="bt_login"                data-endpoint="POSTapi-menu"
               value="admin"
               data-component="body">
    <br>
<p>Usuario que crea el registro. Example: <code>admin</code></p>
        </div>
        </form>

                    <h2 id="menu-GETapi-menu--id-">Obtener menú</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retorna los datos de un menú específico en estructura jerárquica,
incluyendo sus submenús anidados.</p>

<span id="example-requests-GETapi-menu--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/menu/1" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/menu/1"
);

const headers = {
    "Authorization": "Bearer {BEARER_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-menu--id-">
            <blockquote>
            <p>Example response (200, Menú encontrado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Men&uacute; obtenido exitosamente&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;key&quot;: &quot;admin&quot;,
        &quot;label&quot;: &quot;Administraci&oacute;n&quot;,
        &quot;icon&quot;: &quot;bx-cog&quot;,
        &quot;link&quot;: null,
        &quot;is_title&quot;: true,
        &quot;collapsed&quot;: false,
        &quot;order&quot;: 2,
        &quot;flag_visible&quot;: true,
        &quot;children&quot;: [
            {
                &quot;id&quot;: 3,
                &quot;key&quot;: &quot;usuarios&quot;,
                &quot;label&quot;: &quot;Usuarios&quot;,
                &quot;children&quot;: []
            }
        ]
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, No autenticado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, Menú no encontrado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;No query results for model [App\\Models\\Menu].&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-menu--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-menu--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-menu--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-menu--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-menu--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-menu--id-" data-method="GET"
      data-path="api/menu/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-menu--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-menu--id-"
                    onclick="tryItOut('GETapi-menu--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-menu--id-"
                    onclick="cancelTryOut('GETapi-menu--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-menu--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/menu/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-menu--id-"
               value="Bearer {BEARER_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {BEARER_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-menu--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-menu--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-menu--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the menu. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>menu</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="menu"                data-endpoint="GETapi-menu--id-"
               value="1"
               data-component="url">
    <br>
<p>ID del menú. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="menu-PUTapi-menu--id-">Actualizar menú</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Actualiza los datos de un menú existente. Si se cambia <code>parent_key</code>,
se actualiza el anidamiento jerárquico.</p>

<span id="example-requests-PUTapi-menu--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/menu/1" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"key\": \"reportes-v2\",
    \"label\": \"Reportes Avanzados\",
    \"icon\": \"bx-bar-chart-alt\",
    \"link\": \"\\/reportes\\/avanzados\",
    \"parent_key\": \"admin\",
    \"is_title\": false,
    \"collapsed\": false,
    \"id_sistema_pantalla\": 16,
    \"order\": 5,
    \"padre_id\": 16,
    \"icon_id\": 16,
    \"flag_detalle\": false,
    \"flag_visible\": true,
    \"id_sistema\": 1,
    \"bt_login\": \"n\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/menu/1"
);

const headers = {
    "Authorization": "Bearer {BEARER_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "key": "reportes-v2",
    "label": "Reportes Avanzados",
    "icon": "bx-bar-chart-alt",
    "link": "\/reportes\/avanzados",
    "parent_key": "admin",
    "is_title": false,
    "collapsed": false,
    "id_sistema_pantalla": 16,
    "order": 5,
    "padre_id": 16,
    "icon_id": 16,
    "flag_detalle": false,
    "flag_visible": true,
    "id_sistema": 1,
    "bt_login": "n"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-menu--id-">
            <blockquote>
            <p>Example response (200, Menú actualizado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Men&uacute; actualizado exitosamente&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;key&quot;: &quot;reportes-v2&quot;,
        &quot;label&quot;: &quot;Reportes Avanzados&quot;,
        &quot;icon&quot;: &quot;bx-bar-chart-alt&quot;,
        &quot;link&quot;: &quot;/reportes/avanzados&quot;,
        &quot;order&quot;: 5,
        &quot;flag_visible&quot;: true,
        &quot;children&quot;: []
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, No autenticado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, Padre no encontrado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;El men&uacute; padre no fue encontrado&quot;,
    &quot;errors&quot;: []
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Validación fallida):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Los datos proporcionados no son v&aacute;lidos&quot;,
    &quot;errors&quot;: {
        &quot;key&quot;: [
            &quot;El campo key ya existe.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-menu--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-menu--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-menu--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-menu--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-menu--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-menu--id-" data-method="PUT"
      data-path="api/menu/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-menu--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-menu--id-"
                    onclick="tryItOut('PUTapi-menu--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-menu--id-"
                    onclick="cancelTryOut('PUTapi-menu--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-menu--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/menu/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/menu/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-menu--id-"
               value="Bearer {BEARER_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {BEARER_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-menu--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-menu--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-menu--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the menu. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>menu</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="menu"                data-endpoint="PUTapi-menu--id-"
               value="1"
               data-component="url">
    <br>
<p>ID del menú a actualizar. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>key</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="key"                data-endpoint="PUTapi-menu--id-"
               value="reportes-v2"
               data-component="body">
    <br>
<p>Identificador único del menú. Example: <code>reportes-v2</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>label</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="label"                data-endpoint="PUTapi-menu--id-"
               value="Reportes Avanzados"
               data-component="body">
    <br>
<p>Etiqueta visible del menú. Example: <code>Reportes Avanzados</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>icon</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="icon"                data-endpoint="PUTapi-menu--id-"
               value="bx-bar-chart-alt"
               data-component="body">
    <br>
<p>Ícono del menú. Example: <code>bx-bar-chart-alt</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>link</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="link"                data-endpoint="PUTapi-menu--id-"
               value="/reportes/avanzados"
               data-component="body">
    <br>
<p>URL o ruta del menú. Example: <code>/reportes/avanzados</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>parent_key</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="parent_key"                data-endpoint="PUTapi-menu--id-"
               value="admin"
               data-component="body">
    <br>
<p>Clave del nuevo padre (para cambiar jerarquía). Example: <code>admin</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_title</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PUTapi-menu--id-" style="display: none">
            <input type="radio" name="is_title"
                   value="true"
                   data-endpoint="PUTapi-menu--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-menu--id-" style="display: none">
            <input type="radio" name="is_title"
                   value="false"
                   data-endpoint="PUTapi-menu--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Indica si es título de sección. Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>collapsed</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PUTapi-menu--id-" style="display: none">
            <input type="radio" name="collapsed"
                   value="true"
                   data-endpoint="PUTapi-menu--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-menu--id-" style="display: none">
            <input type="radio" name="collapsed"
                   value="false"
                   data-endpoint="PUTapi-menu--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Indica si comienza colapsado. Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>id_sistema_pantalla</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id_sistema_pantalla"                data-endpoint="PUTapi-menu--id-"
               value="16"
               data-component="body">
    <br>
<p>Example: <code>16</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>order</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="order"                data-endpoint="PUTapi-menu--id-"
               value="5"
               data-component="body">
    <br>
<p>Orden de aparición. Example: <code>5</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>padre_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="padre_id"                data-endpoint="PUTapi-menu--id-"
               value="16"
               data-component="body">
    <br>
<p>Example: <code>16</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>icon_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="icon_id"                data-endpoint="PUTapi-menu--id-"
               value="16"
               data-component="body">
    <br>
<p>Example: <code>16</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>flag_detalle</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PUTapi-menu--id-" style="display: none">
            <input type="radio" name="flag_detalle"
                   value="true"
                   data-endpoint="PUTapi-menu--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-menu--id-" style="display: none">
            <input type="radio" name="flag_detalle"
                   value="false"
                   data-endpoint="PUTapi-menu--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>flag_visible</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PUTapi-menu--id-" style="display: none">
            <input type="radio" name="flag_visible"
                   value="true"
                   data-endpoint="PUTapi-menu--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-menu--id-" style="display: none">
            <input type="radio" name="flag_visible"
                   value="false"
                   data-endpoint="PUTapi-menu--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Visibilidad del menú. Example: <code>true</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>id_sistema</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id_sistema"                data-endpoint="PUTapi-menu--id-"
               value="1"
               data-component="body">
    <br>
<p>ID del sistema al que pertenece. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>bt_login</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="bt_login"                data-endpoint="PUTapi-menu--id-"
               value="n"
               data-component="body">
    <br>
<p>validation.max. Example: <code>n</code></p>
        </div>
        </form>

                    <h2 id="menu-DELETEapi-menu--id-">Eliminar menú</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Elimina un menú del sistema. No se puede eliminar si tiene submenús asociados.
Primero elimine o reasigne los submenús hijos.</p>

<span id="example-requests-DELETEapi-menu--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/menu/1" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/menu/1"
);

const headers = {
    "Authorization": "Bearer {BEARER_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-menu--id-">
            <blockquote>
            <p>Example response (200, Menú eliminado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Men&uacute; eliminado exitosamente&quot;,
    &quot;data&quot;: null
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, No autenticado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, Menú no encontrado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;No query results for model [App\\Models\\Menu].&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Tiene submenús):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;No se puede eliminar el men&uacute; porque tiene submen&uacute;s asociados&quot;,
    &quot;errors&quot;: []
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-menu--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-menu--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-menu--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-menu--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-menu--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-menu--id-" data-method="DELETE"
      data-path="api/menu/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-menu--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-menu--id-"
                    onclick="tryItOut('DELETEapi-menu--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-menu--id-"
                    onclick="cancelTryOut('DELETEapi-menu--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-menu--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/menu/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-menu--id-"
               value="Bearer {BEARER_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {BEARER_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-menu--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-menu--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-menu--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the menu. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>menu</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="menu"                data-endpoint="DELETEapi-menu--id-"
               value="10"
               data-component="url">
    <br>
<p>ID del menú a eliminar. Example: <code>10</code></p>
            </div>
                    </form>

                <h1 id="roles-y-permisos">Roles y Permisos</h1>

    

                                <h2 id="roles-y-permisos-GETapi-roles">Listar roles</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retorna una lista paginada de roles del sistema con sus permisos asociados.</p>

<span id="example-requests-GETapi-roles">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/roles?take=10&amp;skip=0&amp;search=Admin" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/roles"
);

const params = {
    "take": "10",
    "skip": "0",
    "search": "Admin",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer {BEARER_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-roles">
            <blockquote>
            <p>Example response (200, Lista de roles):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Success&quot;,
    &quot;message&quot;: &quot;Roles obtenidos exitosamente&quot;,
    &quot;data&quot;: {
        &quot;records&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Administrator&quot;,
                &quot;description&quot;: &quot;Rol con acceso total&quot;,
                &quot;active&quot;: true,
                &quot;permissions&quot;: {
                    &quot;users&quot;: [
                        &quot;users.view&quot;
                    ]
                },
                &quot;permissions_count&quot;: 1
            }
        ],
        &quot;pagination&quot;: {
            &quot;total&quot;: 5,
            &quot;take&quot;: 10,
            &quot;skip&quot;: 0,
            &quot;pages&quot;: 1,
            &quot;current_page&quot;: 1
        }
    },
    &quot;code&quot;: 200
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, No autenticado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Sin permiso):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;No tienes permiso para realizar esta acci&oacute;n.&quot;,
    &quot;code&quot;: 403
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-roles" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-roles"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-roles"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-roles" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-roles">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-roles" data-method="GET"
      data-path="api/roles"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-roles', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-roles"
                    onclick="tryItOut('GETapi-roles');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-roles"
                    onclick="cancelTryOut('GETapi-roles');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-roles"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/roles</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-roles"
               value="Bearer {BEARER_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {BEARER_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-roles"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-roles"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>take</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="take"                data-endpoint="GETapi-roles"
               value="10"
               data-component="query">
    <br>
<p>Número de registros a retornar (1-100). Por defecto: 10. Example: <code>10</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>skip</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="skip"                data-endpoint="GETapi-roles"
               value="0"
               data-component="query">
    <br>
<p>Número de registros a saltar (offset). Por defecto: 0. Example: <code>0</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>search</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="search"                data-endpoint="GETapi-roles"
               value="Admin"
               data-component="query">
    <br>
<p>Término de búsqueda por nombre del rol. Example: <code>Admin</code></p>
            </div>
                </form>

                    <h2 id="roles-y-permisos-POSTapi-roles">Crear rol</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Crea un nuevo rol y opcionalmente le asigna permisos.</p>

<span id="example-requests-POSTapi-roles">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/roles" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"Editor\",
    \"description\": \"Rol con acceso de edición\",
    \"active\": true,
    \"permissions\": [
        \"users.view\",
        \"users.edit\"
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/roles"
);

const headers = {
    "Authorization": "Bearer {BEARER_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Editor",
    "description": "Rol con acceso de edición",
    "active": true,
    "permissions": [
        "users.view",
        "users.edit"
    ]
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-roles">
            <blockquote>
            <p>Example response (201, Rol creado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Success&quot;,
    &quot;message&quot;: &quot;Rol creado exitosamente&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 3,
        &quot;name&quot;: &quot;Editor&quot;,
        &quot;description&quot;: &quot;Rol con acceso de edici&oacute;n&quot;,
        &quot;active&quot;: true,
        &quot;permissions&quot;: {
            &quot;users&quot;: [
                &quot;users.view&quot;,
                &quot;users.edit&quot;
            ]
        }
    },
    &quot;code&quot;: 201
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Sin permiso):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;No tienes permiso para realizar esta acci&oacute;n.&quot;,
    &quot;code&quot;: 403
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Nombre duplicado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;Los datos proporcionados no son v&aacute;lidos&quot;,
    &quot;errors&quot;: {
        &quot;name&quot;: [
            &quot;El nombre del rol ya est&aacute; en uso.&quot;
        ]
    },
    &quot;code&quot;: 422
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-roles" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-roles"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-roles"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-roles" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-roles">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-roles" data-method="POST"
      data-path="api/roles"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-roles', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-roles"
                    onclick="tryItOut('POSTapi-roles');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-roles"
                    onclick="cancelTryOut('POSTapi-roles');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-roles"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/roles</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-roles"
               value="Bearer {BEARER_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {BEARER_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-roles"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-roles"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-roles"
               value="Editor"
               data-component="body">
    <br>
<p>Nombre del rol (único, máx. 100 caracteres). Example: <code>Editor</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-roles"
               value="Rol con acceso de edición"
               data-component="body">
    <br>
<p>Descripción del rol (opcional, máx. 255 caracteres). Example: <code>Rol con acceso de edición</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-roles" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="POSTapi-roles"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-roles" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="POSTapi-roles"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Si el rol está activo (por defecto: true). Example: <code>true</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>permissions</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="permissions[0]"                data-endpoint="POSTapi-roles"
               data-component="body">
        <input type="text" style="display: none"
               name="permissions[1]"                data-endpoint="POSTapi-roles"
               data-component="body">
    <br>
<p>Nombres de permisos a asignar.</p>
        </div>
        </form>

                    <h2 id="roles-y-permisos-GETapi-roles--id-">Obtener rol</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retorna los datos de un rol específico con sus permisos agrupados por módulo.</p>

<span id="example-requests-GETapi-roles--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/roles/1" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/roles/1"
);

const headers = {
    "Authorization": "Bearer {BEARER_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-roles--id-">
            <blockquote>
            <p>Example response (200, Rol encontrado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Success&quot;,
    &quot;message&quot;: &quot;Rol obtenido exitosamente&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Administrator&quot;,
        &quot;description&quot;: &quot;Rol con acceso total&quot;,
        &quot;active&quot;: true,
        &quot;permissions&quot;: {
            &quot;users&quot;: [
                &quot;users.view&quot;,
                &quot;users.add&quot;,
                &quot;users.edit&quot;,
                &quot;users.destroy&quot;
            ],
            &quot;roles&quot;: [
                &quot;roles.view&quot;,
                &quot;roles.edit&quot;
            ]
        },
        &quot;permissions_count&quot;: 6
    },
    &quot;code&quot;: 200
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Sin permiso):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;No tienes permiso para realizar esta acci&oacute;n.&quot;,
    &quot;code&quot;: 403
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, No encontrado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;El rol no fue encontrado&quot;,
    &quot;code&quot;: 404
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-roles--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-roles--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-roles--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-roles--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-roles--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-roles--id-" data-method="GET"
      data-path="api/roles/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-roles--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-roles--id-"
                    onclick="tryItOut('GETapi-roles--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-roles--id-"
                    onclick="cancelTryOut('GETapi-roles--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-roles--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/roles/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-roles--id-"
               value="Bearer {BEARER_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {BEARER_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-roles--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-roles--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-roles--id-"
               value="1"
               data-component="url">
    <br>
<p>ID del rol. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="roles-y-permisos-PUTapi-roles--id-">Actualizar rol</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Actualiza los campos de un rol existente. Si se envía <code>permissions</code>, se sincronizan.</p>

<span id="example-requests-PUTapi-roles--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/roles/1" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"Super Admin\",
    \"description\": \"Rol principal del sistema\",
    \"active\": true,
    \"permissions\": [
        \"users.view\",
        \"users.edit\"
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/roles/1"
);

const headers = {
    "Authorization": "Bearer {BEARER_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Super Admin",
    "description": "Rol principal del sistema",
    "active": true,
    "permissions": [
        "users.view",
        "users.edit"
    ]
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-roles--id-">
            <blockquote>
            <p>Example response (200, Actualizado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Success&quot;,
    &quot;message&quot;: &quot;Rol actualizado exitosamente&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Super Admin&quot;
    },
    &quot;code&quot;: 200
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Sin permiso):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;No tienes permiso para realizar esta acci&oacute;n.&quot;,
    &quot;code&quot;: 403
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, No encontrado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;El rol no fue encontrado&quot;,
    &quot;code&quot;: 404
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-roles--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-roles--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-roles--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-roles--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-roles--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-roles--id-" data-method="PUT"
      data-path="api/roles/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-roles--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-roles--id-"
                    onclick="tryItOut('PUTapi-roles--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-roles--id-"
                    onclick="cancelTryOut('PUTapi-roles--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-roles--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/roles/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/roles/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-roles--id-"
               value="Bearer {BEARER_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {BEARER_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-roles--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-roles--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-roles--id-"
               value="1"
               data-component="url">
    <br>
<p>ID del rol a actualizar. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-roles--id-"
               value="Super Admin"
               data-component="body">
    <br>
<p>Nuevo nombre del rol (único). Example: <code>Super Admin</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="PUTapi-roles--id-"
               value="Rol principal del sistema"
               data-component="body">
    <br>
<p>Descripción del rol. Example: <code>Rol principal del sistema</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PUTapi-roles--id-" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="PUTapi-roles--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-roles--id-" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="PUTapi-roles--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Estado del rol. Example: <code>true</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>permissions</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="permissions[0]"                data-endpoint="PUTapi-roles--id-"
               data-component="body">
        <input type="text" style="display: none"
               name="permissions[1]"                data-endpoint="PUTapi-roles--id-"
               data-component="body">
    <br>
<p>Permisos a sincronizar (opcional).</p>
        </div>
        </form>

                    <h2 id="roles-y-permisos-DELETEapi-roles--id-">Eliminar rol</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Elimina un rol del sistema. No se puede eliminar si tiene usuarios asignados.</p>

<span id="example-requests-DELETEapi-roles--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/roles/3" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/roles/3"
);

const headers = {
    "Authorization": "Bearer {BEARER_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-roles--id-">
            <blockquote>
            <p>Example response (200, Eliminado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Success&quot;,
    &quot;message&quot;: &quot;Rol eliminado exitosamente&quot;,
    &quot;data&quot;: [],
    &quot;code&quot;: 200
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Sin permiso):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;No tienes permiso para realizar esta acci&oacute;n.&quot;,
    &quot;code&quot;: 403
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, No encontrado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;El rol no fue encontrado&quot;,
    &quot;code&quot;: 404
}</code>
 </pre>
            <blockquote>
            <p>Example response (409, Tiene usuarios):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;El rol tiene usuarios asignados y no puede eliminarse.&quot;,
    &quot;code&quot;: 409
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-roles--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-roles--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-roles--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-roles--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-roles--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-roles--id-" data-method="DELETE"
      data-path="api/roles/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-roles--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-roles--id-"
                    onclick="tryItOut('DELETEapi-roles--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-roles--id-"
                    onclick="cancelTryOut('DELETEapi-roles--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-roles--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/roles/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-roles--id-"
               value="Bearer {BEARER_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {BEARER_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-roles--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-roles--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-roles--id-"
               value="3"
               data-component="url">
    <br>
<p>ID del rol a eliminar. Example: <code>3</code></p>
            </div>
                    </form>

                    <h2 id="roles-y-permisos-POSTapi-roles--id--activate">Activar rol</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Activa un rol que se encontraba inactivo.</p>

<span id="example-requests-POSTapi-roles--id--activate">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/roles/2/activate" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/roles/2/activate"
);

const headers = {
    "Authorization": "Bearer {BEARER_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-roles--id--activate">
            <blockquote>
            <p>Example response (200, Activado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Success&quot;,
    &quot;message&quot;: &quot;Rol activado exitosamente&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 2,
        &quot;name&quot;: &quot;Editor&quot;,
        &quot;active&quot;: true
    },
    &quot;code&quot;: 200
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Sin permiso):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;No tienes permiso para realizar esta acci&oacute;n.&quot;,
    &quot;code&quot;: 403
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, No encontrado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;El rol no fue encontrado&quot;,
    &quot;code&quot;: 404
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-roles--id--activate" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-roles--id--activate"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-roles--id--activate"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-roles--id--activate" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-roles--id--activate">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-roles--id--activate" data-method="POST"
      data-path="api/roles/{id}/activate"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-roles--id--activate', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-roles--id--activate"
                    onclick="tryItOut('POSTapi-roles--id--activate');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-roles--id--activate"
                    onclick="cancelTryOut('POSTapi-roles--id--activate');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-roles--id--activate"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/roles/{id}/activate</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-roles--id--activate"
               value="Bearer {BEARER_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {BEARER_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-roles--id--activate"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-roles--id--activate"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="POSTapi-roles--id--activate"
               value="2"
               data-component="url">
    <br>
<p>ID del rol a activar. Example: <code>2</code></p>
            </div>
                    </form>

                    <h2 id="roles-y-permisos-POSTapi-roles--id--deactivate">Desactivar rol</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Desactiva un rol sin eliminarlo del sistema.</p>

<span id="example-requests-POSTapi-roles--id--deactivate">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/roles/2/deactivate" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/roles/2/deactivate"
);

const headers = {
    "Authorization": "Bearer {BEARER_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-roles--id--deactivate">
            <blockquote>
            <p>Example response (200, Desactivado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Success&quot;,
    &quot;message&quot;: &quot;Rol desactivado exitosamente&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 2,
        &quot;name&quot;: &quot;Editor&quot;,
        &quot;active&quot;: false
    },
    &quot;code&quot;: 200
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Sin permiso):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;No tienes permiso para realizar esta acci&oacute;n.&quot;,
    &quot;code&quot;: 403
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, No encontrado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;El rol no fue encontrado&quot;,
    &quot;code&quot;: 404
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-roles--id--deactivate" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-roles--id--deactivate"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-roles--id--deactivate"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-roles--id--deactivate" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-roles--id--deactivate">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-roles--id--deactivate" data-method="POST"
      data-path="api/roles/{id}/deactivate"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-roles--id--deactivate', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-roles--id--deactivate"
                    onclick="tryItOut('POSTapi-roles--id--deactivate');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-roles--id--deactivate"
                    onclick="cancelTryOut('POSTapi-roles--id--deactivate');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-roles--id--deactivate"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/roles/{id}/deactivate</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-roles--id--deactivate"
               value="Bearer {BEARER_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {BEARER_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-roles--id--deactivate"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-roles--id--deactivate"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="POSTapi-roles--id--deactivate"
               value="2"
               data-component="url">
    <br>
<p>ID del rol a desactivar. Example: <code>2</code></p>
            </div>
                    </form>

                    <h2 id="roles-y-permisos-POSTapi-roles--id--permissions">Sincronizar permisos del rol</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Reemplaza todos los permisos del rol con los enviados en el payload.
Usa <code>syncPermissions()</code> de Spatie.</p>

<span id="example-requests-POSTapi-roles--id--permissions">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/roles/1/permissions" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"permissions\": [
        \"users.view\",
        \"users.add\",
        \"users.edit\"
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/roles/1/permissions"
);

const headers = {
    "Authorization": "Bearer {BEARER_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "permissions": [
        "users.view",
        "users.add",
        "users.edit"
    ]
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-roles--id--permissions">
            <blockquote>
            <p>Example response (200, Permisos sincronizados):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Success&quot;,
    &quot;message&quot;: &quot;Permisos del rol sincronizados exitosamente&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Administrator&quot;,
        &quot;permissions&quot;: {
            &quot;users&quot;: [
                &quot;users.view&quot;,
                &quot;users.add&quot;
            ]
        }
    },
    &quot;code&quot;: 200
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Sin permiso):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;No tienes permiso para realizar esta acci&oacute;n.&quot;,
    &quot;code&quot;: 403
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, No encontrado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;El rol no fue encontrado&quot;,
    &quot;code&quot;: 404
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Permiso inválido):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;Los datos proporcionados no son v&aacute;lidos&quot;,
    &quot;errors&quot;: {
        &quot;permissions.0&quot;: [
            &quot;Uno o m&aacute;s permisos especificados no existen.&quot;
        ]
    },
    &quot;code&quot;: 422
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-roles--id--permissions" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-roles--id--permissions"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-roles--id--permissions"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-roles--id--permissions" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-roles--id--permissions">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-roles--id--permissions" data-method="POST"
      data-path="api/roles/{id}/permissions"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-roles--id--permissions', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-roles--id--permissions"
                    onclick="tryItOut('POSTapi-roles--id--permissions');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-roles--id--permissions"
                    onclick="cancelTryOut('POSTapi-roles--id--permissions');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-roles--id--permissions"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/roles/{id}/permissions</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-roles--id--permissions"
               value="Bearer {BEARER_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {BEARER_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-roles--id--permissions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-roles--id--permissions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="POSTapi-roles--id--permissions"
               value="1"
               data-component="url">
    <br>
<p>ID del rol. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>permissions</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="permissions[0]"                data-endpoint="POSTapi-roles--id--permissions"
               data-component="body">
        <input type="text" style="display: none"
               name="permissions[1]"                data-endpoint="POSTapi-roles--id--permissions"
               data-component="body">
    <br>
<p>Nombres de permisos a asignar.</p>
        </div>
        </form>

                <h1 id="permisos">Permisos</h1>

    

                                <h2 id="permisos-GETapi-permissions">Listar permisos</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retorna todos los permisos del sistema paginados.
Cada permiso incluye el campo <code>module</code> extraído del prefijo del nombre
(ej: <code>users.add</code> → módulo <code>users</code>).</p>

<span id="example-requests-GETapi-permissions">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/permissions?take=50&amp;skip=0&amp;search=users" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/permissions"
);

const params = {
    "take": "50",
    "skip": "0",
    "search": "users",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer {BEARER_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-permissions">
            <blockquote>
            <p>Example response (200, Lista de permisos):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Success&quot;,
    &quot;message&quot;: &quot;Permisos obtenidos exitosamente&quot;,
    &quot;data&quot;: {
        &quot;records&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;users.view&quot;,
                &quot;module&quot;: &quot;users&quot;,
                &quot;guard_name&quot;: &quot;api&quot;
            },
            {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;users.add&quot;,
                &quot;module&quot;: &quot;users&quot;,
                &quot;guard_name&quot;: &quot;api&quot;
            },
            {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;roles.view&quot;,
                &quot;module&quot;: &quot;roles&quot;,
                &quot;guard_name&quot;: &quot;api&quot;
            }
        ],
        &quot;pagination&quot;: {
            &quot;total&quot;: 15,
            &quot;take&quot;: 50,
            &quot;skip&quot;: 0,
            &quot;pages&quot;: 1,
            &quot;current_page&quot;: 1
        }
    },
    &quot;code&quot;: 200
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, No autenticado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Sin permiso):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;No tienes permiso para realizar esta acci&oacute;n.&quot;,
    &quot;code&quot;: 403
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-permissions" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-permissions"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-permissions"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-permissions" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-permissions">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-permissions" data-method="GET"
      data-path="api/permissions"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-permissions', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-permissions"
                    onclick="tryItOut('GETapi-permissions');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-permissions"
                    onclick="cancelTryOut('GETapi-permissions');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-permissions"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/permissions</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-permissions"
               value="Bearer {BEARER_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {BEARER_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-permissions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-permissions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>take</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="take"                data-endpoint="GETapi-permissions"
               value="50"
               data-component="query">
    <br>
<p>Número de registros a retornar (1-100). Por defecto: 50. Example: <code>50</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>skip</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="skip"                data-endpoint="GETapi-permissions"
               value="0"
               data-component="query">
    <br>
<p>Número de registros a saltar (offset). Por defecto: 0. Example: <code>0</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>search</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="search"                data-endpoint="GETapi-permissions"
               value="users"
               data-component="query">
    <br>
<p>Término de búsqueda por nombre del permiso. Example: <code>users</code></p>
            </div>
                </form>

                    <h2 id="permisos-GETapi-permissions--id-">Obtener permiso</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retorna los datos de un permiso específico, incluyendo el módulo al que pertenece.</p>

<span id="example-requests-GETapi-permissions--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/permissions/1" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/permissions/1"
);

const headers = {
    "Authorization": "Bearer {BEARER_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-permissions--id-">
            <blockquote>
            <p>Example response (200, Permiso encontrado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Success&quot;,
    &quot;message&quot;: &quot;Permiso obtenido exitosamente&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;users.view&quot;,
        &quot;module&quot;: &quot;users&quot;,
        &quot;guard_name&quot;: &quot;api&quot;
    },
    &quot;code&quot;: 200
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Sin permiso):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;No tienes permiso para realizar esta acci&oacute;n.&quot;,
    &quot;code&quot;: 403
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, No encontrado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;Error&quot;,
    &quot;message&quot;: &quot;El permiso no fue encontrado&quot;,
    &quot;code&quot;: 404
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-permissions--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-permissions--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-permissions--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-permissions--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-permissions--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-permissions--id-" data-method="GET"
      data-path="api/permissions/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-permissions--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-permissions--id-"
                    onclick="tryItOut('GETapi-permissions--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-permissions--id-"
                    onclick="cancelTryOut('GETapi-permissions--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-permissions--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/permissions/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-permissions--id-"
               value="Bearer {BEARER_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {BEARER_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-permissions--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-permissions--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-permissions--id-"
               value="1"
               data-component="url">
    <br>
<p>ID del permiso. Example: <code>1</code></p>
            </div>
                    </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
