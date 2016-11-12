<?php namespace Trademe\Enums;

use MabeEnum\Enum;

/**
 * Preferred application mode enum
 */
class PreferredApplicationMode extends Enum
{
    /**
     * Online via email
     */
    const EMAIL = 'E';

    /**
     * Online via advertiser’s website
     */
    const WEBSITE = 'O';

    /**
     * No online application, phone only
     */
    const PHONE = 'N';
}
