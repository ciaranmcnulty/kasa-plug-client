<?php


namespace Guym4c\Kasa\Request;


use Exception;
use Guym4c\Kasa\Client;
use Guym4c\Kasa\KasaApiException;
use Guym4c\Kasa\Method;
use Guym4c\Kasa\Model\Plug;

class DevicesRequest extends AbstractRequest {

    const KASA_APP_TYPE = 'kasa-plug-client';

    /**
     * LoginRequest constructor.
     * @param Client $kasa
     */
    public function __construct(Client $kasa) {
        parent::__construct($kasa, Method::DEVICE_LIST);
    }

    /**
     * @return Plug[]
     * @throws KasaApiException
     * @throws Exception
     */
    public function getResponse(): array {
        $json = $this->execute();

        $plugs = [];

        foreach ($json['deviceList'] as $plug) {
            $plugs[] = new Plug($this->kasa, $plug);
        }

        return $plugs;
    }
}