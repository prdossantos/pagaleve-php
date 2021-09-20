<?php

namespace Pagaleve\PHP\Http;

trait HttpConfig
{
    private $_base_uri  = 'https://api.pagaleve.com.br/v1';
    private $_headers   = [];
    private $_data_type = 'json';
    private $_configs   = [];

    /**
     * @return mixed
     */
    protected function getBaseUri()
    {
        return $this->_base_uri;
    }

    /**
     * @return mixed
     */
    protected function getConfigs()
    {
        return $this->_configs;
    }

    /**
     * @return mixed
     */
    protected function getDataType()
    {
        return $this->_data_type;
    }

    /**
     * @return mixed
     */
    protected function getHeaders()
    {
        return $this->_headers;
    }

    /**
     * @param string $base_uri
     *
     * @return Http
     */
    public function setBaseUri( string $base_uri ): Http
    {
        $this->_base_uri = $base_uri;

        return $this;
    }

    /**
     * @param array $configs
     *
     * @return Http
     */
    public function setConfigs( array $configs ): Http
    {
        $this->_configs = $configs;

        return $this;
    }

    /**
     * @param string $dataType
     *
     * @return Http
     */
    public function setDataType( string $dataType ): Http
    {
        $this->_data_type = $dataType;

        return $this;
    }

    /**
     * @param array $headers
     * @param bool  $merge Default true
     *
     * @return Http
     */
    public function setHeaders( array $headers, bool $merge = true ): Http
    {
        $this->_headers = array_merge( $this->_headers, $headers );

        return $this;
    }

    /**
     * @param array $httpConfigs = [ 'headers' => [], 'baseUri' => '', 'configs' => [], 'dataType' => '' ]
     */
    public function updateHttpConfigs( array $httpConfigs = [] )
    {
        if ( count( $httpConfigs ) ) {
            if ( isset( $httpConfigs[ 'headers' ] ) ) {
                $this->setHeaders( $httpConfigs[ 'headers' ] );
            }
            if ( isset( $httpConfigs[ 'baseUri' ] ) ) {
                $this->setBaseUri( $httpConfigs[ 'baseUri' ] );
            }
            if ( isset( $httpConfigs[ 'configs' ] ) ) {
                $this->setConfigs( $httpConfigs[ 'configs' ] );
            }
            if ( isset( $httpConfigs[ 'dataType' ] ) ) {
                $this->setDataType( $httpConfigs[ 'dataType' ] );
            }
        }
    }
}
