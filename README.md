Installation steps:

1. Download repository
2. composer install
3. php artisan migrate --seed
4. Fill .env file with db and mail credentials.

Register user (email is sended after registration):
url: /api/register
params: name, email, password, password_confirmation

Login:
url: /api/login
params: email, password

verify email:
url: /api/email/verify
params: email, password

Reset password:
url: /api/forgot-password
params: email

Logout:
url: /api/logout

Assign or remove user group:
url: /api/menage-user-group
params: name (available: default/writer), action (available: save/delete)

Get all user groups:
url: /api/get-all-user-groups

Get Your user groups:
url: /api/get-user-groups

Get products (available for "default" user group):
url: /api/products

Get posts (available for "writer" user group, this group is available, you need to assign group "writer" to yourself first):
url: /api/posts
