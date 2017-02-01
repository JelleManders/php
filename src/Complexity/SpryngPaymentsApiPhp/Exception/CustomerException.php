<?php

namespace SpryngPaymentsApiPhp\Exception;

use SpryngPaymentsApiPhp\SpryngPaymentsException;

class CustomerException extends SpryngPaymentsException
{
    const CUSTOMER_NOT_FOUND        = 501;
}