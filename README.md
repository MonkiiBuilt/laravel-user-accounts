# laravel-user-accounts

1. Install [Zizaco/entrust](https://github.com/Zizaco/entrust). Follow the instructions but don't create a Role or Permission model. They are provided by this package.

2. Add this to ```"require"``` in composer .json:
 
```"monkiibuilt/laravel-user-accounts": "dev-master",```

and add this to the repositories section of composer.json

```
{
    "type": "package",
    "package": {
        "name": "MonkiiBuilt/laravel-user-accounts",
        "version": "dev-master",
        "source": {
            "url": "https://github.com/MonkiiBuilt/laravel-user-accounts.git",
            "type": "git",
            "reference": "master"
        },
        "autoload": {
            "classmap": [""]
        }
    }
}
```

3. Run ```php artisan db:seed --class="MonkiiBuilt\LaravelUserAccounts\Seeds\DatabaseSeeder"```

4. Run ```php artisan vendor:publish```

5. If you User model is not at ```App\Models\User``` then edit ```config/laravel-administrator/laravel-administrator-user-accounts.php``` with the correct namespace.
