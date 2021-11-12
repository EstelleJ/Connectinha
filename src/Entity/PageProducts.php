<?php

namespace App\Entity;

use App\Repository\PageProductsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PageProductsRepository::class)
 */
class PageProducts
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
    private $banner_first_img;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $banner_second_img;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $made_in_france_img;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $parfume_img;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $about_creations_img;

    /**
     * @ORM\OneToMany(targetEntity=PageProductsSlider::class, mappedBy="pageProducts")
     */
    private $slider;

    public function __construct()
    {
        $this->slider = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBannerFirstImg(): ?string
    {
        return $this->banner_first_img;
    }

    public function setBannerFirstImg(string $banner_first_img): self
    {
        $this->banner_first_img = $banner_first_img;

        return $this;
    }

    public function getBannerSecondImg(): ?string
    {
        return $this->banner_second_img;
    }

    public function setBannerSecondImg(string $banner_second_img): self
    {
        $this->banner_second_img = $banner_second_img;

        return $this;
    }

    public function getMadeInFranceImg(): ?string
    {
        return $this->made_in_france_img;
    }

    public function setMadeInFranceImg(string $made_in_france_img): self
    {
        $this->made_in_france_img = $made_in_france_img;

        return $this;
    }

    public function getParfumeImg(): ?string
    {
        return $this->parfume_img;
    }

    public function setParfumeImg(string $parfume_img): self
    {
        $this->parfume_img = $parfume_img;

        return $this;
    }

    public function getAboutCreationsImg(): ?string
    {
        return $this->about_creations_img;
    }

    public function setAboutCreationsImg(string $about_creations_img): self
    {
        $this->about_creations_img = $about_creations_img;

        return $this;
    }

    /**
     * @return Collection|PageProductsSlider[]
     */
    public function getSlider(): Collection
    {
        return $this->slider;
    }

    public function addSlider(PageProductsSlider $slider): self
    {
        if (!$this->slider->contains($slider)) {
            $this->slider[] = $slider;
            $slider->setPageProducts($this);
        }

        return $this;
    }

    public function removeSlider(PageProductsSlider $slider): self
    {
        if ($this->slider->removeElement($slider)) {
            // set the owning side to null (unless already changed)
            if ($slider->getPageProducts() === $this) {
                $slider->setPageProducts(null);
            }
        }

        return $this;
    }


}
