<?php

namespace AppBundle\Action\Gnomes;

use Symfony\Component\HttpFoundation\Request;

/**
 * Delete gnome action
 */
final class DeleteGnomeAction
{

    /**
     * Run action
     *
     * @param Request $request
     * @param int $id Gnome id
     */
    public function __invoke(Request $request, int $id)
    {
        // @todo
        throw new \Exception('@TODO');
    }
}
