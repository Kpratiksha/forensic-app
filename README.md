## Instructions to setup this project
1. 'npm install' to install all node modules
2. 'composer install' to install php packages
3. Create a mariadb database
4. Update .env file with correct mysql connection details (hostname, db_name, db_user, db_passowrd)
5. Run 'php artisan migrate:refresh'
6. 'php artisan server' to deploy the app

sudo mysqldump -u root --databases bitcoin_db > bitcoin_db.sql
composer dump-autoload

