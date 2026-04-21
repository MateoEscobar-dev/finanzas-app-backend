# Authenticating requests

To authenticate requests, include an **`Authorization`** header with the value **`"Bearer {BEARER_TOKEN}"`**.

All authenticated endpoints are marked with a `requires authentication` badge in the documentation below.

Obtén tu token autenticándote en <code>POST /api/login</code> e inclúyelo como <b>Bearer Token</b> en el header <code>Authorization</code>.
