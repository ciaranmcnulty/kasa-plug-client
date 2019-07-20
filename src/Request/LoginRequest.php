<?php


namespace Guym4c\Kasa\Request;


use Exception;
use Guym4c\Kasa\Client;
use Guym4c\Kasa\KasaApiException;
use Guym4c\Kasa\Method;
use Guym4c\Kasa\Model\Account;
use Ramsey\Uuid\Uuid;

class LoginRequest extends AbstractRequest {

    const KASA_APP_TYPE = 'kasa-plug-client';

    /**
     * LoginRequest constructor.
     * @param Client $kasa
     * @param string $user
     * @param string $pass
     * @throws Exception
     */
    public function __construct(Client $kasa, string $user, string $pass) {
        parent::__construct($kasa, Method::LOGIN, null, [
            'appType' => self::KASA_APP_TYPE,
            'cloudUserName' => $user,
            'cloudPassword'=> $pass,
            'terminalUUID' => Uuid::uuid4(),
        ]);
    }

    /**
     * @return Account
     * @throws KasaApiException
     * @throws Exception
     */
    public function getResponse(): Account {
        return new Account($this->execute());
    }
}