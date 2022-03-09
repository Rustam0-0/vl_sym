<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_billing;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_pay;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_send;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_receive;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ship_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ship_surname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ship_address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ship_city;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $ship_zipcode;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="orders")
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=Country::class, inversedBy="orders")
     */
    private $country;

    /**
     * @ORM\OneToMany(targetEntity=OrderDetail::class, mappedBy="orders")
     */
    private $orderDetails;

    public function __construct()
    {
        $this->orderDetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDateBilling(): ?\DateTimeInterface
    {
        return $this->date_billing;
    }

    public function setDateBilling(?\DateTimeInterface $date_billing): self
    {
        $this->date_billing = $date_billing;

        return $this;
    }

    public function getDatePay(): ?\DateTimeInterface
    {
        return $this->date_pay;
    }

    public function setDatePay(?\DateTimeInterface $date_pay): self
    {
        $this->date_pay = $date_pay;

        return $this;
    }

    public function getDateSend(): ?\DateTimeInterface
    {
        return $this->date_send;
    }

    public function setDateSend(?\DateTimeInterface $date_send): self
    {
        $this->date_send = $date_send;

        return $this;
    }

    public function getDateReceive(): ?\DateTimeInterface
    {
        return $this->date_receive;
    }

    public function setDateReceive(?\DateTimeInterface $date_receive): self
    {
        $this->date_receive = $date_receive;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getShipName(): ?string
    {
        return $this->ship_name;
    }

    public function setShipName(string $ship_name): self
    {
        $this->ship_name = $ship_name;

        return $this;
    }

    public function getShipSurname(): ?string
    {
        return $this->ship_surname;
    }

    public function setShipSurname(string $ship_surname): self
    {
        $this->ship_surname = $ship_surname;

        return $this;
    }

    public function getShipAddress(): ?string
    {
        return $this->ship_address;
    }

    public function setShipAddress(string $ship_address): self
    {
        $this->ship_address = $ship_address;

        return $this;
    }

    public function getShipCity(): ?string
    {
        return $this->ship_city;
    }

    public function setShipCity(string $ship_city): self
    {
        $this->ship_city = $ship_city;

        return $this;
    }

    public function getShipZipcode(): ?string
    {
        return $this->ship_zipcode;
    }

    public function setShipZipcode(string $ship_zipcode): self
    {
        $this->ship_zipcode = $ship_zipcode;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection<int, OrderDetail>
     */
    public function getOrderDetails(): Collection
    {
        return $this->orderDetails;
    }

    public function addOrderDetail(OrderDetail $orderDetail): self
    {
        if (!$this->orderDetails->contains($orderDetail)) {
            $this->orderDetails[] = $orderDetail;
            $orderDetail->setOrders($this);
        }

        return $this;
    }

    public function removeOrderDetail(OrderDetail $orderDetail): self
    {
        if ($this->orderDetails->removeElement($orderDetail)) {
            // set the owning side to null (unless already changed)
            if ($orderDetail->getOrders() === $this) {
                $orderDetail->setOrders(null);
            }
        }

        return $this;
    }
}
