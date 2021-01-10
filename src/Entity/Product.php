<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isTool;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isEquipment;

    /**
     * @ORM\ManyToOne(targetEntity=Measure::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $measure;

    /**
     * @ORM\ManyToOne(targetEntity=ProductClass::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $parentClass;

    /**
     * @ORM\OneToMany(targetEntity=CharacteristicValue::class, mappedBy="product", orphanRemoval=true)
     */
    private $characteristicsValues;

    /**
     * @ORM\OneToMany(targetEntity=ComponentGroup::class, mappedBy="product", orphanRemoval=true)
     */
    private $componentGroups;

    /**
     * @ORM\OneToOne(targetEntity=Process::class, inversedBy="product", cascade={"persist", "remove"})
     */
    private $process;

    public function __construct()
    {
        $this->characteristicsValues = new ArrayCollection();
        $this->componentGroups = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIsTool(): ?bool
    {
        return $this->isTool;
    }

    public function setIsTool(bool $isTool): self
    {
        $this->isTool = $isTool;

        return $this;
    }

    public function getIsEquipment(): ?bool
    {
        return $this->isEquipment;
    }

    public function setIsEquipment(bool $isEquipment): self
    {
        $this->isEquipment = $isEquipment;

        return $this;
    }

    public function getMeasure(): ?Measure
    {
        return $this->measure;
    }

    public function setMeasure(?Measure $measure): self
    {
        $this->measure = $measure;

        return $this;
    }

    public function getParentClass(): ?ProductClass
    {
        return $this->parentClass;
    }

    public function setParentClass(?ProductClass $parentClass): self
    {
        $this->parentClass = $parentClass;

        return $this;
    }

    /**
     * @return Collection|CharacteristicValue[]
     */
    public function getCharacteristicsValues(): Collection
    {
        return $this->characteristicsValues;
    }

    public function addCharacteristicsValue(CharacteristicValue $characteristicsValue): self
    {
        if (!$this->characteristicsValues->contains($characteristicsValue)) {
            $this->characteristicsValues[] = $characteristicsValue;
            $characteristicsValue->setProduct($this);
        }

        return $this;
    }

    public function removeCharacteristicsValue(CharacteristicValue $characteristicsValue): self
    {
        if ($this->characteristicsValues->removeElement($characteristicsValue)) {
            // set the owning side to null (unless already changed)
            if ($characteristicsValue->getProduct() === $this) {
                $characteristicsValue->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ComponentGroup[]
     */
    public function getComponentGroups(): Collection
    {
        return $this->componentGroups;
    }

    public function addComponentGroup(ComponentGroup $componentGroup): self
    {
        if (!$this->componentGroups->contains($componentGroup)) {
            $this->componentGroups[] = $componentGroup;
            $componentGroup->setProduct($this);
        }

        return $this;
    }

    public function removeComponentGroup(ComponentGroup $componentGroup): self
    {
        if ($this->componentGroups->removeElement($componentGroup)) {
            // set the owning side to null (unless already changed)
            if ($componentGroup->getProduct() === $this) {
                $componentGroup->setProduct(null);
            }
        }

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
}
