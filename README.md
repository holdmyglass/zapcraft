# ZapCraft Laravel Package

After spending a considerable amount of time in development, I noticed a recurring pattern—I was performing the same tasks repeatedly. Every time I created a new model, I found myself generating similar files with identical content. In an effort to simplify this repetitive process and streamline my workflow, I decided to create the ZapCraft Laravel package.

ZapCraft is designed with my favorite coding structure in mind, offering a solution to automate the creation of essential files and components for new models. Built on top of the trusted `nwidart/laravel-modules` package, ZapCraft introduces functionalities to effortlessly generate models, migrations, controllers, repositories, interfaces, DTOs, services, requests, resources, and routes for any entity in your Laravel project.

## Installation

To install ZapCraft, use the following Composer command:

```bash
composer require holdmyglass/zapcraft
```

## Getting Started

ZapCraft simplifies the process of creating and organizing components in your Laravel application.
This package is dependent on `nwidart/laravel-modules` package. If you have already installed this package then it's fine. If you have not installed it, then the zapcraft package will automatically install the laravel-modules package.

## Autoloading

By default, module classes aren't loaded automatically. To autoload them using psr-4, add the following line to the end of the root composer.json file under the autoload section:

```{
  "autoload": {
    "psr-4": {
      "App\\": "app/",
      "Database\\Factories\\": "database/factories/",
      "Database\\Seeders\\": "database/seeders/",
      "Modules\\": "Modules/"
    }
  }
```

Now run `composer dump-autoload` in the root of your laravel app.

## Commands

- `sail php artisan zapcraft:all Product --module=Sale`
- `sail php artisan zapcraft:model Product --module=Sale -m`
- `sail php artisan zapcraft:migration Product --module=Sale`
- `sail php artisan zapcraft:controller Product --module=Sale`
- `sail php artisan zapcraft:repository Product --module=Sale`
- `sail php artisan zapcraft:interface Product --module=Sale`
- `sail php artisan zapcraft:service Product --module=Sale`
- `sail php artisan zapcraft:resource Product --module=Sale`
- `sail php artisan zapcraft:collection Product --module=Sale`
- `sail php artisan zapcraft:dto Product --module=Sale`
- `sail php artisan zapcraft:route Product --module=Sale`

The first command will generate all the necessary files and classes. For the rest, it should be clear what it can generate looking at the command name.

After we generate everything, we need to bind the interfaces with repository. So lets say we generate everything with the following command:

`sail php artisan zapcraft:all Product --module=Sale`

This is create all the files for Product entity inside Sale module. This will create ReadProductRepositoryInterface, WriteProductRepositoryInterface and ProductRepository along with many other files. We need to bind these two interfaces with repository. Open `Modules/Sale/app/Providers/SaleServiceProvider` and paste the following inside `public function register()` function:

- `$this->app->bind(ReadProductRepositoryInterface::class, ProductRepository::class);`
- `$this->app->bind(WriteProductRepositoryInterface::class, ProductRepository::class);`

P.S. Don't forget to import these class at top using use statement.

## Customization

ZapCraft is designed to be flexible and customizable. You can modify the generated files, tweak configurations, and adapt the code to fit your specific needs.

## Features

ZapCraft provides the following features:

- Entity Generation: Quickly generate models, migrations, controllers, repositories, interfaces, DTOs, services, requests, resources, and routes for your entities.

- Modular Structure: Leverage the power of Laravel Modules to keep your application organized and maintainable.

- Consistency: Ensure consistency in your codebase by using ZapCraft to generate standardized components.

- Time-Saving: Save development time by automating repetitive tasks and reducing the boilerplate code you need to write.

## Contributing

Contributions are welcome! If you find any issues or have suggestions for improvements, please open an issue or create a pull request on the [Github Repository](https://github.com/holdmyglass/zapcraft).

## License

ZapCraft is open-sourced software licensed under the [MIT License](https://en.wikipedia.org/wiki/MIT_License) .

## Support

If you encounter any issues or have questions, feel free to reach out to us through [Github Issues](https://github.com/holdmyglass/zapcraft/issues).

Happy coding with ZapCraft!
