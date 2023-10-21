up:
	- docker compose rm --stop , -f
	- docker compose up --build -d
	- docker compose run --rm app composer install


list:
	- docker compose ps


migrate:
		- docker compose run app php artisan migrate

migrate-fresh:
			 - docker compose run app php artisan migrate:fresh

seed:
	- docker compose run app php artisan db:seed
