# Pagaleve PHP library

The Pagaleve PHP library provides convenient access to the Pagaleve API from
applications written in the PHP language.

## Requirements

PHP 7.2.5 and later.

## Composer

You can install the library via [Composer](http://getcomposer.org/). Run the following command:

```bash
composer require pagaleve/pagaleve-php
```

## Dependencies

The library require the following packages to work properly:

-   [`guzzle`](https://docs.guzzlephp.org/en/stable/index.html)

## Getting Started

Simple usage looks like:

```php
\Pagaleve\PHP\Client::auth("username", "password");

$checkout = (new \Pagaleve\PHP\Checkout\Checkout())
    ->setCancelUrl("")
    ->setCompleteUrl("")
    ->setShopper((new \Pagaleve\PHP\Checkout\Shopper())
        ->setFirstName("")
        ->setLastName("")
    )
    ->getOrder((new \Pagaleve\PHP\Checkout\Order())
        ->setAmount(1)
    );

$checkoutJson = json_decode(\Pagaleve\PHP\Client::createCheckout( $checkout ));

$payment = \Pagaleve\PHP\Client::createPayment( (new \Pagaleve\PHP\Checkout\Payment() )
    ->setAmount($checkoutJson->amount)
    ->setCheckoutId($checkoutJson->checkout_id)
    ->setReference("asdf")
);

echo $payment;
```

