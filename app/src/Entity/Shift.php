<?php

namespace App\Entity;

use App\Repository\ShiftRepository;
use App\Entity\Worker;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * @Table(name="shift", 
 *    uniqueConstraints={
 *        @UniqueConstraint(name="worker_shift_unique", 
 *            columns={"worker_id", "shift_date_time"})
 *    })
 * @ORM\Entity(repositoryClass=ShiftRepository::class)
 */
class Shift
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ManyToOne(targetEntity="Worker", inversedBy="shifts")
     * @JoinColumn(name="worker_id", referencedColumnName="id", nullable=false)
     */
    private $worker;

    /**
     * @ORM\Column(type="string", length=50, name="shift_hours")
     */
    private $shiftHours;

    /**
     * @ORM\Column(type="datetime", name="shift_date_time")
     */
    private $shiftDateTime;

    /**
     * @ORM\Column(type="datetime", name="create_date_time")
     */
    private $createDateTime;

    /**
     * @ORM\Column(type="datetime", name="update_date_time")
     */
    private $updateDateTime;

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
    public function setCreateDateTime(DateTime $createDateTime)
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
    public function setUpdateDateTime(DateTime $updateDateTime)
    {
        $this->updateDateTime = $updateDateTime;

        return $this;
    }

    /**
     * Get the value of shiftDateTime
     */
    public function getShiftDateTime(): DateTime
    {
        return $this->shiftDateTime;
    }

    /**
     * Set the value of shiftDateTime
     *
     * @return  self
     */
    public function setShiftDateTime(DateTime $shiftDateTime)
    {
        $this->shiftDateTime = $shiftDateTime;

        return $this;
    }

    /**
     * Get the value of shiftHours
     */
    public function getShiftHours(): string
    {
        return $this->shiftHours;
    }

    /**
     * Set the value of shiftHours
     *
     * @return  self
     */
    public function setShiftHours(string $shiftHours)
    {
        $this->shiftHours = $shiftHours;

        return $this;
    }

    /**
     * Get the value of worker
     */
    public function getWorker(): Worker
    {
        return $this->worker;
    }

    /**
     * Set the value of worker
     *
     * @return  self
     */
    public function setWorker(Worker $worker): self
    {
        $this->worker = $worker;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId(): int
    {
        return $this->id;
    }
}
