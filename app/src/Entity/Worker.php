<?php

namespace App\Entity;

use App\Repository\WorkerRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * @ORM\Entity(repositoryClass=WorkerRepository::class)
 */
class Worker
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, unique="true")
     */
    private $name;

    /**
     * @ORM\Column(type="datetime", name="create_date_time")
     */
    private $createDateTime;

    /**
     * @ORM\Column(type="datetime", name="update_date_time")
     */
    private $updateDateTime;

    /**
     * @OneToMany(targetEntity="Shift", mappedBy="worker", cascade={"remove"})
     */
    private $shifts;

    public function __construct()
    {
        $this->shifts = new ArrayCollection();
    }

    /**
     * Get the value of name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of createDateTime
     */
    public function getCreateDateTime(): DateTime
    {
        return $this->createDateTime;
    }

    /**
     * Set the value of createDateTime
     *
     * @return  self
     */
    public function setCreateDateTime(DateTime $createDateTime): self
    {
        $this->createDateTime = $createDateTime;

        return $this;
    }

    /**
     * Get the value of updateDateTime
     */
    public function getUpdateDateTime(): DateTime
    {
        return $this->updateDateTime;
    }

    /**
     * Set the value of updateDateTime
     *
     * @return  self
     */
    public function setUpdateDateTime(DateTime $updateDateTime): self
    {
        $this->updateDateTime = $updateDateTime;

        return $this;
    }

    /**
     * Get the value of shifts
     */
    public function getShifts(): Collection
    {
        return $this->shifts;
    }

    /**
     * Set the value of shifts
     *
     * @return  self
     */
    public function setShifts(Collection $shifts): self
    {
        $this->shifts = $shifts;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }
}
