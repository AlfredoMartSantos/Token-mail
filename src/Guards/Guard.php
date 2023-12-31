<?php namespace Pelrock\SignatureMailToken\Guards;


use Pelrock\SignatureMailToken\Token;

interface Guard
{

    /**
     * Check to ensure the auth parameters
     * satisfy the rule of the guard
     *
     * @param array  $auth
     * @param array  $signature
     * @param string $prefix
     * @return bool
     */
    public function check(Token $token, string $string, string $cadena );
}
