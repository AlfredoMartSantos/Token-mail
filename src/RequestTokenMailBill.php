<?php namespace Pelrock\SignatureMailToken;

use Pelrock\SignatureMailToken\Guards\CheckJson;

class RequestTokenMailBill
{
    const VERSION = '1.0';
    private $guards;

    public function __construct( array $guards)
    {
        $this->guards = $guards;
    }


    public function sign(Token $token, $string)
    {
        foreach ($this->guards as $guard) {
            $guard->check($token);
        }
        $key = hash('sha256', $token->key());
        $iv = substr(hash('sha256', $token->ivector()), 0, 16); //16 bits
        $cipher = $token->cipher();
        $result = base64_encode(openssl_encrypt($string, $cipher, $key, 0, $iv));
        return $result;
    }

    public function unSign(Token $token, $string) {
        foreach ($this->guards as $guard) {
            $guard->check($token);
        }
        $key = hash('sha256', $token->key());
        $iv = substr(hash('sha256', $token->ivector()), 0, 16); //16 bits
        $cipher = $token->cipher();
        $result = openssl_decrypt(base64_decode($string), $cipher, $key, 0, $iv);

        $checkJson = new CheckJson();
        $checkJson->check($result);
        return $result;
    }

}
