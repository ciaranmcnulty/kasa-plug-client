<?php

namespace Guym4c\Kasa\Model;

class Plug extends AbstractModel {

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

    public function __construct(array $json) {
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

}