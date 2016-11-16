<?php namespace Trademe\ValueObjects;

/**
 * Phone value object
 */
final class Phone implements ValueObjectInterface
{
    /**
     * @var string
     */
    protected $prefix;

    /**
     * @var string
     */
    protected $phone;

    /**
     * @var array
     */
    private $prefixes = [
        '03'   => [6, 11],
        '04'   => [6, 11],
        '06'   => [6, 11],
        '07'   => [6, 11],
        '09'   => [6, 11],
        '020'  => [6, 8],
        '021'  => [6, 8],
        '022'  => [6, 8],
        '027'  => [6, 8],
        '028'  => [6, 8],
        '029'  => [6, 8],
        '0800' => [5, 7],
        '61'   => [7, 11],
    ];

    /**
     * @param $prefix
     * @param $phone
     * @throws InvalidArgumentException
     */
    public function __construct($prefix, $phone)
    {
        if (!is_string($prefix)) {
            throw new InvalidArgumentException(
                'Phone prefix must be a string'
            );
        }

        if (!is_string($phone)) {
            throw new InvalidArgumentException(
                'Phone number must be a string'
            );
        }

        if (!isset($this->prefixes[$prefix])) {
            throw new InvalidArgumentException(
                'Phone prefix "' . $prefix . '" is invalid. Must be one of the following: ' .
                implode(',' . array_keys($this->prefixes))
            );
        }

        if (!preg_match('/[0-9]+/', $phone)) {
            throw new InvalidArgumentException(
                'Phone number must only contain numbers'
            );
        }

        $phoneLength = strlen($phone);
        if ($phoneLength < $this->prefixes[$prefix][0] || $phoneLength > $this->prefixes[$prefix][1]) {
            throw new InvalidArgumentException(
                'Phone number must be between "' . $this->prefixes[$prefix][0] . '" and ' .
                $this->prefixes[$prefix][1] . ' characters long'

            );
        }
        $this->prefix = $prefix;
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
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
