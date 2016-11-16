<?php namespace Trademe\ValueObjects;

use Trademe\Exceptions\InvalidArgumentException;

/**
 * Salary range value object
 */
final class SalaryRange extends Range
{

    /**
     * @param $min
     * @param $max
     * @throws InvalidArgumentException
     */
    public function __construct($min, $max)
    {
        if ($max - $min > 10000) {
            throw new InvalidArgumentException(
                'Max salary range cannot exceed minimum amount by more than 10000'
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
