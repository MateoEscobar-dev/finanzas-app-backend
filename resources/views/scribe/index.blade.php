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
                                                    <li class="tocify-item level-2" data-unique="usuarios-GETapi-user">
                                <a href="#usuarios-GETapi-user">Listar usuarios</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="usuarios-POSTapi-user">
                                <a href="#usuarios-POSTapi-user">Crear usuario</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="usuarios-GETapi-user--id-">
                                <a href="#usuarios-GETapi-user--id-">Obtener usuario</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="usuarios-PUTapi-user--id-">
                                <a href="#usuarios-PUTapi-user--id-">Actualizar usuario</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="usuarios-DELETEapi-user--id-">
                                <a href="#usuarios-DELETEapi-user--id-">Eliminar usuario</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="usuarios-POSTapi-user--user--activate">
                                <a href="#usuarios-POSTapi-user--user--activate">Activar usuario</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="usuarios-POSTapi-user--user--deactivate">
                                <a href="#usuarios-POSTapi-user--user--deactivate">Desactivar usuario</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="usuarios-GETapi-user--user--history">
                                <a href="#usuarios-GETapi-user--user--history">Historial de actividad del usuario</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="usuarios-POSTapi-user--user--language">
                                <a href="#usuarios-POSTapi-user--user--language">Actualizar idioma del usuario</a>
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
                                                                                <li class="tocify-item level-2" data-unique="roles-y-permisos-GETapi-roles--id-">
                                <a href="#roles-y-permisos-GETapi-roles--id-">Obtener rol</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="roles-y-permisos-GETapi-permissions">
                                <a href="#roles-y-permisos-GETapi-permissions">Listar permisos</a>
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

    

                                <h2 id="usuarios-GETapi-user">Listar usuarios</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retorna una lista paginada de usuarios del sistema.
Soporta búsqueda por nombre, email o documento.</p>

<span id="example-requests-GETapi-user">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/user?take=10&amp;skip=0&amp;search=Juan" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/user"
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

