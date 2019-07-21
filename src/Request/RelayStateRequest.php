<?php

namespace Guym4c\Kasa\Request;

use Guym4c\Kasa\Client;
use Guym4c\Kasa\KasaApiException;
use Guym4c\Kasa\Method;
use Guym4c\Kasa\Model\Plug;

class RelayStateRequest extends AbstractRequest {

    const KASA_APP_TYPE = 'kasa-plug-client';

    /**
     * LoginRequest constructor.
     * @param Client $kasa
     * @param Plug   $plug
     * @param bool   $state
     */
    public function __construct(Client $kasa, Plug $plug, bool $state) {
        parent::__construct($kasa, Method::PASSTHROUGH, $plug->getRegion(), [
            'deviceId' => $plug->deviceId,
        ], [
            'system' => [
                'set_relay_state' => [
                    'state' => $state ? 1 : 0,
                ],
            ],
        ]);
    }

    /**
     * @return bool
     * @throws KasaApiException
     */
    public function getResponse(): bool {

        $responseData = json_decode(($this->execute())['responseData'], true);
        return (bool) $responseData['system']['set_relay_state']['err_code'];
    }
}