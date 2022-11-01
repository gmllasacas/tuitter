## About Laravel

Laravel 8
Sanctum


## Install

Create a tuitter database.

```shell
cp .env.example .env
```

```shell
php artisan key:generate --ansi
```

```shell
php artisan migrate
```

## Done

- Public, Registration: name, unique username, unique email and password.
- Public, Login: username and password
- Logged, User page: "[Tweet]" button shows new page form Create tweet 
- Logged, Create tweet: "[Post]" button and a multi-line text field (280 chars) then redirect to home page (show success alert).
```
    Full name, @username  (link) - Date and time of publication
    Body of the message
```
- Logged, User page: counters # followers, #following
- Public, User page: counters # followers, #following

- Logged, User page: [following] link shows page Following list
- Logged, Following list: Sorted alphabetically (10 by pag.) by full name 
```
    Full name, @username (link)
```
- Logged, Following list: [Follow another user] link shows new page form Follow user
- Logged, Follow another user: input username and "[Follow user]" button then redirect to followed page, if already (show error alert)

- Logged, User page: [followers] link shows page Followers list
- Logged, Followers list: Sorted alphabetically (10 by pag.) by full name 
```
    Full name, @username (link) [Follow] (button)
```
- Logged, Followers list: show "[Follow]" button if not yet followed then redirect to followed page (show success alert)

- Logged (Other), Following list: Sorted alphabetically (10 by pag.) by full name 
- Logged (Other), Followers list: Sorted alphabetically (10 by pag.) by full name 
```
    Full name, @username (link) [Follow] (button)
```
- Logged (Other), Following list: show "[Follow]" button if not yet followed then redirect to followed page (show success alert)
- Logged (Other), Followers list: show "[Follow]" button if not yet followed then redirect to followed page (show success alert)

- Logged (Other), User page: show "[Follow]" button next to their user counters, if not yet followed.

- Logged, User page: Feed of my and following tweets ordered by date (10 by pag.)

- Public, User page: Home logo or link at the top of every page.
- Logged, User page: username at the top of every page.
- Logged, User page: Log out link at the top of every page.