<span id="example-responses-GETapi-user">
            <blockquote>
            <p>Example response (200, Lista de usuarios):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Usuarios obtenidos exitosamente&quot;,
    &quot;data&quot;: {
        &quot;records&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Juan P&eacute;rez&quot;,
                &quot;email&quot;: &quot;usuario@ejemplo.com&quot;,
                &quot;document&quot;: &quot;****&quot;,
                &quot;first_name&quot;: &quot;Juan&quot;,
                &quot;second_name&quot;: null,
                &quot;first_last_name&quot;: &quot;P&eacute;rez&quot;,
                &quot;second_last_name&quot;: null,
                &quot;address&quot;: &quot;****&quot;,
                &quot;phone&quot;: &quot;****&quot;,
                &quot;phone_ext&quot;: null,
                &quot;birth_day&quot;: &quot;1990-05-15&quot;,
                &quot;lang&quot;: &quot;es&quot;,
                &quot;active&quot;: 1,
                &quot;imagen&quot;: null,
                &quot;email_verified_at&quot;: null,
                &quot;created_at&quot;: &quot;2025-01-01T00:00:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-01-01T00:00:00.000000Z&quot;,
                &quot;roles&quot;: [
                    &quot;User&quot;
                ],
                &quot;permissions&quot;: [
                    &quot;ver-usuarios&quot;
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
<span id="execution-results-GETapi-user" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-user"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-user"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-user" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-user">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-user" data-method="GET"
      data-path="api/user"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-user', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-user"
                    onclick="tryItOut('GETapi-user');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-user"
                    onclick="cancelTryOut('GETapi-user');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-user"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/user</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-user"
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
                              name="Content-Type"                data-endpoint="GETapi-user"
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
                              name="Accept"                data-endpoint="GETapi-user"
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
               step="any"               name="take"                data-endpoint="GETapi-user"
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
               step="any"               name="skip"                data-endpoint="GETapi-user"
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
                              name="search"                data-endpoint="GETapi-user"
               value="Juan"
               data-component="query">
    <br>
<p>Término de búsqueda (nombre, email o documento). Example: <code>Juan</code></p>
            </div>
                </form>

                    <h2 id="usuarios-POSTapi-user">Crear usuario</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Crea un nuevo usuario en el sistema y le asigna un rol con sus permisos correspondientes.
El campo <code>password</code> debe enviarse encriptado en AES-256-CBC.</p>

<span id="example-requests-POSTapi-user">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/user" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
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
    \"birth_day\": \"1990-05-15\",
    \"address\": \"Calle 123 # 45-67\",
    \"lang\": \"es\",
    \"id_rol\": 1
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/user"
);

const headers = {
    "Authorization": "Bearer {BEARER_TOKEN}",
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
    "birth_day": "1990-05-15",
    "address": "Calle 123 # 45-67",
    "lang": "es",
    "id_rol": 1
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-user">
            <blockquote>
            <p>Example response (201, Usuario creado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Usuario creado exitosamente&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 10,
        &quot;name&quot;: &quot;Juan P&eacute;rez&quot;,
        &quot;email&quot;: &quot;nuevo@ejemplo.com&quot;,
        &quot;document&quot;: &quot;****&quot;,
        &quot;first_name&quot;: &quot;Juan&quot;,
        &quot;second_name&quot;: &quot;Carlos&quot;,
        &quot;first_last_name&quot;: &quot;P&eacute;rez&quot;,
        &quot;second_last_name&quot;: &quot;G&oacute;mez&quot;,
        &quot;address&quot;: &quot;****&quot;,
        &quot;phone&quot;: &quot;****&quot;,
        &quot;phone_ext&quot;: 101,
        &quot;birth_day&quot;: &quot;1990-05-15&quot;,
        &quot;lang&quot;: &quot;es&quot;,
        &quot;active&quot;: 1,
        &quot;imagen&quot;: null,
        &quot;roles&quot;: [
            &quot;User&quot;
        ],
        &quot;permissions&quot;: [
            &quot;ver-usuarios&quot;
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
            <p>Example response (422, Rol no encontrado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;El rol especificado no existe&quot;,
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
            &quot;El correo electr&oacute;nico ya est&aacute; registrado.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-user" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-user"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-user"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-user" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-user">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-user" data-method="POST"
      data-path="api/user"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-user', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-user"
                    onclick="tryItOut('POSTapi-user');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-user"
                    onclick="cancelTryOut('POSTapi-user');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-user"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/user</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-user"
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
                              name="Content-Type"                data-endpoint="POSTapi-user"
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
                              name="Accept"                data-endpoint="POSTapi-user"
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
                              name="document"                data-endpoint="POSTapi-user"
               value="12345678"
               data-component="body">
    <br>
<p>Documento de identidad (único, máx. 20 caracteres). Example: <code>12345678</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>first_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="first_name"                data-endpoint="POSTapi-user"
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
                              name="second_name"                data-endpoint="POSTapi-user"
               value="Carlos"
               data-component="body">
    <br>
<p>Segundo nombre (opcional). Example: <code>Carlos</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>first_last_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="first_last_name"                data-endpoint="POSTapi-user"
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
                              name="second_last_name"                data-endpoint="POSTapi-user"
               value="Gómez"
               data-component="body">
    <br>
<p>Segundo apellido (opcional). Example: <code>Gómez</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-user"
               value="nuevo@ejemplo.com"
               data-component="body">
    <br>
<p>Correo electrónico válido y único. Example: <code>nuevo@ejemplo.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-user"
               value="U2FsdGVkX1+xyz..."
               data-component="body">
    <br>
<p>Contraseña encriptada AES-256-CBC. Example: <code>U2FsdGVkX1+xyz...</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="POSTapi-user"
               value="+573001234567"
               data-component="body">
    <br>
<p>Teléfono en formato E.164. Example: <code>+573001234567</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone_ext</code></b>&nbsp;&nbsp;
<small>numeric</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone_ext"                data-endpoint="POSTapi-user"
               value="101"
               data-component="body">
    <br>
<p>Extensión telefónica (opcional). Example: <code>101</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>birth_day</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="birth_day"                data-endpoint="POSTapi-user"
               value="1990-05-15"
               data-component="body">
    <br>
<p>Fecha de nacimiento YYYY-MM-DD. Debe ser mayor de 18 años. Example: <code>1990-05-15</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address"                data-endpoint="POSTapi-user"
               value="Calle 123 # 45-67"
               data-component="body">
    <br>
<p>Dirección (opcional). Example: <code>Calle 123 # 45-67</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>lang</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="lang"                data-endpoint="POSTapi-user"
               value="es"
               data-component="body">
    <br>
<p>Idioma preferido del usuario (es|en). Por defecto: es. Example: <code>es</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>id_rol</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id_rol"                data-endpoint="POSTapi-user"
               value="1"
               data-component="body">
    <br>
<p>ID del rol a asignar (ver GET /api/roles). Example: <code>1</code></p>
        </div>
        </form>

                    <h2 id="usuarios-GETapi-user--id-">Obtener usuario</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retorna los datos completos de un usuario específico, incluyendo roles y permisos.</p>

<span id="example-requests-GETapi-user--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/user/1" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/user/1"
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

<span id="example-responses-GETapi-user--id-">
            <blockquote>
            <p>Example response (200, Usuario encontrado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Usuario obtenido exitosamente&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Juan P&eacute;rez&quot;,
        &quot;email&quot;: &quot;usuario@ejemplo.com&quot;,
        &quot;document&quot;: &quot;****&quot;,
        &quot;first_name&quot;: &quot;Juan&quot;,
        &quot;second_name&quot;: null,
        &quot;first_last_name&quot;: &quot;P&eacute;rez&quot;,
        &quot;second_last_name&quot;: null,
        &quot;address&quot;: &quot;****&quot;,
        &quot;phone&quot;: &quot;****&quot;,
        &quot;phone_ext&quot;: null,
        &quot;birth_day&quot;: &quot;1990-05-15&quot;,
        &quot;lang&quot;: &quot;es&quot;,
        &quot;active&quot;: 1,
        &quot;imagen&quot;: null,
        &quot;email_verified_at&quot;: null,
        &quot;created_at&quot;: &quot;2025-01-01T00:00:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-01-01T00:00:00.000000Z&quot;,
        &quot;roles&quot;: [
            &quot;User&quot;
        ],
        &quot;permissions&quot;: [
            &quot;ver-usuarios&quot;
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
            <p>Example response (404, Usuario no encontrado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;El usuario no fue encontrado&quot;,
    &quot;errors&quot;: &quot;&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-user--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-user--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-user--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-user--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-user--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-user--id-" data-method="GET"
      data-path="api/user/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-user--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-user--id-"
                    onclick="tryItOut('GETapi-user--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-user--id-"
                    onclick="cancelTryOut('GETapi-user--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-user--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/user/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-user--id-"
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
                              name="Content-Type"                data-endpoint="GETapi-user--id-"
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
                              name="Accept"                data-endpoint="GETapi-user--id-"
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
               step="any"               name="id"                data-endpoint="GETapi-user--id-"
               value="1"
               data-component="url">
    <br>
<p>ID del usuario. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="usuarios-PUTapi-user--id-">Actualizar usuario</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Actualiza los datos de un usuario existente. Solo se procesan los campos enviados.
Si se envía <code>id_rol</code>, se sincroniza el rol y sus permisos.
No se actualiza la contraseña si se envía vacía.</p>

<span id="example-requests-PUTapi-user--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/user/1" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"document\": \"12345678\",
    \"first_name\": \"Juan\",
    \"second_name\": \"Carlos\",
    \"first_last_name\": \"Pérez\",
    \"second_last_name\": \"Gómez\",
    \"email\": \"actualizado@ejemplo.com\",
    \"phone\": \"+573001234567\",
    \"phone_ext\": \"101\",
    \"birth_day\": \"1990-05-15\",
    \"address\": \"Calle 123 # 45-67\",
    \"lang\": \"es\",
    \"id_rol\": 2
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/user/1"
);

const headers = {
    "Authorization": "Bearer {BEARER_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "document": "12345678",
    "first_name": "Juan",
    "second_name": "Carlos",
    "first_last_name": "Pérez",
    "second_last_name": "Gómez",
    "email": "actualizado@ejemplo.com",
    "phone": "+573001234567",
    "phone_ext": "101",
    "birth_day": "1990-05-15",
    "address": "Calle 123 # 45-67",
    "lang": "es",
    "id_rol": 2
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-user--id-">
            <blockquote>
            <p>Example response (200, Usuario actualizado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Usuario actualizado exitosamente&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Juan P&eacute;rez&quot;,
        &quot;email&quot;: &quot;actualizado@ejemplo.com&quot;,
        &quot;roles&quot;: [
            &quot;Admin&quot;
        ],
        &quot;permissions&quot;: [
            &quot;ver-usuarios&quot;,
            &quot;crear-usuarios&quot;
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
            <p>Example response (404, Usuario no encontrado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;El usuario no fue encontrado&quot;,
    &quot;errors&quot;: &quot;&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Rol no encontrado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;El rol especificado no existe&quot;,
    &quot;errors&quot;: &quot;&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-user--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-user--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-user--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-user--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-user--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-user--id-" data-method="PUT"
      data-path="api/user/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-user--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-user--id-"
                    onclick="tryItOut('PUTapi-user--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-user--id-"
                    onclick="cancelTryOut('PUTapi-user--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-user--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/user/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/user/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-user--id-"
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
                              name="Content-Type"                data-endpoint="PUTapi-user--id-"
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
                              name="Accept"                data-endpoint="PUTapi-user--id-"
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
               step="any"               name="id"                data-endpoint="PUTapi-user--id-"
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
                              name="document"                data-endpoint="PUTapi-user--id-"
               value="12345678"
               data-component="body">
    <br>
<p>Documento de identidad (único). Example: <code>12345678</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>first_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="first_name"                data-endpoint="PUTapi-user--id-"
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
                              name="second_name"                data-endpoint="PUTapi-user--id-"
               value="Carlos"
               data-component="body">
    <br>
<p>Segundo nombre (opcional). Example: <code>Carlos</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>first_last_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="first_last_name"                data-endpoint="PUTapi-user--id-"
               value="Pérez"
               data-component="body">
    <br>
<p>Primer apellido. Example: <code>Pérez</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>second_last_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="second_last_name"                data-endpoint="PUTapi-user--id-"
               value="Gómez"
               data-component="body">
    <br>
<p>Segundo apellido (opcional). Example: <code>Gómez</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="PUTapi-user--id-"
               value="actualizado@ejemplo.com"
               data-component="body">
    <br>
<p>Correo electrónico válido y único. Example: <code>actualizado@ejemplo.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="PUTapi-user--id-"
               value="+573001234567"
               data-component="body">
    <br>
<p>Teléfono en formato E.164. Example: <code>+573001234567</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone_ext</code></b>&nbsp;&nbsp;
<small>numeric</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone_ext"                data-endpoint="PUTapi-user--id-"
               value="101"
               data-component="body">
    <br>
<p>Extensión telefónica (opcional). Example: <code>101</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>birth_day</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="birth_day"                data-endpoint="PUTapi-user--id-"
               value="1990-05-15"
               data-component="body">
    <br>
<p>Fecha de nacimiento YYYY-MM-DD. Example: <code>1990-05-15</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address"                data-endpoint="PUTapi-user--id-"
               value="Calle 123 # 45-67"
               data-component="body">
    <br>
<p>Dirección (opcional). Example: <code>Calle 123 # 45-67</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>lang</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="lang"                data-endpoint="PUTapi-user--id-"
               value="es"
               data-component="body">
    <br>
<p>Idioma preferido (es|en). Example: <code>es</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>id_rol</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id_rol"                data-endpoint="PUTapi-user--id-"
               value="2"
               data-component="body">
    <br>
<p>ID del nuevo rol a asignar. Example: <code>2</code></p>
        </div>
        </form>

                    <h2 id="usuarios-DELETEapi-user--id-">Eliminar usuario</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Elimina permanentemente un usuario del sistema junto con sus roles,
permisos y tokens de sesión. No se puede eliminar al usuario autenticado.</p>

<span id="example-requests-DELETEapi-user--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/user/5" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/user/5"
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

<span id="example-responses-DELETEapi-user--id-">
            <blockquote>
            <p>Example response (200, Usuario eliminado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Usuario eliminado exitosamente&quot;,
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
            <blockquote>
            <p>Example response (403, Intento de eliminar cuenta propia):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;No puedes eliminar tu propia cuenta&quot;,
    &quot;errors&quot;: &quot;&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, Usuario no encontrado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;El usuario no fue encontrado&quot;,
    &quot;errors&quot;: &quot;&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-user--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-user--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-user--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-user--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-user--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-user--id-" data-method="DELETE"
      data-path="api/user/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-user--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-user--id-"
                    onclick="tryItOut('DELETEapi-user--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-user--id-"
                    onclick="cancelTryOut('DELETEapi-user--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-user--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/user/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-user--id-"
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
                              name="Content-Type"                data-endpoint="DELETEapi-user--id-"
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
                              name="Accept"                data-endpoint="DELETEapi-user--id-"
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
               step="any"               name="id"                data-endpoint="DELETEapi-user--id-"
               value="5"
               data-component="url">
    <br>
<p>ID del usuario a eliminar. Example: <code>5</code></p>
            </div>
                    </form>

                    <h2 id="usuarios-POSTapi-user--user--activate">Activar usuario</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Activa un usuario que se encontraba inactivo, permitiéndole iniciar sesión nuevamente.</p>

<span id="example-requests-POSTapi-user--user--activate">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/user/3/activate" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/user/3/activate"
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

<span id="example-responses-POSTapi-user--user--activate">
            <blockquote>
            <p>Example response (200, Usuario activado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Usuario activado exitosamente&quot;,
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
            <blockquote>
            <p>Example response (404, Usuario no encontrado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Registro no encontrado&quot;,
    &quot;errors&quot;: &quot;&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-user--user--activate" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-user--user--activate"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-user--user--activate"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-user--user--activate" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-user--user--activate">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-user--user--activate" data-method="POST"
      data-path="api/user/{user}/activate"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-user--user--activate', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-user--user--activate"
                    onclick="tryItOut('POSTapi-user--user--activate');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-user--user--activate"
                    onclick="cancelTryOut('POSTapi-user--user--activate');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-user--user--activate"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/user/{user}/activate</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-user--user--activate"
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
                              name="Content-Type"                data-endpoint="POSTapi-user--user--activate"
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
                              name="Accept"                data-endpoint="POSTapi-user--user--activate"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="user"                data-endpoint="POSTapi-user--user--activate"
               value="3"
               data-component="url">
    <br>
<p>ID del usuario a activar. Example: <code>3</code></p>
            </div>
                    </form>

                    <h2 id="usuarios-POSTapi-user--user--deactivate">Desactivar usuario</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Desactiva un usuario impidiéndole iniciar sesión. Los datos no se eliminan.</p>

<span id="example-requests-POSTapi-user--user--deactivate">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/user/3/deactivate" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/user/3/deactivate"
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

<span id="example-responses-POSTapi-user--user--deactivate">
            <blockquote>
            <p>Example response (200, Usuario desactivado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Usuario desactivado exitosamente&quot;,
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
            <blockquote>
            <p>Example response (404, Usuario no encontrado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Registro no encontrado&quot;,
    &quot;errors&quot;: &quot;&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-user--user--deactivate" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-user--user--deactivate"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-user--user--deactivate"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-user--user--deactivate" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-user--user--deactivate">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-user--user--deactivate" data-method="POST"
      data-path="api/user/{user}/deactivate"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-user--user--deactivate', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-user--user--deactivate"
                    onclick="tryItOut('POSTapi-user--user--deactivate');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-user--user--deactivate"
                    onclick="cancelTryOut('POSTapi-user--user--deactivate');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-user--user--deactivate"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/user/{user}/deactivate</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-user--user--deactivate"
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
                              name="Content-Type"                data-endpoint="POSTapi-user--user--deactivate"
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
                              name="Accept"                data-endpoint="POSTapi-user--user--deactivate"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="user"                data-endpoint="POSTapi-user--user--deactivate"
               value="3"
               data-component="url">
    <br>
<p>ID del usuario a desactivar. Example: <code>3</code></p>
            </div>
                    </form>

                    <h2 id="usuarios-GETapi-user--user--history">Historial de actividad del usuario</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retorna el historial de cambios y actividad registrada del usuario especificado.
Incluye todos los eventos auditados (creación, modificación, etc.).</p>

<span id="example-requests-GETapi-user--user--history">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/user/1/history" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/user/1/history"
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

<span id="example-responses-GETapi-user--user--history">
            <blockquote>
            <p>Example response (200, Historial obtenido):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Historial obtenido exitosamente&quot;,
    &quot;data&quot;: {
        &quot;user&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Juan P&eacute;rez&quot;,
            &quot;email&quot;: &quot;usuario@ejemplo.com&quot;
        },
        &quot;logs&quot;: [
            {
                &quot;id&quot;: 10,
                &quot;table&quot;: &quot;users&quot;,
                &quot;type&quot;: &quot;UPDATE OF THE REGISTRY&quot;,
                &quot;id_item&quot;: 1,
                &quot;reason&quot;: &quot;User information updated&quot;,
                &quot;created_at&quot;: &quot;2025-03-01T12:00:00.000000Z&quot;
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
            <p>Example response (404, Usuario no encontrado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;El usuario no fue encontrado&quot;,
    &quot;errors&quot;: &quot;&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-user--user--history" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-user--user--history"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-user--user--history"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-user--user--history" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-user--user--history">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-user--user--history" data-method="GET"
      data-path="api/user/{user}/history"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-user--user--history', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-user--user--history"
                    onclick="tryItOut('GETapi-user--user--history');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-user--user--history"
                    onclick="cancelTryOut('GETapi-user--user--history');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-user--user--history"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/user/{user}/history</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-user--user--history"
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
                              name="Content-Type"                data-endpoint="GETapi-user--user--history"
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
                              name="Accept"                data-endpoint="GETapi-user--user--history"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="user"                data-endpoint="GETapi-user--user--history"
               value="1"
               data-component="url">
    <br>
<p>ID del usuario. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="usuarios-POSTapi-user--user--language">Actualizar idioma del usuario</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Actualiza la preferencia de idioma del usuario especificado.</p>

<span id="example-requests-POSTapi-user--user--language">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/user/1/language" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"lang\": \"en\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/user/1/language"
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

<span id="example-responses-POSTapi-user--user--language">
            <blockquote>
            <p>Example response (200, Idioma actualizado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Idioma actualizado exitosamente&quot;,
    &quot;data&quot;: {
        &quot;lang&quot;: &quot;en&quot;
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
            <p>Example response (404, Usuario no encontrado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;El usuario no fue encontrado&quot;,
    &quot;errors&quot;: &quot;&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-user--user--language" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-user--user--language"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-user--user--language"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-user--user--language" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-user--user--language">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-user--user--language" data-method="POST"
      data-path="api/user/{user}/language"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-user--user--language', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-user--user--language"
                    onclick="tryItOut('POSTapi-user--user--language');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-user--user--language"
                    onclick="cancelTryOut('POSTapi-user--user--language');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-user--user--language"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/user/{user}/language</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-user--user--language"
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
                              name="Content-Type"                data-endpoint="POSTapi-user--user--language"
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
                              name="Accept"                data-endpoint="POSTapi-user--user--language"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="user"                data-endpoint="POSTapi-user--user--language"
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
                              name="lang"                data-endpoint="POSTapi-user--user--language"
               value="en"
               data-component="body">
    <br>
<p>Código de idioma (es|en). Example: <code>en</code></p>
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

<p>Retorna una lista paginada de roles del sistema con sus permisos asociados.
Soporta búsqueda por nombre de rol.</p>

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
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Roles obtenidos exitosamente&quot;,
    &quot;data&quot;: {
        &quot;records&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Admin&quot;,
                &quot;guard_name&quot;: &quot;api&quot;,
                &quot;created_at&quot;: &quot;2025-01-01T00:00:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-01-01T00:00:00.000000Z&quot;,
                &quot;permissions&quot;: [
                    &quot;ver-usuarios&quot;,
                    &quot;crear-usuarios&quot;,
                    &quot;editar-usuarios&quot;
                ],
                &quot;permissions_count&quot;: 3
            },
            {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;User&quot;,
                &quot;guard_name&quot;: &quot;api&quot;,
                &quot;permissions&quot;: [
                    &quot;ver-usuarios&quot;
                ],
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

                    <h2 id="roles-y-permisos-GETapi-roles--id-">Obtener rol</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retorna los datos de un rol específico con todos sus permisos asignados.</p>

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
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Rol obtenido exitosamente&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Admin&quot;,
        &quot;guard_name&quot;: &quot;api&quot;,
        &quot;created_at&quot;: &quot;2025-01-01T00:00:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-01-01T00:00:00.000000Z&quot;,
        &quot;permissions&quot;: [
            &quot;ver-usuarios&quot;,
            &quot;crear-usuarios&quot;,
            &quot;editar-usuarios&quot;,
            &quot;eliminar-usuarios&quot;
        ],
        &quot;permissions_count&quot;: 4
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
            <p>Example response (404, Rol no encontrado):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;El rol no fue encontrado&quot;,
    &quot;errors&quot;: &quot;&quot;
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

                    <h2 id="roles-y-permisos-GETapi-permissions">Listar permisos</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retorna todos los permisos disponibles en el sistema.
Útil para asignar permisos al crear o actualizar roles.</p>

<span id="example-requests-GETapi-permissions">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/permissions" \
    --header "Authorization: Bearer {BEARER_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/permissions"
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

<span id="example-responses-GETapi-permissions">
            <blockquote>
            <p>Example response (200, Lista de permisos):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Permisos obtenidos exitosamente&quot;,
    &quot;data&quot;: {
        &quot;permissions&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;ver-usuarios&quot;,
                &quot;guard_name&quot;: &quot;api&quot;
            },
            {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;crear-usuarios&quot;,
                &quot;guard_name&quot;: &quot;api&quot;
            },
            {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;editar-usuarios&quot;,
                &quot;guard_name&quot;: &quot;api&quot;
            },
            {
                &quot;id&quot;: 4,
                &quot;name&quot;: &quot;eliminar-usuarios&quot;,
                &quot;guard_name&quot;: &quot;api&quot;
            },
            {
                &quot;id&quot;: 5,
                &quot;name&quot;: &quot;ver-roles&quot;,
                &quot;guard_name&quot;: &quot;api&quot;
            }
        ],
        &quot;count&quot;: 5
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
