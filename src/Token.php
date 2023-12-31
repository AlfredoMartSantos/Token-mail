<?php namespace Pelrock\SignatureMailToken;

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
     * @param string $key
     */
    public function setKey(string $key): void
    {
        $this->key = $key;
    }

    /**
     * @param string $ivector
     */
    public function setIvector(string $ivector): void
    {
        $this->ivector = $ivector;
    }

    /**
     * @param string $cipher
     */
    public function setCipher(string $cipher): void
    {
        $this->cipher = $cipher;
    }

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
    public function __construct($key=null, $ivector=null, $cipher=null)
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
