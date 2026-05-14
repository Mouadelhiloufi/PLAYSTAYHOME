release: php artisan migrate --force && php artisan db:seed --force
web: vendor/bin/heroku-php-apache2 public/
worker: php artisan queue:work database --queue=default --sleep=1 --tries=3 --timeout=120
