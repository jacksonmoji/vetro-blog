# vetro-blog deployment notes

## Prerequisites

 - PHP **8.0.2**
 - Composer **2.3.4**
 - MySQL **8**
 - Nginx

## Deploying to Nginx
Assuming you have installed MySQL, PHP, and Nginx in your system already. To deploy to nginx follow the the instructions below.

### Setting up MySQL
 1.  Login to mysql and create new DB
 
	 `sudo mysql`
	
	 ` CREATE DATABASE "your database name";`
 3. Create an new system user and grant privileges
 
	 `CREATE USER '"your username"'@'%' IDENTIFIED WITH mysql_native_password BY 'your password';`
 4. Set user permission for over DB
 
	`GRANT ALL ON "your database name".* TO '"your username"'@'%';`
	 
### Cloning blog repository in www folder
 1. Change directory to www folder
 
	`cd /var/www/`
 2. Clone blog repository
 
	`git clone https://github.com/jacksonmoji/vetro-blog.git`

### Configuring Laravel

 1. Change directory into vetro-blog

	`cd vetro-blog`
 2. Change Database Connection Name from `sqlite` to `mysql` in `config/database.php`
 
	
 3. Add new environment file
 
	 `sudo nano .env`
 4. Add your local settings in to the `.env` file
```
APP_NAME=vetro-blog
APP_ENV=production
APP_KEY="your generated application unique key"
APP_DEBUG=false
APP_URL=http://vetro_blog
LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE="your database name"
DB_USERNAME="your username"
DB_PASSWORD="your password"
```

### Granting web server write access to storage and cache folders

 1. Run these commands in your terminal
 
	 `sudo chown -R www-data.www-data /var/www/vetro-blog/storage`
	 
	`sudo chown -R www-data.www-data /var/www/vetro-blog/bootstrap/cache`

### Configuring Nginx to serve the Application

 1. Create a new virtual host configuration
 
	 ``sudo nano /etc/nginx/sites-available/vetro-blog``
 3. Copy this configuration content into the open configuration file
  ```
server {
    listen 80;
    server_name vetro_blog;
    root /var/www/vetro-blog/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-XSS-Protection "1; mode=block";
    add_header X-Content-Type-Options "nosniff";

    index index.html index.htm index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

 4. Create a symbolic link to  `vetro-blog`  in  `sites-enabled` in order to activate the new virtual host configuration file 
 
	`sudo ln -s /etc/nginx/sites-available/vetro-blog /etc/nginx/sites-enabled/`
 5. Reload Nginx server to apply changes

	 `sudo systemctl reload nginx`

 6. Check site at 

	`http://vetro_blog`

 

