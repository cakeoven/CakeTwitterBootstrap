# CakeTwitterBootstrap

## Description

CakePHP Helpers for using Twitter bootstrap for CakePHP 2.5

# Requirements

 - jquery
 - [Bootstrap 3.x](http://getbootstrap.com/)
 - [Chosen](https://github.com/harvesthq/chosen/)
 - Font-Awesome
 - [Datepicker](http://www.eyecon.ro/bootstrap-datepicker)

# Usage

``$ bower update``

Run bower update. This will install all requirements inside a vendor folder on webroot.
There are symlinks that point to the files required.

    ```php
    public $helpers = [
        'Form' => [
            'className' => 'CakeTwitterBootstrap.BootstrapForm'
        ]
        'Html' => [
            'className' => 'CakeTwitterBootstrap.BootstrapHtml'
        ]
    ];
    ```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Todo

Many things left todo.
 - Add datatables
 - Remove datepicker and find a suitable datetimepicker

## Credits

- [George Mponos](http://gmponos.webthink.gr)
- [All Contributors][link-contributors]

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## License

MIT License. See [License](LICENSE.md)