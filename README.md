# CakeTwitterBootstrap

## Description

CakePHP Helpers for using Twitter bootstrap for CakePHP 3.x

## Under development
This is still under development and should be consider unstable

## Requirements

 - CakePHP until 3.1.x
 - jQuery
 - [Bootstrap 3.x](http://getbootstrap.com/)
 - [Chosen](https://github.com/harvesthq/chosen/)
 - Font-Awesome
 - [Datepicker](http://www.eyecon.ro/bootstrap-datepicker)

## Usage

``$ bower update``

Run bower update. This will install all requirements inside a vendor folder on webroot.
All libraries and css files are symlinked to the vendor folders.
You have to include these files in to your view or your layout

    <?= $this->Html->css('CakeBootstrap.bootstrap'); ?>

There are symlinks that point to the files required.

    public $helpers = [
        'Form' => [
            'className' => 'CakeTwitterBootstrap.BootstrapForm'
        ]
        'Html' => [
            'className' => 'CakeTwitterBootstrap.BootstrapHtml'
        ]
    ];

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Todo

Many things left todo.
 - Add datatables
 - Remove datepicker and find a suitable datetimepicker

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## License

MIT License. See [License](LICENSE.md)