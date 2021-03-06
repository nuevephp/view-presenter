## View Presenter

### Installation

It's recommended that you use [Composer](https://getcomposer.org/) to install ViewPresenter.

```bash
composer require nueve/view-presenter
```

## Usage

#### Initialize

```php
$viewParser = new Nueve\ViewPresenter\PhpParser('template_directory_path');
$presentable = new Nueve\ViewParser\Presentable();
$view = new Nueve\ViewPresenter\View($viewParser, $presentable);
```

Now lets create a ViewPresenter.

```php
<?php

class SitePresenter implements \Nueve\ViewPresenter\PresenterInterface
{
    public function data()
    {
        return [
            'site_name' => 'Test Site',
            'site_description' => 'This is a test site to show how this works.'
        ];
    }
}
```

We can now make use of this by setting which template it should render for.

```php
$view->presenter('home', new SitePresenter());
```

Now when we render our home template the data from the presenter will be available.

```php
$view->render('home.php', [
    'developer' => 'Some Person'
]);
```

We now have access to all the properties of the `SitePresenter` in the home.php view file.

```php
<header>
    <h1><?=$site_name?></h1>
    <h2><?=$site_description?></h2>
</header>

<p>Hi <?=$developer?></p>
```

### Parsers

Out of the box only a single Parser is provided and that is for PHP, if you would like to add another Parser, you will need to implement the ParserInterface.

### View

The `Nueve\ViewPresenter\View` class takes 3 arguments, the first is the `ParserInterface`, the second is a `PresentableInterface` class and the last is a config `array`.

The array only contain a single property at the moment and that is the file extension property `file.ext`, which is by default set to `.php`, you should change this if you decide to use a different Parser. e.g. Twig `.twig`.

The `presenter` method on the View object takes two params, the first can be a `string` or a `array` and the second should be a `PresenterInterface`.

## Tests

To execute the test suite, you'll need phpunit.

```bash
$ phpunit
```

## Credits

- [Andrew Smith](https://github.com/silentworks)

## License

ViewPresenter is licensed under the MIT license. See [License File](LICENSE.md) for more information.