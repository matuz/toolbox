<?php
namespace Goyello\ToolBoxBundle\Interactors;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class RestInteractor
 * @package Goyello\ToolBoxBundle\Interactors
 */
abstract class RestInteractor implements Interactor
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var \Buzz\Browser
     */
    protected $client;

    /**
     * @var string
     */
    protected $apiHost;

    /**
     *  Create client object
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->apiHost = $container->getParameter('dvi_api_host');
        $this->client = $this->container->get('buzz');
    }

    /**
     * @return Response
     */
    abstract protected function executeRest();

    /**
     * @return Response
     */
    public function execute() {
        return $this->executeRest();
    }

    /**
     * @param string $result
     * @return \stdClass
     */
    protected function parse($result)
    {
        return json_decode($result);
    }

    /**
     * @param \Exception $e
     * @return string
     */
    protected function getClientExceptionMessage(\Exception $e)
    {
        switch ($e->getCode()) {
            case 28 :
                //Request timed out
                $message = "Timed out";
                break;
            case 6 :
                //Couldn't resolve host name
                $message = "Hosted out";
                break;
            default:
                $message = "Chill out";
        }

        return $message;
    }
}