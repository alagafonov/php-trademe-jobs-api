<?php namespace Trademe\ValueObjects;

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
        if ($max - $min > 25) {
            throw new InvalidArgumentException(
                'Max hourly rate range cannot exceed minimum amount by more than 25'
            );
        }

        parent::__construct($min, $max);
    }

    /**
     * @return array
     */
    public function getArray()
    {
        return [
        ];
    }
}
