<?php

namespace App\Entity;

use App\Repository\OperationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Entity(repositoryClass=OperationRepository::class)
 */
class Operation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=OperationClass::class, inversedBy="operations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $parentClass;

    /**
     * @ORM\ManyToOne(targetEntity=Process::class, inversedBy="operations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $process;

    /**
     * @ORM\OneToOne(targetEntity=Operation::class, cascade={"persist", "remove"})
     */
    private $prevOperation;

    /**
     * @ORM\ManyToMany(targetEntity=Product::class)
     * @JoinTable(name="operation_tool",
     *      joinColumns={@JoinColumn(name="tool_id", referencedColumnName="id")},
     *      )
     */
    private $tools;

    /**
     * @ORM\ManyToMany(targetEntity=Product::class)
     * @JoinTable(name="operation_equipment",
     *      joinColumns={@JoinColumn(name="equipment_id", referencedColumnName="id")},
     *      )
     */
    private $equipments;

    public function __construct()
    {
        $this->tools = new ArrayCollection();
        $this->equipments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParentClass(): ?OperationClass
    {
        return $this->parentClass;
    }

    public function setParentClass(?OperationClass $parentClass): self
    {
        $this->parentClass = $parentClass;

        return $this;
    }

    public function getProcess(): ?Process
    {
        return $this->process;
    }

    public function setProcess(?Process $process): self
    {
        $this->process = $process;

        return $this;
    }

    public function getPrevOperation(): ?self
    {
        return $this->prevOperation;
    }

    public function setPrevOperation(?self $prevOperation): self
    {
        $this->prevOperation = $prevOperation;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getTools(): Collection
    {
        return $this->tools;
    }

    public function addTool(Product $tool): self
    {
        if (!$this->tools->contains($tool)) {
            $this->tools[] = $tool;
        }

        return $this;
    }

    public function removeTool(Product $tool): self
    {
        $this->tools->removeElement($tool);

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getEquipments(): Collection
    {
        return $this->equipments;
    }

    public function addEquipment(Product $equipment): self
    {
        if (!$this->equipments->contains($equipment)) {
            $this->equipments[] = $equipment;
        }

        return $this;
    }

    public function removeEquipment(Product $equipment): self
    {
        $this->equipments->removeElement($equipment);

        return $this;
    }
}
