## Aplikacja w Symfony 6.

1. Aplikacja ma za pomocą komendy konsolowej pobierać posty _(końcówka/posts)_ a API REST https://jsonplaceholder.typicode.com i zapisywać je do bazy wraz z imieniem i nazwiskiem autora _(pobrane w relacji z końcówki/users)_.
1. Aplikacja na podstronie `/lista` powinna wyświetlać listę pobranych postów z możliwości ich usunięcia z lokalnej bazy danych. Podstrona ta ma być dostępna po zalogowaniu - proszę użyć wbudowanych modułów autoryzacyjnych.
1. Z pomocą API platform aplikacja ma udostępniać końcówkę `/posts` z metodą GET do pobierania postów z lokalnej bazy danych.

---

## Installation steps

* [x] git clone https://github.com/DamianmG/test-project.git
* [x] cd test-project
* [x] composer install
* [x] php bin/console doctrine:database:create
* [x] php bin/console doctrine:migrations:migrate
* [x] symfony server:start
* [x] symfony console app:fetch-posts
---

## Tasks

* [x] Bootstrap Symfony project.
* [x] `FetchPostsCommand` class created. Posts can be fetched.
* [x] Posts can be stored in database.
* [x] User authentication added.
* [x] Removing posts added.
* [x] `api-platform` installed and `/api/posts` endpoint created.
* [x] Added `README`.
* [ ] Setup hosting.
* [ ] Added unit tests.
* [ ] Added documentation.

---

## Contact

__Damian Gdula__

gduladamian@gmail.com / 667 840 755
