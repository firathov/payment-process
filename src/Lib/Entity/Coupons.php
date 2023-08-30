<?php

namespace Lib\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lib\Enum\CouponsTypeEnum;
use Lib\Repository\CouponsRepository;

#[ORM\Entity(repositoryClass: CouponsRepository::class)]
#[ORM\Table('coupons')]
class Coupons
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 5)]
    private string $couponCode;

    #[ORM\Column(type: 'enum', enumType: CouponsTypeEnum::class)]
    private CouponsTypeEnum $type;

    #[ORM\Column]
    private float $discount;

    public function getId(): int
    {
        return $this->id;
    }

    public function getCouponCode(): string
    {
        return $this->couponCode;
    }

    public function setName(string $couponCode): static
    {
        $this->couponCode = $couponCode;

        return $this;
    }

    /**
     * @return CouponsTypeEnum
     */
    public function getType(): CouponsTypeEnum
    {
        return $this->type;
    }

    /**
     * @param CouponsTypeEnum $type
     */
    public function setType(CouponsTypeEnum $type): void
    {
        $this->type = $type;
    }

    public function getDiscount(): float
    {
        return $this->discount;
    }

    public function setDiscount(float $discount): static
    {
        $this->discount = $discount;

        return $this;
    }
}
