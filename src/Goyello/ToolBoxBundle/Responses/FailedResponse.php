<?php
namespace Goyello\ToolBoxBundle\Responses;

/**
 * Class FailedResponse
 * @package Goyello\ToolBoxBundle\Responses
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