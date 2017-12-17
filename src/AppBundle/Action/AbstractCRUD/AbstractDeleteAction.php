<?php

namespace AppBundle\Action\AbstractCRUD;

use Symfony\Component\HttpFoundation\Request;

/**
 * Delete action
 */
abstract class AbstractDeleteAction extends AbstractCrudAction
{

    /**
     * Run action
     *
     * @param Request $request
     * @param int $id object id
     */
    public function __invoke(Request $request, int $id)
    {
        $data =  $this->findOneById($id);

        $this->em->remove($data);
        $this->em->flush();

        return true;
    }
}
