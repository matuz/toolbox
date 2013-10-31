<?php
namespace Goyello\ToolBoxBundle\Interactors;

use Kws\DviBundle\Storage\Storages;

/**
 * Class StorageInteractor
 * @package Goyello\ToolBoxBundle\Interactors
 */
abstract class StorageInteractor implements Interactor
{
    /**
     * @var Storages
     */
    private $storages;

    /**
     * @param Storages $storages
     */
    function __construct(Storages $storages)
    {
        $this->storages = $storages;
    }

    /**
     * @param Storages $storages
     */
    public function setStorages($storages)
    {
        $this->storages = $storages;
    }

    /**
     * @return Storages
     */
    public function getStorages()
    {
        return $this->storages;
    }

    /**
     * @return Response
     */
    abstract public function execute();
}