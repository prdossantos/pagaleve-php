<?php

namespace Pagaleve\PHP\Checkout;

class Checkout
{
    private $id = "";
    private $cancel_url = "";
    private $complete_url = "";
    private $metadata = [];
    private $shopper;
    private $order;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getCancelUrl(): string
    {
        return $this->cancel_url;
    }

    /**
     * @param string $cancel_url
     */
    public function setCancelUrl(string $cancel_url)
    {
        $this->cancel_url = $cancel_url;

        return $this;
    }

    /**
     * @return string
     */
    public function getCompleteUrl(): string
    {
        return $this->complete_url;
    }

    /**
     * @param string $complete_url
     */
    public function setCompleteUrl(string $complete_url)
    {
        $this->complete_url = $complete_url;

        return $this;
    }

    /**
     * @return array
     */
    public function getMetadata(): array
    {
        return $this->metadata;
    }

    /**
     * @param array $metadata
     */
    public function setMetadata(array $metadata)
    {
        $this->metadata = $metadata;

        return $this;
    }

    /**
     * @return Shopper
     */
    public function getShopper(): Shopper
    {
        return $this->shopper;
    }

    /**
     * @param Shopper $shopper
     */
    public function setShopper(Shopper $shopper)
    {
        $this->shopper = $shopper;

        return $this;
    }

    /**
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }

    /**
     * @param Order $order
     */
    public function setOrder(Order $order)
    {
        $this->order = $order;

        return $this;
    }

    public function toJSON()
    {
        return get_object_vars($this);
    }
}
