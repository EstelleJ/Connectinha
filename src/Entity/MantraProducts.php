<?php

namespace App\Entity;

use App\Repository\MantraProductsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

/**
 * @ORM\Entity(repositoryClass=MantraProductsRepository::class)
 */
class MantraProducts {

	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $mantra;

	/**
	 * @ORM\ManyToMany(targetEntity=Product::class, mappedBy="mantraProducts")
	 */
	private $product;

	public function __construct() {
		$this->product = new ArrayCollection();
	}

	#[Pure] public function __toString(): string {
		return $this->getMantra();
	}


	public function getId(): ?int {
		return $this->id;
	}

	public function getMantra(): ?string {
		return $this->mantra;
	}

	public function setMantra(string $mantra): self {
		$this->mantra = $mantra;

		return $this;
	}

	/**
	 * @return Collection|Product[]
	 */
	public function getProduct(): Collection {
		return $this->product;
	}

	public function addProduct(Product $product): self {
		if (!$this->product->contains($product)) {
			$this->product[] = $product;
		}

		return $this;
	}

	public function removeProduct(Product $product): self {
		$this->product->removeElement($product);

		return $this;
	}
}
