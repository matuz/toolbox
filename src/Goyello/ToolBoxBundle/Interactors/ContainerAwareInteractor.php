<?php
namespace Goyello\ToolBoxBundle\Interactors;

use Symfony\Component\DependencyInjection\Container;

/**
 * Class ContainerAwareInteractor
 * @package Goyello\ToolBoxBundle\Interactors
 */
abstract class ContainerAwareInteractor implements Interactor
{
    /**
     * @var Container
     */
    private $container;

    /**
     * @param Container $container
     */
    function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @return Container
     */
    protected function getContainer()
    {
        return $this->container;
    }

}