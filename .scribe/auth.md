# Authenticating requests

To authenticate requests, include an **`Authorization`** header with the value **`"Bearer {SECRET_KEY}"`**.

All authenticated endpoints are marked with a `requires authentication` badge in the documentation below.

You can retrieve a token by sending a login request via postman and copying the <b>generated API token</b>.
