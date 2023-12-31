<?php

namespace Pelrock\SignatureMailToken\Guards;



use Pelrock\SignatureMailToken\Exceptions\SignatureJsonDecodeException;

class CheckJson
{
    /**
     * @inheritDoc
     */
    public function check($json)
    {
        $jsonDecoded = json_decode($json);
        if ($jsonDecoded === null && json_last_error() !== JSON_ERROR_NONE) {
            throw new SignatureJsonDecodeException('The JSON file is wrong');
        }
    }
}
