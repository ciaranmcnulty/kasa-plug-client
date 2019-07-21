# `kasa-plug-client`

A simple client for the TP-Link Kasa smart plugs.

# Install
Via Composer:
```bash
composer install guym4c/kasa-plug-client
```

# Usage
Get yourself an instance of the client, using your TP-Link Cloud login details (which you use to log in to the app).
```php
$kasa = new \Guym4c\Kasa\Client(/* username */, /* password */);
```
As tokens for the unofficial Kasa API expire quite fast, the package takes your credentials and obtains a new token for you on every instantiation.

## What you're here for
Turning plugs on and off is simple - you can retrieve a `Plug` using the `$kasa->getPlug()` method. Pass this method a string of the plug alias or plug ID (you can see the alias in the Kasa app, or get a list of your plugs using `getPlugs()`).

Then just call `$plug->setState(bool)` with `true` for *on*, and `false` for *off*. (You can get the current state of the plug's relay using the `status` property of each `Plug`).