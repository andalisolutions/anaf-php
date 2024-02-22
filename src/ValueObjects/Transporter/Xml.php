<?php

declare(strict_types=1);

namespace Anaf\ValueObjects\Transporter;

use Anaf\Contracts\StringableContract;
use Exception;
use RuntimeException;

/**
 * @internal
 */
class Xml implements StringableContract
{
    /**
     * Creates a new Base URI value object.
     */
    private function __construct(
        private readonly string $xml_path,
    ) {
        // ..
    }

    /**
     * Creates a new Base URI value object.
     */
    public static function from(string $xml_path): self
    {
        return new self($xml_path);
    }

    /**
     * {@inheritdoc}
     *
     * @throws Exception
     */
    public function toString(): string
    {
        return $this->getCleanedContent($this->xml_path);
    }

    /**
     * @throws Exception
     */
    private function getCleanedContent(string $xml_path): string
    {
        $xml_content = file_get_contents($xml_path);

        if (! $xml_content) {
            throw new RuntimeException("Could not read file {$xml_path}");
        }

        // Regex pattern to match the xsi:schemaLocation attribute regardless of its content
        $pattern = '/\sxsi:(schemaLocation|schemalocation)="[^"]*"/';

        // Replace the matched pattern with an empty string
        return (string) preg_replace($pattern, '', $xml_content);
    }
}
