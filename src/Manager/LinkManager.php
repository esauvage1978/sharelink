<?php

namespace App\Manager;

use App\Entity\EntityInterface;
use App\Validator\LinkValidator;
use Doctrine\ORM\EntityManagerInterface;

class LinkManager extends AbstractManager
{
    public function __construct(
        EntityManagerInterface $manager,
        LinkValidator $validator
    ) {
        parent::__construct($manager, $validator);
    }

    public function initialise(EntityInterface $entity): void
    {
   
    }
}
