<?php namespace Trademe\Api;

use Psr\Http\Message\ResponseInterface;

class Response
{
    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * @return mixed|string
     * @throws InvalidJsonException
     */
    public function getContent()
    {
        $body = $this->response->getBody()->__toString();
        if (strpos($this->response->getHeaderLine('Content-Type'), 'application/json') === 0) {
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
    public function getHeader(ResponseInterface $response, $name)
    {
        $headers = $response->getHeader($name);
        return isset($headers[0]) ? $headers[0] : null;
    }
}
