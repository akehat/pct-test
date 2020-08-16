##### for NumberFormatter install this package
* sudo apt-get update -y
* sudo apt-get install -y php7.2-intl

##### add to /etc/hosts
* 127.0.0.1    pct.test

##### nginx server conf:
```
server {
    server_name pct.test;
    listen 80;
    index  index.php index.html index.htm;
    root /path/to/pct-test/dev/public;

    location / {
        try_files $uri $uri/ /index.php?url=$uri&$args;
    }

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_intercept_errors on;
        fastcgi_pass unix:/run/php/php7.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root/$fastcgi_script_name;
    }
}
```

##### clone repo
```
mkdir -p /var/www/path-to-repo/dev
cd /var/www/path-to-repo/dev
git clone git@github.com:hkovacs/pct-test.git .
```

##### loading database:
* set your db credentials in config/config.php
* optional: `create database pct_test;`
* import users.sql


##### local sample urls:
* http://pct.test/3
* http://pct.test/getName/3

* see live: pct-test.hkovacs.com
