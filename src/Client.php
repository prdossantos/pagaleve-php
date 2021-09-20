<?php

namespace Pagaleve\PHP;

use Pagaleve\PHP\Checkout\Checkout;
use Pagaleve\PHP\Checkout\Payment;
use Pagaleve\PHP\Http\Http;

/**
 * Class Pagaleve.
 */
class Client
{
    /** @var string The Pagaleve API key to be used for requests. */
    private static $apiToken;


    /**
     * @return string the API key used for requests
     */
    public static function getApiToken()
    {
        return self::$apiToken;
    }

    /**
     * Sets the API key to be used for requests.
     *
     * @param string $apiToken
     */
    public static function setApiToken($apiToken)
    {
        self::$apiToken = $apiToken;
    }

    /**
     *
     *
     * @param $username
     * @param $password
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function auth( $username, $password )
    {
        $http = new Http();
        $response = $http->post("/authentication", ["username" => $username, "password" => $password]);

        if( $response->isSuccess() ) {
            self::setApiToken($response->getData()["token"]);

            return true;
        }

        return false;
    }

    public static function createCheckout( Checkout $checkout )
    {
        $http = new Http();

        $response = $http->post("/checkouts", $checkout->toJSON());

        if( $response->isSuccess() ) {
            $checkout->setId($response->getData()["id"]);

            return $checkout->toJSON();
        }
        return ["error" => "Erro while making the request"];
    }

    public static function createPayment( Payment $payment )
    {
        $http = new Http();

        $response = $http->post("/payments", $payment->toJSON());

        if( $response->isSuccess() ) {

            return $response->getData();
        }
        return ["error" => "Erro while making the request"];
    }

}
