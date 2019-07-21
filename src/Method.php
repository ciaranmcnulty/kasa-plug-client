<?php

namespace Guym4c\Kasa;

use MyCLabs\Enum\Enum;

class Method extends Enum {

    const LOGIN = 'login';
    const DEVICE_LIST = 'getDeviceList';
    const PASSTHROUGH = 'passthrough';

}