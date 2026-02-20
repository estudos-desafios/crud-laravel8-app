<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


## Project: 

Laravel 8 with CRUD: users, favorite movies, products and tags

### Features

- Users management with roles and permissions
- Products management with tags (many-to-many)
- Tags management
- Report: Tags → Total Products

### Products & Tags

#### Schema

```sql
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_name_unique` (`name`)
);

CREATE TABLE `tags` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tags_name_unique` (`name`)
);

CREATE TABLE `product_tag` (
  `product_id` bigint unsigned NOT NULL,
  `tag_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`product_id`,`tag_id`),
  CONSTRAINT `product_tag_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE
);
```

#### Report: Tags → Total Products SQL

```sql
SELECT t.name AS tag, COUNT(pt.product_id) AS total_products
FROM tags t
LEFT JOIN product_tag pt ON pt.tag_id = t.id
GROUP BY t.id, t.name
ORDER BY total_products DESC;
```

#### Routes

| Method | URL | Action |
|--------|-----|--------|
| GET | /products | List products (paginated) |
| GET | /products/create | Show create form |
| POST | /products | Store new product |
| GET | /products/{id} | Show product |
| GET | /products/{id}/edit | Show edit form |
| PUT | /products/{id} | Update product |
| DELETE | /products/{id} | Delete product |
| GET | /tags | List tags (paginated) |
| GET | /tags/create | Show create form |
| POST | /tags | Store new tag |
| GET | /tags/{id} | Show tag |
| GET | /tags/{id}/edit | Show edit form |
| PUT | /tags/{id} | Update tag |
| DELETE | /tags/{id} | Delete tag |
| GET | /reports/tags | Tags → Total Products report |

### To Run

* Requirements: Docker

#### Using Sail
````
git clone https://github.com/estudos-2022/crud-laravel8-app.git appLaravel8
cd appLaravel8
composer install
./vendor/bin/sail up
cp .env.example .env
./vendor/bin/sail php artisan key:generate
touch database/database.sqlite
./vendor/bin/sail php artisan migrate
./vendor/bin/sail php artisan db:seed
````

#### Using Local Server 
````
# Clone
git clone https://github.com/estudos-2022/crud-laravel8-app.git appLaravel8

# Enter in folder
cd appLaravel8

# Install depedencies
composer install

# Copy the variable of enviroment, and revise the config
cp .env.example .env

# Create the key
php artisan key:generate

# Create the database of Sqlite, except if to use other DB 
touch database/database.sqlite

# Run migration to create the tables of database - to run seed together [php artisan migrate::refresh --seed]
php artisan migrate

# Run Seed to create some data (roles...) 
php artisan db:seed
````


* About Sail: https://laravel.com/docs/8.x/sail

After, visit the following address: http://localhost

To run Unit Test: `./vendor/bin/sail test` or `php artisan test`

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
