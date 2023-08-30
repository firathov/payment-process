<?php

namespace Lib\Infrastructure\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class EnumType extends StringType
{
    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        $cases = [];
        foreach ($column['enumType']::cases() as $case) {
            $cases[] = $case->value;
        }

        return sprintf("ENUM('%s')", implode("', '", $cases));
    }
}
