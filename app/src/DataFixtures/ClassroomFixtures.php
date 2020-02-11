<?php

namespace App\DataFixtures;

use App\Entity\Classroom;
use Exception;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

/**
 * @see     https://symfony.com/doc/master/bundles/DoctrineFixturesBundle/index.html
 * @author  Gaëtan Rolé-Dubruille <gaetan.role-dubruille@sensiolabs.com>
 */
final class ClassroomFixtures extends Fixture implements FixtureGroupInterface
{
    /** @var string public CONST for reference used in other fixtures, concat to a classroom name. */
    public const CLASSROOM_REFERENCE = 'classroom-';

    /**
     * Load ten classrooms to DB.
     *
     * @link    https://github.com/fzaninotto/Faker
     * @throws  Exception Datetime Exception
     */
    public function load(ObjectManager $manager): void
    {
        foreach ($this->getClassroom() as [$name, $grade]) {
            $classroom = new Classroom();

            $classroom->setName($name);
            $classroom->setGrade($grade);

            $manager->persist($classroom);
            $this->addReference(self::CLASSROOM_REFERENCE.strtolower($name), $classroom);
        }

        $manager->flush();
    }

    /**
     * Get an array of random Classroom names and grades.
     */
    private function getClassroom(): array
    {
        return [
            ['Einstein', 5],
            ['Luther King', 4],
            ['Pompidou', 1],
            ['Gaulle', 6],
            ['Jefferson', 3],
            ['Lincoln', 2],
            ['Garfield', 6],
            ['Roosevelt', 5],
            ['Mandela', 1],
            ['Reagan', 4],
        ];
    }

    public static function getGroups(): array
    {
        return ['independent'];
    }
}
