<?php

namespace AppBundle\Action\Gnomes;

use AppBundle\Action\AbstractCRUD\AbstractDeleteAction;

/**
 * Delete gnome action
 */
final class DeleteGnomeAction extends AbstractDeleteAction
{
    use GnomeDataClassTrait;
}
