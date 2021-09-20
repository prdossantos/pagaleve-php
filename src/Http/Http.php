<?php

namespace Pagaleve\PHP\Http;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

class Http
{
    use HttpConfig;

    private $_http;
    private $_response;

    public function __construct()
    {
        $this->_response = new Response();
    }

    /**
     * Cria uma requisição REST
     *
     * @param string $method
     * @param string $uri
     * @param array  $data
     * @param array  $headers
     * @param array  $configs
     *
     * @return Response
     * @throws GuzzleException
     */
    private function request(
        string $method,
        string $uri,
        array $data = [],
        array $headers = [],
        array $configs = [
            "verify" => false
        ]
    ): Response {
        $this->_http = new Client( $configs );
        $parsed      = $this->_response->parse( [], 0 );
        try {
            $requestConfigs = [
                "headers" => array_merge( [
                    "Authorization" => "Bearer " . \Pagaleve\PHP\Client::getApiToken()
                ], $headers )
            ];
            $requestConfigs[ $this->getDataType() ] = $data;
            $response                               = $this->_http->request( strtoupper( $method ), $uri, $requestConfigs );
            try {
                $this->_response->parse( json_decode( $response->getBody()->getContents(), true ), $response->getStatusCode() );
            } catch ( Exception $exception ) {
                $parsed = $this->_response->parse(
                    [
                        "code"    => $exception->getCode(),
                        "message" => $exception->getMessage(),
                        "details" => [
                            "message" => $exception->getTraceAsString()
                        ]
                    ],
                    500
                );
            }

        } catch ( RequestException $exception ) {
            if ( $exception->getCode() < 500 ) {
                try {
                    $errors = json_decode( $exception->getResponse()->getBody() );
                    $parsed = $this->_response->parse(
                        [
                            "code"    => $errors->code,
                            "message" => $errors->message,
                            "details" => $errors->details
                        ],
                        $exception->getResponse()->getStatusCode()
                    );
                } catch ( Exception $exception ) {
                    $parsed = $this->_response->parse(
                        [
                            "code"    => $exception->getCode(),
                            "message" => $exception->getMessage(),
                            "details" => [
                                "message" => $exception->getTraceAsString()
                            ]
                        ],
                        400
                    );
                }
            } else {
                $parsed = $this->_response->parse(
                    [
                        "code"    => $exception->getCode(),
                        "message" => $exception->getMessage(),
                        "details" => [
                            "message" => $exception->getTraceAsString()
                        ]
                    ],
                    500
                );
            }
        }

        return $parsed;
    }

    /**
     * Executa uma requisição GET
     *
     * @param string $path
     * @param array  $params
     *
     * @return Response
     * @throws GuzzleException
     */
    public function get( string $path, array $params = [] ): Response
    {
        $query = "";
        if ( count( $params ) > 0 ) {
            $query = "?";
            foreach ( $params as $k => $v ) {
                $query .= "&{$k}={$v}";
            }
            $query = str_replace( "?&", "?", $query );
        }

        return $this->request( "GET", "{$this->getBaseUri()}{$path}{$query}", [], $this->getHeaders(), $this->getConfigs() );
    }

    /**
     * Executa uma requisição POST
     *
     * @param $path
     * @param $data
     *
     * @return Response
     * @throws GuzzleException
     */
    public function post( string $path, array $data ): Response
    {
        return $this->request( "POST", "{$this->getBaseUri()}{$path}", $data, $this->getHeaders(), $this->getConfigs() );
    }

    /**
     * Executa uma requisição PUT
     *
     * @param $path
     * @param $data
     *
     * @return Response
     * @throws GuzzleException
     */
    public function put( string $path, array $data ): Response
    {
        return $this->request( "PUT", "{$this->getBaseUri()}{$path}", $data, $this->getHeaders(), $this->getConfigs() );
    }

    /**
     * Executa uma requisição DELETE
     *
     * @param $path
     * @param $data
     *
     * @return Response
     * @throws GuzzleException
     */
    public function delete( string $path, array $data ): Response
    {
        return $this->request( "DELETE", "{$this->getBaseUri()}{$path}", $data, $this->getHeaders(), $this->getConfigs() );
    }
}
