<?php namespace Pelrock\SignatureMailToken\Guards;

use Pelrock\SignatureMailToken\Token;
use Pelrock\SignatureMailToken\Exceptions\SignatureKeyException;

class CheckKey implements Guard
{

    /**
     * Check to ensure the auth parameters
     * satisfy the rule of the guard
     *
     * @param array  $auth
     * @param array  $signature
     * @param string $prefix
     * @throws SignatureKeyException
     * @return bool
     */
    public function check(Token $token, string $string, string $cadena)
    {
        if ($token->key() ===null) {
            throw new SignatureKeyException('The authentication key has not been set');
        }

        if ($token->cipher()===null) {
            throw new SignatureKeyException('The cipher key has not been set');
        }

        if ($token->ivector()===null) {
            throw new SignatureKeyException('The ivector key has not been set');
        }

        return true;
    }
}
