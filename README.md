## Install xampp
https://www.apachefriends.org/download.html <br>

## Install Composer
https://getcomposer.org/download/ <br>
Check composer version with terminal <br>
`composer --version`

## Install project
#### Move to folder `htdocs` of xampp
`cd /path/to/folder/htdocs` <br>

#### After clone project
```
cd /Project
composer update
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve
```
