<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     * @Gedmo\Slug(fields={"name"})
     */
    private $slug;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $publishedAt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $secsite;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $groupsite;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $statistics;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageFilename;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;



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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(?\DateTimeInterface $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    public function getSecsite(): ?string
    {
        return $this->secsite;
    }

    public function setSecsite(?string $secsite): self
    {
        $this->secsite = $secsite;

        return $this;
    }

    public function getGroupsite(): ?string
    {
        return $this->groupsite;
    }

    public function setGroupsite(?string $groupsite): self
    {
        $this->groupsite = $groupsite;

        return $this;
    }

    public function getStatistics(): ?string
    {
        return $this->statistics;
    }

    public function setStatistics(?string $statistics): self
    {
        $this->statistics = $statistics;

        return $this;
    }

    public function getImageFilename(): ?string
    {
        return $this->imageFilename;
    }

    public function setImageFilename(?string $imageFilename): self
    {
        $this->imageFilename = $imageFilename;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    //delete this
    public function feed($food)
    {
        $foodItems = [];
        foreach ($food as $foodItem) {
            $foodItems[] = $foodItem;
        }
        if (count($foodItems) === 0) {
            return sprintf('%s is looking at you in a funny way', $this->getName());
        }
        return sprintf('%s recently ate: %s', $this->getName(), implode(', ', $foodItems));
    }

    public function __toString()
    {
        return (string) $this->getName();
    }

}
