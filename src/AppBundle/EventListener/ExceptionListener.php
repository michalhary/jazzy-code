<?php

namespace AppBundle\EventListener;

use AppBundle\Manager\TmpFilesManagerInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

final class ExceptionListener
{
    /**
     * Temporary files manager
     *
     * @var TmpFilesManagerInterface
     */
    private $tmpManager;

    /**
     * Constructor
     *
     * @param TmpFilesManagerInterface $tmpManager
     */
    public function __construct(TmpFilesManagerInterface $tmpManager)
    {
        $this->tmpManager = $tmpManager;
    }

    /**
     * Post Response Event
     *
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $this->tmpManager->deleteAll();
    }
}
