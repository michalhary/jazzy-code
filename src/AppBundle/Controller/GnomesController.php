<?php

namespace AppBundle\Controller;

use AppBundle\Action\Gnomes\CreateGnomeAction;
use AppBundle\Action\Gnomes\DeleteGnomeAction;
use AppBundle\Action\Gnomes\ReadGnomeAction;
use AppBundle\Action\Gnomes\ReadGnomesAction;
use AppBundle\Action\Gnomes\UpdateGnomeAction;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Gnomes controller
 *
 * @Rest\Prefix("/gnomes")
 * @Rest\NamePrefix("api_gnomes_")
 */
final class GnomesController extends AbstractController
{

    /**
     * Get list of all gnomes
     *
     * @Rest\Get("")
     *
     * @ApiDoc(
     *  section="Gnomes",
     *  resource=true,
     *  description="list action",
     *  output={
     *    "class"="AppBundle\Entity\Gnome",
     *    "groups"={"basic"},
     *    "parsers"={"Nelmio\ApiDocBundle\Parser\JmsMetadataParser"}
     *  },
     *  statusCodes={
     *    200="Success. Return list of all gnomes"
     *  }
     * )
     *
     * @param Request $request
     */
    public function listAction(Request $request, ReadGnomesAction $action)
    {
        return $action($request);
    }

    /**
     * Create new gnome
     *
     * @Rest\Post("")
     *
     * @ApiDoc(
     *  section="Gnomes",
     *  resource=true,
     *  description="create action",
     *  input={
     *    "class"="AppBundle\Entity\Gnome",
     *    "groups"={"full"}
     *  },
     *  output={
     *    "class"="AppBundle\Entity\Gnome",
     *    "groups"={"full"},
     *    "parsers"={"Nelmio\ApiDocBundle\Parser\JmsMetadataParser"}
     *  },
     *  parameters={
     *    {"name"="strength", "dataType"="integer","format"="{min: 0, max: 100}"},
     *    {"name"="age", "dataType"="integer","format"="{min: 0, max: 100}"}
     *  },
     *  statusCodes={
     *    200="Success. Return created gnome",
     *    400="Bad request - invalid data. Return error message"
     *  }
     * )
     *
     * @param Request $request
     */
    public function createAction(Request $request, CreateGnomeAction $action)
    {
        return $action($request);
    }

    /**
     * Get gnome by id
     *
     * @Rest\Get("/{id}", requirements={"id"="\d+"})
     *
     * @ApiDoc(
     *  section="Gnomes",
     *  resource=true,
     *  description="read action",
     *  output={
     *    "class"="AppBundle\Entity\Gnome",
     *    "groups"={"full"},
     *    "parsers"={"Nelmio\ApiDocBundle\Parser\JmsMetadataParser"}
     *  },
     *  requirements={
     *    {
     *       "name"="id",
     *       "dataType"="integer",
     *       "requirement"="\d+",
     *       "description"="Gnome's id"
     *     }
     *  },
     *  statusCodes={
     *    200="Success. Return gnome",
     *    404="Not found - gnome does not exist. Return error message"
     *  }
     * )
     *
     * @param Request $request
     * @param int id Gnome id
     */
    public function readAction(Request $request, int $id, ReadGnomeAction $action)
    {
        return $action($request, $id);
    }

    /**
     * Update gnome by id
     *
     * @Rest\Put("/{id}", requirements={"id"="\d+"})
     *
     * @ApiDoc(
     *  section="Gnomes",
     *  resource=true,
     *  description="update action",
     *  input={
     *    "class"="AppBundle\Entity\Gnome",
     *    "groups"={"full"}
     *  },
     *  output={
     *    "class"="AppBundle\Entity\Gnome",
     *    "groups"={"full"},
     *    "parsers"={"Nelmio\ApiDocBundle\Parser\JmsMetadataParser"}
     *  },
     *  requirements={
     *    {
     *       "name"="id",
     *       "dataType"="integer",
     *       "requirement"="\d+",
     *       "description"="Gnome's id"
     *     }
     *  },
     *  parameters={
     *    {"name"="strength", "dataType"="integer","format"="{min: 0, max: 100}"},
     *    {"name"="age", "dataType"="integer","format"="{min: 0, max: 100}"}
     *  },
     *  statusCodes={
     *    200="Success. Return updated gnome",
     *    404="Not found - gnome does not exist. Return error message",
     *    400="Bad request - invalid data. Return error message"
     *  }
     * )
     *
     * @param Request $request
     * @param int id Gnome id
     */
    public function updateAction(Request $request, int $id, UpdateGnomeAction $action)
    {
        return $action($request, $id);
    }

    /**
     * Delete gnome by id
     *
     * @Rest\Delete("/{id}", requirements={"id"="\d+"})
     *
     * @ApiDoc(
     *  section="Gnomes",
     *  resource=false,
     *  description="delete action",
     *  requirements={
     *    {
     *       "name"="id",
     *       "dataType"="integer",
     *       "requirement"="\d+",
     *       "description"="Gnome's id"
     *     }
     *  },
     *  statusCodes={
     *    200="Success",
     *    404="Not found - gnome does not exist. Return error message"
     *  }
     * )
     *
     * @param Request $request
     * @param int id Gnome id
     */
    public function deleteAction(Request $request, int $id, DeleteGnomeAction $action)
    {
        return $action($request, $id);
    }
}