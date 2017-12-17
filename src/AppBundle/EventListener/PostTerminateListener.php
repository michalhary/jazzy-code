<?php

namespace AppBundle\EventListener;

use AppBundle\Manager\TmpFilesManagerInterface;
use Symfony\Component\HttpKernel\Event\PostResponseEvent;

final class PostTerminateListener
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
     * @param PostResponseEvent $event
     */
    public function onKernelTerminate(PostResponseEvent $event)
    {
        $this->tmpManager->deleteAll();
    }
}
