<?php

namespace AppBundle\Action\Gnomes;

use AppBundle\Entity\Gnome;

/**
 * Gnome Data Class Trait
 */
trait GnomeDataClassTrait
{
    /**
     * Get Gnome entity class
     *
     * @return string class
     */
    final protected function getDataClass(): string
    {
        return Gnome::class;
    }
}
