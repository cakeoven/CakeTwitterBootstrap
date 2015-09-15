CakeTwitterBootstrap
====================

## Description

CakePHP Helpers for using Twitter bootstrap for CakePHP 2.4

# Requirements

 - jquery
 - Bootstrap 3.x
 - Chosen
 - Font-Awesome
 - Datepicker - [here](http://www.eyecon.ro/bootstrap-datepicker)

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
## Links

[Bootstrap](http://getbootstrap.com/)

[Chosen](https://github.com/harvesthq/chosen/)

## License

The MIT License (MIT)

Copyright (c) 2014 George Mponos

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

## Todo

Many things left todo.

 - Add datatables
 - Remove datepicker and find a suitable datetimepicker