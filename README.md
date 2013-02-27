# Pushover PHP

Pushover PHP is a light, damn simple API wrapper for the Pushover API written in PHP.

## Usage

```php
$po = new Pushover('myapikey', 'myuserkey');

$po->send('Hello World!');
$po->send('Goodbye World', array('priority' => 1));
```

## Documentation

On *success* `Pushover->send` returns a **truth-y** array like:

```php
array(
    'status'  => 1
    'request' => 2f4e9c7140df52d7d8b16ffb8adf1c2a
)
```
	
On *failure* `Pushover->send` returns **false** which allows simple

```php
if( !$po->send('Hello World!') ) { 
	die('oh no!'); 
}
```

*More Coming soon.*
