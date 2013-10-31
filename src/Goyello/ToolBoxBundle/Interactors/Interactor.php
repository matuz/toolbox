<?php
namespace Goyello\ToolBoxBundle\Interactors;

/**
 * Interface Interactor
 * @package Goyello\ToolBoxBundle\Interactors
 */
interface Interactor
{
    /**
     * @return Response
     */
    public function execute();
}
