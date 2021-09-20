<?php

namespace Pagaleve\PHP\Http;

class Response
{
    private $_response;
    private $_statusCode = 0;

    /**
     * Efetua o parse de um response qualquer
     *
     * @param $response
     * @param $statusCode
     *
     * @return $this
     */
    public function parse( $response, $statusCode ): Response
    {
        $this->_response   = $response;
        $this->_statusCode = $statusCode;

        return $this;
    }

    public function isSuccess()
    {
        return ( $this->getStatusCode() >= 200 && $this->getStatusCode() < 300 );
    }

    public function isError()
    {
        return ( $this->getStatusCode() >= 400 && $this->getStatusCode() < 500 );
    }

    /**
     * Retorna o status code da requisição
     *
     * @return int
     */
    public function getStatusCode(): int
    {
        return intval( $this->_statusCode );
    }

    public function isFail()
    {
        return ( $this->getStatusCode() >= 500  || $this->getStatusCode() < 200 );
    }

    /**
     * Retorna o code de uma requisição com erro
     *
     * @return string|mixed
     */
    public function getCode()
    {
        return "{$this->_response['code']}" ?? "0";
    }

    /**
     * Retorna o message  de uma requisição com erro
     *
     * @return mixed|string
     */
    public function getMessage()
    {
        return $this->_response[ 'message' ] ?? "";
    }

    /**
     * Retorna o details de uma requisição com erro
     *
     * @return mixed|null
     */
    public function getDetails()
    {
        return $this->_response[ 'details' ] ?? [];
    }


    /**
     * Retorna os dados de uma requisição com sucesso
     *
     * @return mixed|null
     */
    public function getData( )
    {
        return json_encode( $this->_response );
    }

}
