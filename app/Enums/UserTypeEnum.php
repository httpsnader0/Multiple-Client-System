<?php

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self ADMINISTRATOR()
 * @method static self CUSTOMER_SERVICE()
 * @method static self USER()
 * @method static self CLIENT()
 */

final class UserTypeEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'ADMINISTRATOR' => 'Administrator',
            'CUSTOMER_SERVICE' => 'Customer Service',
            'USER' => 'User',
            'CLIENT' => 'Client',
        ];
    }
}
