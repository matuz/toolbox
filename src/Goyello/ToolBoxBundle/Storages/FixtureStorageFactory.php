<?php
namespace Goyello\ToolBoxBundle\Storages;

use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;

/**
 * Class FixtureStorageFactory is a factory for fixtures.
 * @package Goyello\ToolBoxBundle\Storages
 */
class FixtureStorageFactory implements StorageFactory
{

    /**
     * Creates a storage with fixed entities.
     * @param string $entityName
     * @return mixed|void
     * @throws InvalidArgumentException
     */
    public function createInstance($entityName)
    {
        switch ($entityName) {

            default:
                throw new InvalidArgumentException("Bad storage service name");
        }
    }
}