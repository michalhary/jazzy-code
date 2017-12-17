<?php

namespace AppBundle\Action\Gnomes;

use AppBundle\Action\AbstractCRUD\AbstractCreateAction;

/**
 * Create gnome action
 */
final class CreateGnomeAction extends AbstractCreateAction
{
    use GnomeDataClassTrait;
}
