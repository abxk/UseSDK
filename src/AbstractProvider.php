<?php

declare(strict_types=1);

namespace abxk;

use GuzzleHttp\Psr7\Utils;
use abxk\Contract\HttpClientInterface;
use abxk\Contract\PluginInterface;
use abxk\Contract\ShortcutInterface;
use abxk\Exception\BaseException;
use abxk\Exception\ConfigException;
use abxk\Exception\ParamsException;
use abxk\Exception\ResponseException;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\MessageInterface;
use Throwable;

abstract class AbstractProvider
{
    abstract public function __call(string $shortcut, array $params);

    abstract public function mergeCommonPlugins(array $plugins): array;

    /**
     *
     * @param string $plugin
     * @param array $params
     * @return MessageInterface|DS|array|null
     */
    public function call(string $plugin, array $params = [])
    {
        if (!class_exists($plugin) || !in_array(ShortcutInterface::class, class_implements($plugin))) {
            throw new ParamsException(BaseException::SHORTCUT_NOT_FOUND, "[$plugin] is not incompatible");
        }

        /* @var ShortcutInterface $money */
        $money = Container::getInstance()->get($plugin);

        return $this->run(
            $this->mergeCommonPlugins($money->getPlugins($params)), $params
        );
    }

    /**
     * 执行
     *
     * @param array $plugins
     * @param array $params
     *
     * @return MessageInterface|DS|array|null
     */
    public function run(array $plugins, array $params)
    {
        $this->verifyPlugin($plugins);

        $pipeline = new Pipeline(Container::getInstance());

        /* @var Structure $structure */
        $structure = $pipeline
            ->send((new Structure())->setParams($params))
            ->through($plugins)
            ->via('assembly')
            ->then(function ($structure) {
                return $this->analysis($structure);
            });

        return $structure->getResponse();
    }

    /**
     * 解析 最终通过数据管道 （Pipeline） 的数据
     * @param Structure $structure
     * @return Structure
     */
    public function analysis(Structure $structure): Structure
    {
        if (!Fun::should_do_http_request($structure->getResponse())) {
            return $structure;
        }

        /* @var HttpClientInterface $http  准备请求API服务端*/
        $http = Container::getInstance()->get(HttpClientInterface::class);

        if (!($http instanceof ClientInterface)) {
            throw new ConfigException(BaseException::HTTP_CLIENT_CONFIG_ERROR);
        }

        try {
            $response = $http->sendRequest($structure->getRequest());
            $contents = $response->getBody()->getContents();

            $structure->setResponse($response->withBody(Utils::streamFor($contents)))
                ->setResponseOrigin($response->withBody(Utils::streamFor($contents)));
        } catch (Throwable $e) {

            throw new ResponseException(BaseException::REQUEST_RESPONSE_ERROR, $e->getMessage(), [], $e);
        }

        return $structure;
    }


    /**
     * @param array $plugins
     * @throws ParamsException
     */
    protected function verifyPlugin(array $plugins): void
    {
        foreach ($plugins as $plugin) {
            if (is_callable($plugin)) {
                continue;
            }

            if ((is_object($plugin) ||
                    (is_string($plugin) && class_exists($plugin))) &&
                in_array(PluginInterface::class, class_implements($plugin))) {
                continue;
            }

            throw new ParamsException(BaseException::PLUGIN_ERROR, "[$plugin] is not incompatible");
        }
    }
}
