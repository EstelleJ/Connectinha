<?php

namespace App\Entity;

use App\Repository\OrdersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrdersRepository::class)
 */
class Orders
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $orderNumber;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="orders")
     */
    private $user;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $send;

    /**
     * @ORM\ManyToOne(targetEntity=PaymentMethod::class, inversedBy="orders")
     */
    private $payment_method;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2)
     */
    private $price;

    /**
     * @ORM\Column(type="text")
     */
    private $delivery_adress;

    /**
     * @ORM\Column(type="string", length=8)
     */
    private $zipcode;

    /**
     * @ORM\Column(type="text")
     */
    private $invoicing_adress;

    /**
     * @ORM\Column(type="string", length=8)
     */
    private $invoicing_zipcode;

    /**
     * @ORM\Column(type="string", length=72)
     */
    private $delivery_city;

    /**
     * @ORM\Column(type="string", length=72)
     */
    private $invoicing_city;

    /**
     * @ORM\Column(type="string", length=36)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=36)
     */
    private $invoicing_country;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderNumber(): ?string
    {
        return $this->orderNumber;
    }

    public function setOrderNumber(string $orderNumber): self
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    public function getUser(): ?Customer
    {
        return $this->user;
    }

    public function setUser(?Customer $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getSend(): ?string
    {
        return $this->send;
    }

    public function setSend(string $send): self
    {
        $this->send = $send;

        return $this;
    }

    public function getPaymentMethod(): ?PaymentMethod
    {
        return $this->payment_method;
    }

    public function setPaymentMethod(?PaymentMethod $payment_method): self
    {
        $this->payment_method = $payment_method;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDeliveryAdress(): ?string
    {
        return $this->delivery_adress;
    }

    public function setDeliveryAdress(string $delivery_adress): self
    {
        $this->delivery_adress = $delivery_adress;

        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getInvoicingAdress(): ?string
    {
        return $this->invoicing_adress;
    }

    public function setInvoicingAdress(string $invoicing_adress): self
    {
        $this->invoicing_adress = $invoicing_adress;

        return $this;
    }

    public function getInvoicingZipcode(): ?string
    {
        return $this->invoicing_zipcode;
    }

    public function setInvoicingZipcode(string $invoicing_zipcode): self
    {
        $this->invoicing_zipcode = $invoicing_zipcode;

        return $this;
    }

    public function getDeliveryCity(): ?string
    {
        return $this->delivery_city;
    }

    public function setDeliveryCity(string $delivery_city): self
    {
        $this->delivery_city = $delivery_city;

        return $this;
    }

    public function getInvoicingCity(): ?string
    {
        return $this->invoicing_city;
    }

    public function setInvoicingCity(string $invoicing_city): self
    {
        $this->invoicing_city = $invoicing_city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getInvoicingCountry(): ?string
    {
        return $this->invoicing_country;
    }

    public function setInvoicingCountry(string $invoicing_country): self
    {
        $this->invoicing_country = $invoicing_country;

        return $this;
    }
}
