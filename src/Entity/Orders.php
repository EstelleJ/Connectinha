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

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $delivery_message;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $delivery_delay;

    /**
     * @ORM\Column(type="string", length=72, nullable=true)
     */
    private $delivery_hamlet;

    /**
     * @ORM\Column(type="string", length=72, nullable=true)
     */
    private $invoicing_hamlet;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $delivery_phone_number;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $invoicing_phone_number;

    /**
     * @ORM\Column(type="string", length=72, nullable=true)
     */
    private $delivery_building;

    /**
     * @ORM\Column(type="string", length=72, nullable=true)
     */
    private $invoicing_building;

    /**
     * @ORM\Column(type="string", length=72, nullable=true)
     */
    private $delivery_apartment;

    /**
     * @ORM\Column(type="string", length=72, nullable=true)
     */
    private $invoicing_apartment;

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

    public function getDeliveryMessage(): ?string
    {
        return $this->delivery_message;
    }

    public function setDeliveryMessage(string $delivery_message): self
    {
        $this->delivery_message = $delivery_message;

        return $this;
    }

    public function getDeliveryDelay(): ?int
    {
        return $this->delivery_delay;
    }

    public function setDeliveryDelay(?int $delivery_delay): self
    {
        $this->delivery_delay = $delivery_delay;

        return $this;
    }

    public function getDeliveryHamlet(): ?string
    {
        return $this->delivery_hamlet;
    }

    public function setDeliveryHamlet(string $delivery_hamlet): self
    {
        $this->delivery_hamlet = $delivery_hamlet;

        return $this;
    }

    public function getInvoicingHamlet(): ?string
    {
        return $this->invoicing_hamlet;
    }

    public function setInvoicingHamlet(?string $invoicing_hamlet): self
    {
        $this->invoicing_hamlet = $invoicing_hamlet;

        return $this;
    }

    public function getDeliveryPhoneNumber(): ?string
    {
        return $this->delivery_phone_number;
    }

    public function setDeliveryPhoneNumber(string $delivery_phone_number): self
    {
        $this->delivery_phone_number = $delivery_phone_number;

        return $this;
    }

    public function getInvoicingPhoneNumber(): ?string
    {
        return $this->invoicing_phone_number;
    }

    public function setInvoicingPhoneNumber(string $invoicing_phone_number): self
    {
        $this->invoicing_phone_number = $invoicing_phone_number;

        return $this;
    }

    public function getDeliveryBuilding(): ?string
    {
        return $this->delivery_building;
    }

    public function setDeliveryBuilding(?string $delivery_building): self
    {
        $this->delivery_building = $delivery_building;

        return $this;
    }

    public function getInvoicingBuilding(): ?string
    {
        return $this->invoicing_building;
    }

    public function setInvoicingBuilding(?string $invoicing_building): self
    {
        $this->invoicing_building = $invoicing_building;

        return $this;
    }

    public function getDeliveryApartment(): ?string
    {
        return $this->delivery_apartment;
    }

    public function setDeliveryApartment(?string $delivery_apartment): self
    {
        $this->delivery_apartment = $delivery_apartment;

        return $this;
    }

    public function getInvoicingApartment(): ?string
    {
        return $this->invoicing_apartment;
    }

    public function setInvoicingApartment(?string $invoicing_apartment): self
    {
        $this->invoicing_apartment = $invoicing_apartment;

        return $this;
    }
}
