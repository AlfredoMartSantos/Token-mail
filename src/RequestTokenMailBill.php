<?php namespace Pelrock\SignatureMailToken;

class RequestTokenMailBill
{
    const VERSION = '1.0';


    public function __construct()
    {

    }


    public function sign(Token $token, $string)
    {
        $key = hash('sha256', $token->key());
        $iv = substr(hash('sha256', $token->ivector()), 0, 16); //16 bits
        $cipher = $token->cipher();
        $result = base64_encode(openssl_encrypt($string, $cipher, $key, 0, $iv));
        return $result;
    }

    public function unSign(Token $token, $string) {
        $key = hash('sha256', $token->key());
        $iv = substr(hash('sha256', $token->ivector()), 0, 16); //16 bits
        $cipher = $token->cipher();
        $result = openssl_decrypt(base64_decode($string), $cipher, $key, 0, $iv);
        return $result;
    }

}
