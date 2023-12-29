<?php namespace Pelrock\Signature;

/**
 * Class Token
 */
class Token
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $ivector;

    /**
     * @var string
     */
    private $cipher;

    /**
     * Create a new Token
     *
     * @param string $key
     * @param string $ivector
     * @param string $cipher
     * @return void
     */
    public function __construct($key, $ivector, $cipher)
    {
        $this->key    = $key;
        $this->ivector = $ivector;
        $this->cipher = $cipher;
    }

    /**
     * @return string
     */
    public function cipher()
    {
        return $this->cipher;
    }

    /**
     * Get the key
     *
     * @return string
     */
    public function key()
    {
        return $this->key;
    }

    /**
     * Get the ivector
     *
     * @return string
     */
    public function ivector()
    {
        return $this->ivector;
    }
}
