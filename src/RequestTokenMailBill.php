<?php namespace Pelrock\SignatureMailToken;

use Pelrock\SignatureMailToken\Guards\CheckJson;

/**
 * Class RequestTokenMailBill
 *
 * @package Pelrock\SignatureMailToken
 */
class RequestTokenMailBill
{
    /**
     *
     */
    const VERSION = '1.0';

    /**
     * @var array
     */
    private $guards;

    /**
     * RequestTokenMailBill constructor.
     *
     * @param array $guards
     */
    public function __construct( array $guards)
    {
        $this->guards = $guards;
    }

    /**
     * @param \Pelrock\SignatureMailToken\Token $token
     * @param $string
     * @return string
     */
    public function sign(Token $token, $string)
    {
        $key = hash('sha256', $token->key());
        $iv = substr(hash('sha256', $token->ivector()), 0, 16); //16 bits
        $cipher = $token->cipher();
        $result = base64_encode(openssl_encrypt($string, $cipher, $key, 0, $iv));
        foreach ($this->guards as $guard) {
            $guard->check($token, $string, $result);
        }
        return $result;
    }

    /**
     * @param \Pelrock\SignatureMailToken\Token $token
     * @param $string
     * @return false|string
     */
    public function unSign(Token $token, $string) {
        $key = hash('sha256', $token->key());
        $iv = substr(hash('sha256', $token->ivector()), 0, 16); //16 bits
        $cipher = $token->cipher();
        $result = openssl_decrypt(base64_decode($string), $cipher, $key, 0, $iv);
        foreach ($this->guards as $guard) {
            $guard->check($token, $result, $string);
        }
        return $result;
    }

}
