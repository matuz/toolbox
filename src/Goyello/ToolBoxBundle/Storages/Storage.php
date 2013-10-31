<?php
namespace Goyello\ToolBoxBundle\Storages;

/**
 * Class Storage contains wrappers for retrieving entity storage engines
 * @package Goyello\ToolBoxBundle\Storages
 */
class Storage
{
    /**
     * @var StorageFactory
     */
    private $storageFactory;

    /**
     * @var array
     */
    private $instances;

    /**
     * @return StorageFactory
     */
    public function getStorageFactory()
    {
        return $this->storageFactory;
    }

    /**
     * @param StorageFactory $storageFactory
     */
    public function setStorageFactory($storageFactory)
    {
        $this->storageFactory = $storageFactory;
    }

    /**
     * Retrieves storage for given entity.
     * @param string $entityName name using Doctrine convention (BundleName:EntityName)
     * @return mixed An instance of storage created with the factory
     */
    public function getStorage($entityName)
    {
        if (!isset($this->instances[$entityName])) {
            $this->instances[$entityName] = $this->getStorageFactory()->createInstance($entityName);
        }

        return $this->instances[$entityName];
    }
}