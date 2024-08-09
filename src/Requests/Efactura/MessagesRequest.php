<?php

namespace Anaf\Requests\Efactura;

use Anaf\Enums\Efactura\MessagesFilter;
use InvalidArgumentException;

class MessagesRequest
{
    /**
     * @param  array<string, string>  $parameters
     */
    public function __construct(
        private readonly array $parameters,
    ) {
        // ..
    }

    /**
     * Creates a new Messages value object
     */
    public static function withTaxIdetificationNumber(string $taxIdentificationNumber): self
    {
        return new self(
            parameters: [
                'cif' => $taxIdentificationNumber,
            ],
        );
    }

    /**
     * Creates a new Message value object with the zile parameter
     */
    public function withDays(int $days): self
    {
        if ($days < 1 || $days > 60) {
            throw new InvalidArgumentException('Days must be between 1 and 60');
        }

        return new self(
            parameters: [
                ...$this->parameters,
                'zile' => (string) $days,
            ],
        );
    }

    /**
     * Creates a new Message value object with the filtru parameter
     */
    public function withFilter(MessagesFilter $filter): self
    {
        return new self(
            parameters: [
                ...$this->parameters,
                'filtru' => $filter->value,
            ],
        );
    }

    /**
     * @return array<string, string> $parameters
     */
    public function toArray(): array
    {
        $requiredKeys = ['zile', 'cif'];

        $missingKeys = array_diff($requiredKeys, array_keys($this->parameters));

        if ($missingKeys !== []) {
            throw new InvalidArgumentException('Missing required parameters: '.implode(', ', $missingKeys));
        }

        return $this->parameters;
    }
}
