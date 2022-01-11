<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Validator\CategoryValidator;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class Step2_CategoryFixtures extends Fixture implements FixtureGroupInterface
{
    private $data =[
        ["1","Documentation","fas fa-book"],
        ["2","Application","fas fa-chalkboard-teacher"],
        ["3",'Intranet',"fas fa-globe"],
        ["4",'Annuaire',"fas fa-address-card"],
    ];
    /**
     * @var CategoryValidator
     */
    private $validator;

    /**
     * @var EntityManagerInterface
     */
    private $entityManagerInterface;

    public function __construct(
        CategoryValidator $validator,
        EntityManagerInterface $entityManagerI
    ) {
        $this->validator = $validator;
        $this->entityManagerInterface = $entityManagerI;
    }

    public function load(ObjectManager $manager)
    {

        for ($i = 0; $i < \count($this->data); $i++) {

            $instance = $this->initialise(new Category(), $this->data[$i]);

            $this->checkAndPersist($instance);
        }
        $this->entityManagerInterface->flush();
    }


    private function checkAndPersist(Category $instance)
    {
        if ($this->validator->isValid($instance)) {
            $metadata = $this->entityManagerInterface->getClassMetadata(Category::class);
            $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
            $this->entityManagerInterface->persist($instance);
            return;
        }
        var_dump('Validator : ' . $this->validator->getErrors($instance));
    }

    private function initialise(Category $instance, $data): Category
    {
        $instance
            ->setId($data[0])
            ->setName($data[1])
            ->setIcon($data[2])
            ;
        return $instance;
    }


    public static function getGroups(): array
    {
        return ['step2'];
    }
}
