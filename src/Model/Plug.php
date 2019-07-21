<?php

namespace Guym4c\Kasa\Model;

use Guym4c\Kasa\Client;
use Guym4c\Kasa\KasaApiException;
use Guym4c\Kasa\Request\RelayStateRequest;

class Plug extends AbstractModel {

    /** @var Client */
    protected $kasa;

    /** @var string */
    public $firmwareVersion;

    /** @var string */
    public $deviceName;

    /** @var bool */
    public $status;

    /** @var string */
    public $alias;

    /** @var string */
    public $deviceType;

    /** @var string */
    public $appServerUrl;

    /** @var string */
    public $deviceModel;

    /** @var string */
    public $deviceMac;

    /** @var string */
    public $role;

    /** @var string */
    public $isSameRegion;

    /** @var string */
    public $hwId;

    /** @var string */
    public $fwId;

    /** @var string */
    public $oemId;

    /** @var string */
    public $deviceId;

    /** @var string */
    public $deviceHardwareVersion;

    public function __construct(Client $kasa, array $json) {
        $this->kasa = $kasa;

        $this->firmwareVersion = $json['fwVer'];
        unset($json['fwVer']);

        $this->status = (bool) $json['status'];

        $this->hydrate($json);
    }

    public function getRegion(): string {
        $matches = [];
        preg_match("/https:\/\/([a-z0-9]+)-wap\.tplinkcloud\.com/", $this->appServerUrl, $matches);
        return $matches[1];
    }

    /**
     * @param bool $on
     * @return bool
     * @throws KasaApiException
     */
    public function setState(bool $on): bool {
        return (new RelayStateRequest($this->kasa, $this, $on))->getResponse();
    }

}