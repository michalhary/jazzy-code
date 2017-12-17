<?php

namespace AppBundle\Action;

use AppBundle\Exception\BadRequestApiException;
use Symfony\Component\Validator\Constraints\Required;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Serializer Trait
 */
trait ValidatorTrait
{
    /**
     * Validator
     *
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * Set dependency
     *
     * @Required
     *
     * @ignore
     * @param ValidatorInterface $validator
     */
    final public function setValidator(ValidatorInterface $validator): void
    {
        $this->validator = $validator;
    }

    /**
     * Validate object
     * Throws exception if constraint violations exist
     *
     * @param object $data
     * @param string[] $groups
     *
     * @throws BadRequesApiHttpException
     */
    protected function validate($data): void
    {
        /* @var $violations ConstraintViolationListInterface */
        /* @var $violation ConstraintViolationInterface */
        $violations = $this->validator->validate($data);
        if ($violations->count() > 0) {
            $messages = '';
            foreach ($violations as $violation) {
                $messages .= sprintf('Invalid property "%s". %s ', $violation->getPropertyPath(), $violation->getMessage());
            }
            throw new BadRequestApiException(trim($messages));
        }
    }
}
