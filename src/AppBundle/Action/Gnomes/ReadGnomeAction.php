<?php

namespace AppBundle\Action\Gnomes;

use AppBundle\Action\AbstractCRUD\AbstractReadAction;

/**
 * Read gnome (single) action
 */
final class ReadGnomeAction extends AbstractReadAction
{
    use GnomeDataClassTrait;
}
