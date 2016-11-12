<?php namespace Trademe\Enums;

use MabeEnum\Enum;

/**
 * Pay type enum
 */
class PayType extends Enum
{
    /**
     * Salary payment type
     */
    const SALARY = 'Salary';

    /**
     * Online via advertiser’s website
     */
    const HOURLY = 'Hourly';
}
