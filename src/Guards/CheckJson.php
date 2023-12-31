<?php

namespace Pelrock\SignatureMailToken\Guards;



use Pelrock\SignatureMailToken\Exceptions\SignatureJsonDecodeException;
use Pelrock\SignatureMailToken\Token;

class CheckJson implements Guard
{
    /**
     * @inheritDoc
     */
    public function check(Token $token, string $json, string $cadena)
    {
        $jsonDecoded = json_decode($json);
        if ($jsonDecoded === null && json_last_error() !== JSON_ERROR_NONE) {
            throw new SignatureJsonDecodeException('The JSON file is wrong');
        }
    }
}
