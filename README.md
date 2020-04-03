Socket API
---
###
Request:
````
{
    "token": "da39a3ee5e6b4b0d3255bfef95601890afd80709",
    "method": "security.auth",
    "data": {
        "token": "da39a3ee5e6b4b0d3255bfef95601890afd80709"
    }
}
````

Response:
  
- json as described in method description

---
####Security
**"security.auth"**

request data:
- token [_string_]
response:

**"security.login"**
request data:
- username [_string_]
- password [_string_]

---
####World
**"world.get"**
request data:
- token [_string_]

**"world.list"**

**"world.online"**


####StarSystem
**"system.get"**