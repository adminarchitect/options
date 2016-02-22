# Terranet/Options
***terranet/options*** package provides an easy way to access and manage site options, saved in database or any storage provided via driver.


### Sources
https://gitlab.top.md/terranet/options


### Installation

1. Open composer.json and add a repository

```
"repositories": [
   ...
   {
      "type": "git",
      "url": "git@gitlab.top.md:/terranet/options"
   }
   ...
]
```


2. then require it...

```
"require": {
    ...
    "terranet/options": "dev-master"
    ...
}
```


3. Run: ```composer update```


4. Register service provider: edit config/app.php:

```
   'providers' => [
       ...
       Terranet\Options\ServiceProvider::class,
       ...
   ]
```


5. Create & Run migration

```
php artisan options:table
php artisan migrate
```
