<?php


namespace Guym4c\Kasa\Request;

use Guym4c\Kasa\Client;
use Guym4c\Kasa\KasaApiException;
use GuzzleHttp;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7;
use GuzzleHttp\RequestOptions;

abstract class AbstractRequest {

    const BASE_API_ENDPOINT = 'https://%swap.tplinkcloud.com';

    /** @var Client */
    protected $kasa;

    /** @var string */
    private $method;

    /** @var array */
    private $params;

    /** @var array */
    private $requestData;

    /** @var GuzzleHttp\Client */
    private $http;

    /** @var Psr7\Request */
    private $request;

    /** @var array */
    private $options;

    /**
     * Request constructor.
     * @param Client      $kasa
     * @param string      $method
     * @param string|null $region
     * @param array       $params
     * @param array       $requestData
     */
    public function __construct(Client $kasa, string $method, ?string $region = null, array $params = [], array $requestData = []) {
        $this->kasa = $kasa;
        $this->http = new GuzzleHttp\Client();
        $this->method = $method;
        $this->params = $params;
        $this->requestData = $requestData;

        $this->request = new Psr7\Request('POST',
            sprintf(self::BASE_API_ENDPOINT,
            (empty($region)
                ? ''
                : "{$region}-")));

        if (!empty($this->kasa->getToken()))
            $this->options[RequestOptions::QUERY]['token'] = $this->kasa->getToken();

        $this->options[RequestOptions::JSON]['method'] = $method;

        if (!empty($params))
            $this->options[RequestOptions::JSON]['params'] = $params;

        if (!empty($requestData))
            $this->options[RequestOptions::JSON]['params']['requestData'] = json_encode($requestData);

    }

    public abstract function getResponse();

    /**
     * @return array
     * @throws KasaApiException
     */
    public function execute(): array {

        try {
            $response = $this->http->send($this->request, $this->options);
        } catch (GuzzleException $e) {
            throw KasaApiException::fromGuzzle($e);
        }

        return json_decode($response->getBody()->getContents(), true)['result'];
    }

}