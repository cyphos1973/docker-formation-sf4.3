<?php

namespace App\Entity\Traits;

use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * A trait for createdAt and updatedAt properties in every entities.
 * You can also use mappedsuperclass but not recommended.
 *
 * @author  Gaëtan Rolé-Dubruille <gaetan.role-dubruille@sensiolabs.com>
 * @link    https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/inheritance-mapping.html
 * @link    https://stackoverflow.com/questions/25749418/symfony2-mappedsuperclass-and-doctrinegenerateentities
 */
trait EntityTimeTrait
{
    /**
     * @var DateTimeImmutable
     *
     * @ORM\Column(type="datetime_immutable")
     */
    protected $createdAt;

    /**
     * @var DateTimeImmutable|null
     *
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    protected $updatedAt;

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): void
    {
        $this->createdAt
            = $createdAt instanceof DateTime ? DateTimeImmutable::createFromMutable($createdAt) : $createdAt;
    }

    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTimeInterface $updatedAt): void
    {
        $this->updatedAt
            = $updatedAt instanceof DateTime ? DateTimeImmutable::createFromMutable($updatedAt) : $updatedAt;
    }
}
