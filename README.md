# Admin Architect - Options module
adminarchitect/options provides the way to store/read key => value options to/from database.

## Installation

`Note:` this is not standalone package, it can be used only in conjunction with `Admin Architect` (`http://adminarchitect.com`) package.

Install adminarchitect/options module by running:

```
composer require adminarchitect/options
```

register Options service provider by adding to the app/config.php `providers` section:

```
'providers' => [
	...
	Terranet\Options\ServiceProvider::class
	...
]
```

now you can publish the whole package resources by running:

```
php artisan vendor:publish [--provider="Terranet\\Options\\ServiceProvider"]
```

## Modules
To create new Settings module, run:

```
php artisan administrator:resource:settings
```
`Settings` module will be created into the `app\Http\Terranet\Administrator\Modules` directory.

## Routes
Routes become available at `app\Http\Terranet\Options\routes.php`.

## Migrations
Create migration for the options table:

```
php artisan options:table
```

this will create the migration file inside of `database/migrations` directory...

Run migration:
```
php artisan migrate
```

Optionaly you can create new options for your business:

```
php artisan options:make <Name> <Value>
```

## Types
Options module supports all know types by Admin Architect: select, boolean, text, textarea, etc...
So for example the boolean key may look like:
```
public function form()
{
    return array_merge(
        $this->scaffoldForm(),
        [
            'ssl' => ['type' => 'boolean', 'label' => 'Use SSL'],
        ]
    );
}
```

*Enjoy!*
