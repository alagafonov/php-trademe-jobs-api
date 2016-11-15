<?php namespace Trademe\HttpClient\Plugins;

use Http\Client\Common\Plugin;
use Psr\Http\Message\RequestInterface;
use Trademe\Exceptions\NotFoundException;
use Trademe\Exceptions\ServerErrorException;
use Trademe\Exceptions\BadRequestException;
use Trademe\HttpClient\Utilities\Response;



// Api limit
// Auth

use Psr\Http\Message\ResponseInterface;

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
        return $next($request)->then(function (ResponseInterface $response) use ($request) {
            $statusCode = $response->getStatusCode();
            //echo $statusCode.' : '.$response->getBody()->__toString(); exit;
            if ($statusCode < 400 || $statusCode > 600) {
                return $response;
            } elseif ($statusCode == 404) {
                throw new NotFoundException('Resource not found');
            } elseif ($statusCode == 400) {
                $content = Response::getContent($response);
                throw new BadRequestException($content['ErrorDescription']);
            }



            //400 - Bad Request
            //401 - Unauthorized

            throw new ServerErrorException('Server error');
        });
    }
}
