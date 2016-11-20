<?php namespace Trademe\HttpClient\Plugins;

use Http\Client\Common\Plugin;
use Psr\Http\Message\RequestInterface;

class ApiUrl implements Plugin
{
    /**
     * @var string
     */
    private $url;

    /**
     * @param string
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * @param RequestInterface $request
     * @param callable $next
     * @param callable $first
     * @return mixed
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first)
    {
        $currentPath = $request->getUri()->getPath();
        $uri = $request->getUri()->withPath($this->url . $currentPath);
        return $next($request->withUri($uri));
    }
}
