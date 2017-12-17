<?php

namespace AppBundle\Action\AbstractCRUD;

use AppBundle\Action\SerializerTrait;
use AppBundle\Action\ValidatorTrait;
use AppBundle\Exception\BadRequestApiException;
use Symfony\Component\HttpFoundation\Request;

/**
 * Create action
 */
abstract class AbstractCreateAction extends AbstractCrudAction
{
    use SerializerTrait;
    use ValidatorTrait;

    /**
     * Run action
     *
     * @param Request $request
     *
     * @return object
     *
     * @throws BadRequestApiException
     */
    public function __invoke(Request $request)
    {
        $content = $request->getContent();
        if (empty($content)) {
            throw new BadRequestApiException("Empty request body");
        }

        $newData = $this->deserialize($content);
        $this->validate($newData);

        $this->em->persist($newData);
        $this->em->flush();

        return $newData;
    }
}
