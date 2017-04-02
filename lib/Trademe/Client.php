<?php namespace Trademe;

use Http\Client\Common\HttpMethodsClient;
use Http\Client\Common\Plugin;
use Http\Client\Common\Plugin\BaseUriPlugin;
use Http\Client\Common\PluginClient;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Discovery\UriFactoryDiscovery;
use Trademe\Api\EndPointInterface;
use Trademe\HttpClient\Plugins\Authentication;
use Trademe\HttpClient\Plugins\ExceptionHandler;

/**
 * PHP trademe.co.nz jobs API client.
 *
 * @method Api\Category category()
 * @method Api\Locality locality()
 * @method Api\Listing listing()
 *
 * Website: https://github.com/alagafonov/php-trademe-jobs-api
 */
class Client
{
    /**
     * @var string
     */
    protected $apiUrl = 'https://api.trademe.co.nz/v1';

    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @var Plugin[]
     */
    private $plugins = [];

    /**
     * @var PluginClient
     */
    private $pluginClient;

    /**
     * @var MessageFactory
     */
    private $messageFactory;

    /**
     * @var bool
     */
    private $createNewHttpClient = true;

    /**
     * @param HttpClient|null $httpClient
     */
    public function __construct(HttpClient $httpClient = null)
    {
        $this->httpClient = $httpClient ?: HttpClientDiscovery::find();
        $this->messageFactory = MessageFactoryDiscovery::find();
        $this->addPlugin(new BaseUriPlugin(UriFactoryDiscovery::find()->createUri($this->apiUrl), ['replace' => true]));
        $this->addPlugin(new ExceptionHandler());
    }

    /**
     * @param $name
     * @return Api\Category|Api\Listing|Api\Locality
     * @throws UnknownMethodException
     */
    public function api($name)
    {
        switch ($name) {
            case 'category':
                $api = new Api\Category($this);
                break;
            case 'locality':
                $api = new Api\Locality($this);
                break;
            case 'listing':
                $api = new Api\Listing($this);
                break;
            default:
                throw new UnknownMethodException('Undefined end point instance called: "' . $name . '"');
        }
        return $api;
    }

    /**
     * @param $name
     * @param $args
     * @return Api\Category|Api\Listing|Api\Locality
     * @throws UnknownMethodException
     */
    public function __call($name, $args)
    {
        return $this->api($name);
    }

    /**
     * @param $consumerKey
     * @param $consumerSecret
     * @param null $accessToken
     * @param null $tokenSecret
     */
    public function authenticate($consumerKey, $consumerSecret, $accessToken = null, $tokenSecret = null)
    {
        $this->removePlugin(Authentication::class);
        $this->addPlugin(new Authentication($consumerKey, $consumerSecret, $accessToken, $tokenSecret));
    }

    /**
     * @param Plugin $plugin
     */
    public function addPlugin(Plugin $plugin)
    {
        $this->plugins[get_class($plugin)] = $plugin;
        $this->createNewHttpClient = true;
    }

    /**
     * @param $name
     */
    public function removePlugin($name)
    {
        unset($this->plugins[$name]);
        $this->createNewHttpClient = true;
    }

    /**
     * @return HttpMethodsClient
     */
    public function getHttpClient()
    {
        if ($this->createNewHttpClient) {
            $this->createNewHttpClient = false;
            $this->pluginClient = new HttpMethodsClient(
                new PluginClient($this->httpClient, $this->plugins),
                $this->messageFactory
            );
        }
        return $this->pluginClient;
    }

    /**
     * @param HttpClient $httpClient
     */
    public function setHttpClient(HttpClient $httpClient)
    {
        $this->createNewHttpClient = true;
        $this->httpClient = $httpClient;
    }
}
