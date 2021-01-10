<?php

namespace App\Entity;

use App\Repository\ComponentGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ComponentGroupRepository::class)
 */
class ComponentGroup
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
    private $type;

    /**
     * @ORM\Column(type="boolean")
     */
    private $required;

    /**
     * @ORM\ManyToOne(targetEntity=ComponentGroup::class, inversedBy="subGroups")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity=ComponentGroup::class, mappedBy="parent")
     */
    private $subGroups;

    /**
     * @ORM\OneToMany(targetEntity=Component::class, mappedBy="componentGroup", orphanRemoval=true)
     */
    private $components;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="componentGroups")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    public function __construct()
    {
        $this->subGroups = new ArrayCollection();
        $this->components = new ArrayCollection();
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

    public function getType(): ?bool
    {
        return $this->type;
    }

    public function setType(bool $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getRequired(): ?bool
    {
        return $this->required;
    }

    public function setRequired(bool $required): self
    {
        $this->required = $required;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getSubGroups(): Collection
    {
        return $this->subGroups;
    }

    public function addSubGroup(self $subGroup): self
    {
        if (!$this->subGroups->contains($subGroup)) {
            $this->subGroups[] = $subGroup;
            $subGroup->setParent($this);
        }

        return $this;
    }

    public function removeSubGroup(self $subGroup): self
    {
        if ($this->subGroups->removeElement($subGroup)) {
            // set the owning side to null (unless already changed)
            if ($subGroup->getParent() === $this) {
                $subGroup->setParent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Component[]
     */
    public function getComponents(): Collection
    {
        return $this->components;
    }

    public function addComponent(Component $component): self
    {
        if (!$this->components->contains($component)) {
            $this->components[] = $component;
            $component->setComponentGroup($this);
        }

        return $this;
    }

    public function removeComponent(Component $component): self
    {
        if ($this->components->removeElement($component)) {
            // set the owning side to null (unless already changed)
            if ($component->getComponentGroup() === $this) {
                $component->setComponentGroup(null);
            }
        }

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }
}
