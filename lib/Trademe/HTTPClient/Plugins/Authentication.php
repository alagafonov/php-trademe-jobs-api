<?php namespace Trademe\HttpClient\Plugins;

use Http\Client\Common\Plugin;
use Psr\Http\Message\RequestInterface;

/**
 * Authentication plugin.
 */
class Authentication implements Plugin
{
    /**
     * @var string
     */
    private $consumerKey;

    /**
     * @var string
     */
    private $consumerSecret;

    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var string
     */
    private $tokenSecret;

    /**
     * @param $consumerKey
     * @param $consumerSecret
     * @param null $accessToken
     * @param null $tokenSecret
     */
    public function __construct($consumerKey, $consumerSecret, $accessToken = null, $tokenSecret = null)
    {
        $this->consumerKey = $consumerKey;
        $this->consumerSecret = $consumerSecret;
        $this->accessToken = $accessToken;
        $this->tokenSecret = $tokenSecret;
    }

    /**
     * @param RequestInterface $request
     * @param callable $next
     * @param callable $first
     * @return mixed
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first)
    {
        if ($this->accessToken === null || $this->tokenSecret === null) {
            $request = $request->withHeader(
                'Authorization',
                sprintf(
                    'OAuth oauth_consumer_key="%s", oauth_signature_method="PLAINTEXT", oauth_signature="%s&"',
                    $this->consumerKey,
                    $this->consumerSecret
                )
            );
        } else {
            $request = $request->withHeader(
                'Authorization',
                sprintf(
                    'OAuth oauth_consumer_key="%s", oauth_token="%s", oauth_signature_method="PLAINTEXT", ' .
                    'oauth_signature="%s&%s"',
                    $this->consumerKey,
                    $this->accessToken,
                    $this->consumerSecret,
                    $this->tokenSecret
                )
            );
        }

        return $next($request);
    }
}
