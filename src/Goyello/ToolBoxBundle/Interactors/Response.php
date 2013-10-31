<?php
namespace Goyello\ToolBoxBundle\Interactors;

/**
 * Base data structure class, carry data from interactors to controllers or other interactors.
 * @package Goyello\ToolBoxBundle\Interactors
 */
class Response
{
    const RESPONSE_FAILED = 1;

    const RESPONSE_SUCCESS = 0;

    /**
     * @var mixed
     */
    private $content;

    /**
     * @var int
     */
    private $status = self::RESPONSE_SUCCESS;

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $inputData
     */
    public function __construct($inputData)
    {
        $this->content = $inputData;
    }

    /**
     * @return int
     */
    protected function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    protected function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return bool
     */
    public function failed()
    {
        return $this->getStatus() === self::RESPONSE_FAILED;
    }
}