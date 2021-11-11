<?php

namespace App\Entity;

use App\Repository\PaymentMethodRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

/**
 * @ORM\Entity(repositoryClass=PaymentMethodRepository::class)
 */
class PaymentMethod {

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
	 * @ORM\Column(type="text")
	 */
	private $text;

	/**
	 * @ORM\ManyToMany(targetEntity=Services::class, mappedBy="payment_method")
	 */
	private $services;

	/**
	 * @ORM\ManyToMany(targetEntity=Product::class, mappedBy="payment_method")
	 */
	private $products;

	/**
	 * @ORM\OneToMany(targetEntity=Orders::class, mappedBy="payment_method")
	 */
	private $orders;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $slug;

	#[Pure] public function __toString(): string {
		return $this->getName();
	}

	public function __construct() {
		$this->prestations = new ArrayCollection();
		$this->products = new ArrayCollection();
		$this->orders = new ArrayCollection();
	}

	public function getId(): ?int {
		return $this->id;
	}

	public function getName(): ?string {
		return $this->name;
	}

	public function setName(string $name): self {
		$this->name = $name;

		return $this;
	}

	public function getText(): ?string {
		return $this->text;
	}

	public function setText(string $text): self {
		$this->text = $text;

		return $this;
	}

	/**
	 * @return Collection|Services[]
	 */
	public function getServices(): Collection {
		return $this->services;
	}

	public function addService(Services $service): self {
		if (!$this->services->contains($service)) {
			$this->services[] = $service;
			$service->addPaymentMethod($this);
		}

		return $this;
	}

	public function removeService(Services $service): self {
		if ($this->services->removeElement($service)) {
			$service->removePaymentMethod($this);
		}

		return $this;
	}

	/**
	 * @return Collection|Product[]
	 */
	public function getProducts(): Collection {
		return $this->products;
	}

	public function addProduct(Product $product): self {
		if (!$this->products->contains($product)) {
			$this->products[] = $product;
			$product->addPaymentMethod($this);
		}

		return $this;
	}

	public function removeProduct(Product $product): self {
		if ($this->products->removeElement($product)) {
			$product->removePaymentMethod($this);
		}

		return $this;
	}

	/**
	 * @return Collection|Orders[]
	 */
	public function getOrders(): Collection {
		return $this->orders;
	}

	public function addOrder(Orders $order): self {
		if (!$this->orders->contains($order)) {
			$this->orders[] = $order;
			$order->setPaymentMethod($this);
		}

		return $this;
	}

	public function removeOrder(Orders $order): self {
		if ($this->orders->removeElement($order)) {
			// set the owning side to null (unless already changed)
			if ($order->getPaymentMethod() === $this) {
				$order->setPaymentMethod(null);
			}
		}

		return $this;
	}

	public function getSlug(): ?string {
		return $this->slug;
	}

	public function setSlug(string $slug): self {
		$this->slug = $slug;

		return $this;
	}
}
