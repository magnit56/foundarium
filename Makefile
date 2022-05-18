start:
	php artisan serve --host 127.0.0.1

setup:
	composer install
	php artisan key:gen --ansi
	php artisan migrate:fresh --seed
	npm i --no-optional
	npm run dev
