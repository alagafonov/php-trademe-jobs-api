<?php namespace Trademe\Api;

use Trademe\Client;
use Trademe\HttpClient\Utilities\Response;

/**
 * Api abstract class.
 */
abstract class ApiAbstract implements ApiInterface
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param $path
     * @param array $parameters
     * @param array $headers
     * @return mixed
     * @throws \Trademe\Exceptions\InvalidJsonException
     */
    protected function get($path, array $parameters = [], array $headers = [])
    {
        if (count($parameters) > 0) {
            $path .= '?' . http_build_query($parameters);
        }

        return Response::getContent($this->client->getHttpClient()->get($path, $headers));
    }

    /**
     * @param $path
     * @param array $data
     * @param array $requestHeaders
     * @return mixed
     * @throws \Trademe\Exceptions\InvalidJsonException
     */
    protected function post($path, array $data = [], array $requestHeaders = [])
    {
        $requestHeaders['Content-Type'] = 'application/json';
        return Response::getContent(
            $this->client->getHttpClient()->post(
                $path,
                $requestHeaders,
                json_encode($data)
            )
        );
    }
}
