<?php namespace Trademe\Entities;

/**
 * Hourly rate range value object
 */
class HourlyRateRange extends Range
{

    /**
     * @param $min
     * @param $max
     * @throws InvalidArgumentException
     */
    public function __construct($min, $max)
    {
        if ($max - $min > 400) {
            throw new InvalidArgumentException(
                'Max hourly rate range cannot exceed minimum amount by more than 400'
            );
        }

        parent::__construct($min, $max);
    }
}
