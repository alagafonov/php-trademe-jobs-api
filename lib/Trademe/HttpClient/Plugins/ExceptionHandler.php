<?php namespace Trademe\HttpClient\Plugins;

use Http\Client\Common\Plugin;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Trademe\Exceptions\BadRequestException;
use Trademe\Exceptions\NotFoundException;
use Trademe\Exceptions\ApiErrorException;
use Trademe\HttpClient\Utilities\Response;

/**
 * Response exception handler class.
 */
class ExceptionHandler implements Plugin
{
    /**
     * @param RequestInterface $request
     * @param callable $next
     * @param callable $first
     * @return mixed
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first)
    {
        return $next($request)->then(
            function (ResponseInterface $response) use ($request) {
                $statusCode = $response->getStatusCode();
                $content = Response::getContent($response);
                //echo $statusCode.' : '.$response->getBody()->__toString(); exit;
                if ($statusCode < 400 || $statusCode > 600) {
                    if (array_key_exists('Success', $content) && !$content['Success']) {
                        throw new ApiErrorException($content['Description']);
                    }
                    return $response;
                } elseif ($statusCode == 404) {
                    throw new NotFoundException('Resource not found');
                } elseif ($statusCode == 400) {
                    throw new BadRequestException($content['ErrorDescription']);
                }
                throw new ApiErrorException(
                    isset($content['ErrorDescription']) ? $content['ErrorDescription'] : 'Unknown server error'
                );
            }
        );
    }
}
