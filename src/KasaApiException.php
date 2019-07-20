<?php

namespace Guym4c\Kasa;

use Exception;
use GuzzleHttp\Exception\GuzzleException;

class KasaApiException extends Exception {

    //TODO

    public function __construct(array $json) {
        parent::__construct("");
    }

    public static function fromGuzzle(GuzzleException $e): self {
        return new self([]);
    }
}