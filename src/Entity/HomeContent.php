<?php

namespace App\Entity;

use App\Repository\HomeContentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HomeContentRepository::class)
 */
class HomeContent
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
    private $presentation_title;

    /**
     * @ORM\Column(type="text")
     */
    private $presentation_text_1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $presentation_subtitle;

    /**
     * @ORM\Column(type="text")
     */
    private $presentation_text_2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $questions_title;

    /**
     * @ORM\Column(type="text")
     */
    private $questions_text;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $facebook;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $youtube;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $instagram;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPresentationTitle(): ?string
    {
        return $this->presentation_title;
    }

    public function setPresentationTitle(string $presentation_title): self
    {
        $this->presentation_title = $presentation_title;

        return $this;
    }

    public function getPresentationText1(): ?string
    {
        return $this->presentation_text_1;
    }

    public function setPresentationText1(string $presentation_text_1): self
    {
        $this->presentation_text_1 = $presentation_text_1;

        return $this;
    }

    public function getPresentationSubtitle(): ?string
    {
        return $this->presentation_subtitle;
    }

    public function setPresentationSubtitle(string $presentation_subtitle): self
    {
        $this->presentation_subtitle = $presentation_subtitle;

        return $this;
    }

    public function getPresentationText2(): ?string
    {
        return $this->presentation_text_2;
    }

    public function setPresentationText2(string $presentation_text_2): self
    {
        $this->presentation_text_2 = $presentation_text_2;

        return $this;
    }

    public function getQuestionsTitle(): ?string
    {
        return $this->questions_title;
    }

    public function setQuestionsTitle(string $questions_title): self
    {
        $this->questions_title = $questions_title;

        return $this;
    }

    public function getQuestionsText(): ?string
    {
        return $this->questions_text;
    }

    public function setQuestionsText(string $questions_text): self
    {
        $this->questions_text = $questions_text;

        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): self
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getYoutube(): ?string
    {
        return $this->youtube;
    }

    public function setYoutube(?string $youtube): self
    {
        $this->youtube = $youtube;

        return $this;
    }

    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    public function setInstagram(?string $instagram): self
    {
        $this->instagram = $instagram;

        return $this;
    }
}
