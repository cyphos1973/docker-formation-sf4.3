<?php

namespace App\Entity;

use \Exception;
use App\Entity\Traits\EntityIdTrait;
use App\Entity\Traits\EntityTimeTrait;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @todo    Write assertions with Validator components
 * @author  Gaëtan Rolé-Dubruille <gaetan.role-dubruille@sensiolabs.com>
 * @ORM\Entity(repositoryClass="App\Repository\ClassroomRepository")
 */
class Classroom
{
    use EntityIdTrait;
    use EntityTimeTrait;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $name;

    /**
     * @ORM\Column(type="smallint")
     */
    private $grade = 0;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Student", mappedBy="classroom")
     */
    private $students;

    /** @throws Exception */
    public function __construct()
    {
        $this->uuid = Uuid::uuid4();
        $this->setCreatedAt(new DateTimeImmutable());
        $this->students = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->grade . ' : ' . $this->name;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getGrade(): ?int
    {
        return $this->grade;
    }

    public function setGrade(int $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * @return Collection|Student[]
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudent(Student $student): self
    {
        if (!$this->students->contains($student)) {
            $this->students[] = $student;
            $student->setClassroom($this);
        }

        return $this;
    }

    public function removeStudent(Student $student): self
    {
        if ($this->students->contains($student)) {
            $this->students->removeElement($student);
            // set the owning side to null (unless already changed)
            if ($student->getClassroom() === $this) {
                $student->setClassroom(null);
            }
        }

        return $this;
    }
}
