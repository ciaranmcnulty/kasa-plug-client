<?php

namespace Guym4c\Kasa;

use Exception;
use Guym4c\Kasa\Request\LoginRequest;

class Client {

    /** @var string */
    private $user;

    /** @var string */
    private $pass;

    /** @var ?string */
    private $token;

    /** @var array Plug */
    private $plugs;

    /**
     * Client constructor.
     * @param $user
     * @param $pass
     * @throws Exception
     */
    public function __construct($user, $pass) {
        $this->user = $user;
        $this->pass = $pass;

        $this->token = (new LoginRequest($this, $this->user, $this->pass))
            ->getResponse()->token;

    }

    /**
     * @return string
     */
    public function getToken(): ?string {
        return $this->token;
    }

    /**
     * @return array
     */
    public function getPlugs(): array {
        return $this->plugs;
    }
}