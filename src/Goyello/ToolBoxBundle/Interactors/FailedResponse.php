<?php
namespace Goyello\ToolBoxBundle\Interactors;

/**
 * Class FailedResponse
 * @package Goyello\ToolBoxBundle\Interactors
 */
class FailedResponse extends Response
{
    /**
     * @param mixed $inputData
     */
    public function __construct($inputData = null)
    {
        parent::__construct($inputData);
        $this->setStatus(self::RESPONSE_FAILED);
    }

}