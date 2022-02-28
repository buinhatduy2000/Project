<h2>Install xampp</h2>
https://www.apachefriends.org/download.html <br>

<h2>Install Composer</h2>
https://getcomposer.org/download/ <br>
Check composer version with terminal <br>
`composer --version`

<h2>Install project</h2>
<h4>Move to folder `htdocs` of xampp</h4>
`cd /path/to/folder/htdocs` <br>

<h4>After clone project </h4>
`composer update` <br>
`cp .env.example .env` <br>
`php artisan key:generate` <br>
`php artisan migrate` <br>
`php artisan db:seed` <br>
`php artisan serve`

