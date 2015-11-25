# PHP Solr Client
### Loading the Library ###
```php
reqire 'Solr\Autoloader.php'

Solr¥Autoloader::register();
```
### Connecting to Solr Server ###
```php
$client = new Solr\Client('localhost', 'core', 8983);
$client->ping();
```
