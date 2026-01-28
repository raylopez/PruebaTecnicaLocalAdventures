<?php

namespace App\Enums;

enum InvoiceStatus: int
{
    case Draft = 0;
    case Completed = 1;
    case Cancelled = 2;
}
