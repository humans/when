# When



## Installation 

```bash
composer require humans/when
```



## Usage

```php
echo when(true)->return('is-open');
// "is-open"

echo when(false)->return('is-open'); // prints null
// null

echo when(false)->return('is-open')->else('is-closed');
// "is-closed"
```



### Comparison

```php
echo when(true)->is(false)->return('is true')->else('is false');
```



### Proxy

Proxies methods

```php
when($product)->isOutOfStock()->return('is out of stock');
```



Proxies properties

```php
when($product)->is_available->return('is available');
```



## Global Methods

```php
when();

unless();
```

























