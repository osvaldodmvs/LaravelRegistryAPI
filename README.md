# Simple Laravel User Registry/Login and Management Interface and corresponding API

As the title implies, a simple laravel registration project that enables registry, login and visualization of users.

Users are divided in admins and normal (non-admin) users, and only admins can check more sensible information (address, phone, etc), edit, directly create or even delete other users.

Implemented some simple, search by name and filter by profession functionalities that can still be improved. 

### API Access


The API makes use of Laravel's Sanctum, with only registry and login being available without authentication via Bearer token. 

The login itself promptly returns a token for the user to save and futurely use in the header of the request as the authentication value for the "Authorization" key. A "logout" handler is also provived that just revokes the token and deletes it from the database, implemented just because it was useful for testing token logic and "GUI-free" login on different users.

#### _Example_

```http
  token = laravel_sanctum_O8OKNGJG4BO8YfpGZGCddZBpcrlNTTH8pofrACEwd253f86d
```
| Header |
| :---------- |
| Key   | Value      | 
| `Authorization` | `Bearer laravel_sanctum_O8OKNGJG4BO8YfpGZGCddZBpcrlNTTH8pofrACEwd253f86d` 

Also, just as is the case via the GUI, a middleware is implemented so that only admins can access, modify or delete more sensible information.
