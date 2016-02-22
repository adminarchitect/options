### Usage

There are 2 more useful commands available:

#### Create new option
```
php artisan options:make <name> <value> [<group>]
```

#### Remove option
```
php artisan options:remove <name>
```

### Helpers
Methods available to work with options storage:

#### Fetch all available options
```php
options_fetch($group = null)
```

#### Find and option
```php
options_find($key, $default = null)
```

#### Create new option
```php
options_create($key, $value = '', $group = Manager::DEFAULT_GROUP)
```

#### Remove option
```php
options_remove($key)
```

#### Edit options
```php
options_save($options)
```