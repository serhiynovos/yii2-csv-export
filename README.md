Export array data to csv file
=========

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

```
php composer.phar require serrg1994/yii2-csv-export "*"
```

or add

```json
"serrg1994/yii2-csv-export": "*"
```

to the require section of your composer.json.

Usage
------------

```php
CSVExport::Export([
    'dirName' => Yii::getAlias('@webroot'),
    'fileName' => 'users.csv',
    'data' => [
        ['#', 'User Name', 'Email'],
        ['1', 'Serhiy Novoseletskiy', 'novoseletskiyserhiy@gmail.com']
    ]
]);
```