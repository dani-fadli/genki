<?php

namespace App\Enums;

enum RolesEnum: string
{
    case SUPERADMIN = 'superadmin';
    case PHARMACIST = 'pharmacist';
    case CUSTOMER = 'customer';
}
