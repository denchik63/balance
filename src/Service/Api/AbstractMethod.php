<?php

namespace App\Service\Api;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AbstractMethod
{
    /** @var ValidatorInterface */
    private $validator;

    /** @var EntityManagerInterface */
    protected $entityManager;

    public function __construct(ValidatorInterface $validator, EntityManagerInterface $entityManager)
    {
        $this->validator = $validator;
        $this->entityManager = $entityManager;
    }

    protected function validateObject($object): void
    {
        $errors = $this->validator->validate($object);
        if (count($errors)) {
            $messages = [];
            foreach ($errors as $error) {
                $messages[] = $error->getMessage();
            }
            throw new \InvalidArgumentException(implode(', ', $messages));
        }
    }
}