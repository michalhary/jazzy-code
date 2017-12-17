<?php

namespace AppBundle\Action\AbstractCRUD;

use AppBundle\Exception\NotFoundApiException;
use Symfony\Component\HttpFoundation\Request;

/**
 * Read action
 */
abstract class AbstractReadAction extends AbstractCrudAction
{
    /**
     * Run action
     *
     * @param Request $request
     * @param int $id object id
     *
     * @return object
     * 
     * @throws NotFoundApiException
     */
    public function __invoke(Request $request, int $id)
    {
        return $this->findOneById($id);
    }
}