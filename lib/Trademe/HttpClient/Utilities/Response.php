<?php namespace Trademe\HttpClient\Utilities;

use Psr\Http\Message\ResponseInterface;
use Trademe\Exceptions\InvalidJsonException;

class Response
{
    /**
     * @param ResponseInterface $response
     * @return mixed
     * @throws InvalidJsonException
     */
    public static function getContent(ResponseInterface $response)
    {
        $body = $response->getBody()->__toString();
        if (strpos($response->getHeaderLine('Content-Type'), 'application/json') !== false) {
            $content = json_decode($body, true);
            if (json_last_error() == JSON_ERROR_NONE) {
                return $content;
            } else {
                throw new InvalidJsonException(json_last_error_msg());
            }
        }
        return $body;
    }

    /**
     * @param ResponseInterface $response
     * @param $name
     * @return mixed
     */
    public static function getHeader(ResponseInterface $response, $name)
    {
        $headers = $response->getHeader($name);
        return isset($headers[0]) ? $headers[0] : null;
    }
}
