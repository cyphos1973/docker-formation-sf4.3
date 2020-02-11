<?php

namespace App\Entity;

use App\Entity\Traits\EntityIdTrait;
use App\Entity\Traits\EntityTimeTrait;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Ramsey\Uuid\Uuid;

/**
 * @todo    Write assertions with Validator components
 * @author  Gaëtan Rolé-Dubruille <gaetan.role-dubruille@sensiolabs.com>
 * @ORM\Entity(repositoryClass="App\Repository\StudentRepository")
 */
class Student
{
    use EntityIdTrait;
    use EntityTimeTrait;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $lastName;

    /**
     * @ORM\Column(type="date_immutable")
     */
    private $birthDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $gender;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $firstMark;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $secondMark;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Classroom", inversedBy="students")
     */
    private $classroom;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2, nullable=true)
     */
    private $average;

    /** @throws Exception */
    public function __construct()
    {
        $this->uuid = Uuid::uuid4();
        $this->setCreatedAt(new DateTimeImmutable());
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeImmutable
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeImmutable $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getGender(): ?bool
    {
        return $this->gender;
    }

    public function setGender(bool $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getFirstMark(): ?int
    {
        return $this->firstMark;
    }

    public function setFirstMark(?int $firstMark): self
    {
        $this->firstMark = $firstMark;

        return $this;
    }

    public function getSecondMark(): ?int
    {
        return $this->secondMark;
    }

    public function setSecondMark(?int $secondMark): self
    {
        $this->secondMark = $secondMark;

        return $this;
    }

    public function getClassroom(): ?Classroom
    {
        return $this->classroom;
    }

    public function setClassroom(?Classroom $classroom): self
    {
        $this->classroom = $classroom;

        return $this;
    }

    public function getAverage(): ?string
    {
        return $this->average;
    }

    public function setAverage(?string $average): self
    {
        $this->average = $average;

        return $this;
    }
}
