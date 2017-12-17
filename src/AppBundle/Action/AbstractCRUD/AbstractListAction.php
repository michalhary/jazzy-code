<?php

namespace AppBundle\Action\AbstractCRUD;

use AppBundle\Action\AbstractCRUD\AbstractCrudAction;
use Symfony\Component\HttpFoundation\Request;

/**
 * List action
 */
abstract class AbstractListAction extends AbstractCrudAction
{

    /**
     * Run action
     *
     * @param Request $request
     *
     * @return array
     */
    public function __invoke(\Symfony\Component\HttpFoundation\Request $request)
    {
        $repository = $this->getRepository();
        return $repository->findAll();
    }
}