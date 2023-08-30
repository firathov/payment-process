<?php

namespace Lib\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lib\Repository\CountryTaxesRepository;

#[ORM\Entity(repositoryClass: CountryTaxesRepository::class)]
#[ORM\Table('country_taxes')]
class CountryTaxes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 50)]
    private string $country;

    #[ORM\Column]
    private float $tax;

    #[ORM\Column(length: 2)]
    private string $country_code;

    public function getId(): int
    {
        return $this->id;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getTax(): float
    {
        return $this->tax;
    }

    public function setTax(float $tax): static
    {
        $this->tax = $tax;

        return $this;
    }

    public function getCountryCode(): string
    {
        return $this->country_code;
    }

    public function setCountryCode(string $country_code): static
    {
        $this->country_code = $country_code;

        return $this;
    }
}
