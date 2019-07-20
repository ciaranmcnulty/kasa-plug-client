<?php

namespace Guym4c\Kasa\Model;

use DateTime;
use Exception;

class Account extends AbstractModel {

    /** @var string */
    public $accountId;

    /** @var DateTime */
    public $regTime;

    /** @var string */
    public $email;

    /** @var string */
    public $token;

    /**
     * Account constructor.
     * @param array $json
     * @throws Exception
     */
    public function __construct(array $json) {
        $this->regTime = new DateTime($json['regTime']);
        self::hydrate($this, $json);
    }

}