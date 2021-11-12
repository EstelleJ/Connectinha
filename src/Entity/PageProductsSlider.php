<?php

namespace App\Entity;

use App\Repository\PageProductsSliderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PageProductsSliderRepository::class)
 */
class PageProductsSlider
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
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=PageProducts::class, inversedBy="slider")
     */
    private $pageProducts;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getPageProducts(): ?PageProducts
    {
        return $this->pageProducts;
    }

    public function setPageProducts(?PageProducts $pageProducts): self
    {
        $this->pageProducts = $pageProducts;

        return $this;
    }
}
