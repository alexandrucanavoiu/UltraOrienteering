# Ultra Orienteering Ranking Software

Ultra Orienteering is your comfortable and reliable free tool to organize a single day or multi day orienteering competition. 

## Official Documentation

Documentation for the Ultra Orienteering Ranking Software can be found on the [Ultra Orienteering Official Webiste](http://www.ultra-orienteering.drumetiimontane.ro).

Remember this software is running in offline mode.

## SETUP FOR WINDOWS

1. Download UwAmp and Install
2. Copy all in www/orienteering/
3. Set Mysql -> user: root and password: root
3. Rename fie .env.example to .env
4. Set Document Root in Apache : DocumentRoot "{DOCUMENTPATH}/orienteering/public"
5. Restart Mysql & Apache
6. Create database in MYSQL: orienteering
7. Import orienteering.sql

## SETUP FOR LINUX

#### Requirements
- HTTP server (Apache, Nginx, etc)
- PHP 7.1 or later
- Mysql
- Composer (http://www.getcomposer.org)

#### How to install

###### Step 1
```sh
$ cd /home/orienteering/
$ git clone https://github.com/alexandrucanavoiu/UltraOrienteering .
```

###### Step 2
By default UltraOrienteering comes with a .env.example file. You need to rename this file as .env
Change the default values with your own (like database name, database user, database password, etc)


###### Step 3
```sh
$ find ./ -type f -exec chmod 644 {} +
$ find ./ -type d -exec chmod 755 {} +
```

###### Step 4
```sh
$ composer update
$ php artisan key:generate
```

###### Step 5
```sh
$ php artisan migrate
$ php artisan db:seed
```

## Contributing

Thank you for considering contributing to the Ultra Orienteering Software! The contribution guide can be found in the [Ultra Orienteering documentation](http://www.ultra-orienteering.drumetiimontane.ro/documentatie).

## About Security

If you discover a security vulnerability, please send an e-mail to Mountain Hiking Association at contact@drumetiimontane.ro. All security vulnerabilities will be promptly addressed.

## License

Ultra Orienteering is open-sourced software licensed under the [ Creative Commons Attribution-NonCommercial 4.0 International License.](https://creativecommons.org/licenses/by-nc/4.0/).