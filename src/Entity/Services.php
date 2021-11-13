<?php

namespace App\Entity;

use App\Repository\ServicesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

/**
 * @ORM\Entity(repositoryClass=ServicesRepository::class)
 */
class Services {

	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $title;

	/**
	 * @ORM\Column(type="text", nullable=true)
	 */
	private $text;

	/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	private $price;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $slug;

	/**
	 * @ORM\ManyToOne(targetEntity=Duration::class, inversedBy="services")
	 */
	private $duration;

	/**
	 * @ORM\OneToMany(targetEntity=Rendezvous::class, mappedBy="service", cascade={"persist", "remove"})
	 */
	private $rendezvouses;

	/**
	 * @ORM\ManyToOne(targetEntity=Distance::class, inversedBy="services", fetch="EAGER")
	 */
	private $distance;

	/**
	 * @ORM\ManyToMany(targetEntity=PaymentMethod::class, inversedBy="services")
	 */
	private $payment_method;

	/**
	 * @ORM\Column(type="boolean")
	 */
	private $active;

	/**
	 * @ORM\ManyToOne(targetEntity=Tva::class, inversedBy="prestations")
	 */
	private $tva;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $image;

	/**
	 * @ORM\Column(type="datetime")
	 */
	private $updatedAt;

	/**
	 * @ORM\OneToMany(targetEntity=ServicesContent::class, mappedBy="services", fetch="EAGER")
	 */
	private $content;

	public function __construct() {
		$this->rendezvouses = new ArrayCollection();
		$this->payment_method = new ArrayCollection();
		$this->content = new ArrayCollection();
	}

	#[Pure] public function __toString(): string {
		return $this->getTitle();
	}


	public function getId(): ?int {
		return $this->id;
	}

	public function getTitle(): ?string {
		return $this->title;
	}

	public function setTitle(string $title): self {
		$this->title = $title;

		return $this;
	}

	public function getText(): ?string {
		return $this->text;
	}

	public function setText(?string $text): self {
		$this->text = $text;

		return $this;
	}

	public function getPrice(): ?int {
		return $this->price;
	}

	public function setPrice(?int $price): self {
		$this->price = $price;

		return $this;
	}

	public function getSlug(): ?string {
		return $this->slug;
	}

	public function setSlug(string $slug): self {
		$this->slug = $slug;

		return $this;
	}

	public function getDuration(): ?Duration {
		return $this->duration;
	}

	public function setDuration(?Duration $duration): self {
		$this->duration = $duration;

		return $this;
	}

	/**
	 * @return Collection|Rendezvous[]
	 */
	public function getRendezvouses(): Collection {
		return $this->rendezvouses;
	}

	public function addRendezvouse(Rendezvous $rendezvouse): self {
		if (!$this->rendezvouses->contains($rendezvouse)) {
			$this->rendezvouses[] = $rendezvouse;
			$rendezvouse->setPrestation($this);
		}

		return $this;
	}

	public function removeRendezvouse(Rendezvous $rendezvouse): self {
		if ($this->rendezvouses->removeElement($rendezvouse)) {
			// set the owning side to null (unless already changed)
			if ($rendezvouse->getPrestation() === $this) {
				$rendezvouse->setPrestation(null);
			}
		}

		return $this;
	}

	public function getDistance(): ?Distance {
		return $this->distance;
	}

	public function setDistance(?Distance $distance): self {
		$this->distance = $distance;

		return $this;
	}

	/**
	 * @return Collection|PaymentMethod[]
	 */
	public function getPaymentMethod(): Collection {
		return $this->payment_method;
	}

	public function addPaymentMethod(PaymentMethod $paymentMethod): self {
		if (!$this->payment_method->contains($paymentMethod)) {
			$this->payment_method[] = $paymentMethod;
		}

		return $this;
	}

	public function removePaymentMethod(PaymentMethod $paymentMethod): self {
		$this->payment_method->removeElement($paymentMethod);

		return $this;
	}

	public function getActive(): ?bool {
		return $this->active;
	}

	public function setActive(bool $active): self {
		$this->active = $active;

		return $this;
	}

	public function getTva(): ?Tva {
		return $this->tva;
	}

	public function setTva(?Tva $tva): self {
		$this->tva = $tva;

		return $this;
	}

	public function getImage(): ?string {
		return $this->image;
	}

	public function setImage(string $image): self {
		$this->image = $image;

		return $this;
	}

	public function getUpdatedAt(): ?\DateTime {
		return $this->updatedAt;
	}

	public function setUpdatedAt(\DateTime $updatedAt): self {
		$this->updatedAt = $updatedAt;

		return $this;
	}

	/**
	 * @return Collection|ServicesContent[]
	 */
	public function getContent(): Collection {
		return $this->content;
	}

	public function addContent(ServicesContent $content): self {
		if (!$this->content->contains($content)) {
			$this->content[] = $content;
			$content->setServices($this);
		}

		return $this;
	}

	public function removeContent(ServicesContent $content): self {
		if ($this->content->removeElement($content)) {
			// set the owning side to null (unless already changed)
			if ($content->getServices() === $this) {
				$content->setServices(null);
			}
		}

		return $this;
	}
}
