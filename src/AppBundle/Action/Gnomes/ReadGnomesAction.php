<?php

namespace AppBundle\Action\Gnomes;

use AppBundle\Action\AbstractCRUD\AbstractListAction;

/**
 * Read gnomes (list of all) action

 */
final class ReadGnomesAction extends AbstractListAction
{
    use GnomeDataClassTrait;
}
