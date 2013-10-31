<?php
namespace Goyello\ToolBoxBundle\Storages;

/**
 * Class StorageFactory creates instances of storages.
 * @package Goyello\ToolBoxBundle\Storages
 */
interface StorageFactory
{

    /**
     * Creates an instance of storage for specified entity.
     * @param string $entityName name using Doctrine convention (BundleName:EntityName)
     * @return mixed
     */
    public function createInstance($entityName);
}