<?php

namespace AppBundle\Action\AbstractCRUD;

use AppBundle\Action\SerializerTrait;
use AppBundle\Action\ValidatorTrait;
use AppBundle\Exception\BadRequestApiException;
use AppBundle\Exception\NotFoundApiException;
use Symfony\Component\HttpFoundation\Request;

/**
 * Update action
 */
abstract class AbstractUpdateAction extends AbstractCrudAction
{

    use SerializerTrait;
    use ValidatorTrait;

    /**
     * Run action
     *
     * @param Request $request
     * @param int $id object id
     *
     * @return object
     *
     * @throws NotFoundApiException
     * @throws BadRequesApiHttpException
     */
    public function __invoke(Request $request, int $id)
    {
        $content = $request->getContent();
        if (empty($content)) {
            throw new BadRequestApiException("Empty request body");
        }

        $bodyId = $request->request->get('id', null);
        if ($bodyId !== null && (int) $bodyId !== $id) {
            throw new BadRequestApiException('Id in query parameter doesn\'t match id in request body');
        }
        unset($bodyId);

        $oldData = $this->findOneById($id);
        $newData = $this->deserialize($content);
        $newData->setId($oldData->getId());
        unset($oldData);
        
        $this->validate($newData);

        $this->em->merge($newData);
        $this->em->flush();

        return $newData;
    }
}