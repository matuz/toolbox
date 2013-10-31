<?php
namespace Goyello\ToolBoxBundle\Interactors;

use Memcache;


/**
 * Class MemcacheRestInteractor
 * @package Goyello\ToolBoxBundle\Interactors
 */
abstract class CachedRestInteractor extends RestInteractor
{

    const TTL_FAILED_RESPONSE = 60;

    const TTL_DEFAULT = 3600;

    /**
     * @var int
     */
    private $ttl = self::TTL_DEFAULT;

    /**
     * @var array
     */
    private $keyParts = array();

    /**
     * @var bool
     */
    private $forceUpdate = false;

    /**
     * @return Response
     */
    public function execute()
    {

        $key = $this->prepareCacheKey();

        if ($this->getForceUpdate() === false) {
            $cachedResponse = $this->getCachedResponse($key);

            if ($cachedResponse) {
                return $cachedResponse;
            }

        }

        $response = $this->executeRest();

        $this->setCacheResponse($key, $response);

        return $response;

    }

    /**
     * @return string
     */
    private function prepareCacheKey()
    {
        $this->setKeyParams();

        //TODO : Remove host?
        return get_class($this) . '_' . md5($this->getKeyParts()) . '_' . $this->container->get('request')->getHost();
    }

    /**
     * @param string $key
     * @return Response
     */
    private function getCachedResponse($key)
    {
        /** @var $memcache Memcache */
        $memcache = $this->container->get('memcache');
        try {
            $response = $memcache->get($key);
        } catch (\Exception $e) {
            return null;
        }

        if ($response) {
            return $response;
        }

        return null;

    }

    /**
     * @param string $key
     * @param Response $response
     */
    private function setCacheResponse($key, $response)
    {
        /** @var $memcache Memcache */
        $memcache = $this->container->get('memcache');

        if ($response->failed()) {
            $memcache->set($key, $response, 0, self::TTL_FAILED_RESPONSE);
        } else {
            $memcache->set($key, $response, 0, $this->ttl);
        }
    }

    /**
     * @return mixed
     */
    public function getTtl()
    {
        return $this->ttl;
    }

    /**
     * @param mixed $ttl
     */
    public function setTtl($ttl)
    {
        $this->ttl = $ttl;
    }

    /**
     * @param boolean $forceUpdate
     */
    public function setForceUpdate($forceUpdate)
    {
        $this->forceUpdate = $forceUpdate;
    }

    /**
     * @return boolean
     */
    public function getForceUpdate()
    {
        return $this->forceUpdate;
    }

    /**
     * @return mixed
     */
    public function getKeyParts()
    {
        $toReturn = '';
        foreach ($this->keyParts as $part) {
            $functionName = 'get' . ucfirst($part);
            if ($this->$functionName()) {
                $toReturn .= $part . '=' . $this->$functionName();
            }
        }

        return $toReturn;
    }

    /**
     * @param mixed $keyPart
     */
    public function addKeyPart($keyPart)
    {
        $this->keyParts[] = $keyPart;
    }

    /**
     * In this method you need to set params that will be converted to cacheKey
     * Use addKeyPart method to accomplish the task.
     *
     * @return void
     */
    protected abstract function setKeyParams();
}