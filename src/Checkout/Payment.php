<?php

namespace Pagaleve\PHP\Checkout;

class Payment
{
    private $checkout_id = "";
    private $intent = "AUTH";
    private $currency = "BRL";
    private $reference = "";
    private $amount = 0;

    /**
     * @return string
     */
    public function getCheckoutId(): string
    {
        return $this->checkout_id;
    }

    /**
     * @param string $checkout_id
     */
    public function setCheckoutId(string $checkout_id)
    {
        $this->checkout_id = $checkout_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getIntent(): string
    {
        return $this->intent;
    }

    /**
     * @param string $intent
     */
    public function setIntent(string $intent)
    {
        $this->intent = $intent;

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    public function setReference(string $reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount(int $amount)
    {
        $this->amount = $amount;

        return $this;
    }



    public function toJSON()
    {
        return get_object_vars($this);
    }
}
