<?php

namespace Anaf\Requests\Efactura;

use Anaf\Enums\Efactura\UploadStandard;
use InvalidArgumentException;

class UploadRequest
{
    /**
     * @param  array<string, string>  $parameters
     */
    public function __construct(
        private readonly string $xml_path,
        private readonly array $parameters,
    ) {
        // ..
    }

    /**
     * Creates a new UploadParameters value object with the xml_path parameter
     */
    public static function withXmlPath(string $xml_path): self
    {
        return new self(xml_path: $xml_path, parameters: []);
    }

    /**
     * Creates a new UploadParameters value object with the tax_identification_number parameter
     */
    public function withTaxIdentificationNumber(string|int $tax_identification_number): self
    {
        return new self(
            xml_path: $this->xml_path,
            parameters: [
                ...$this->parameters,
                'cif' => (string) $tax_identification_number,
            ],
        );
    }

    /**
     * Creates a new UploadParameters value object with the standard parameter
     */
    public function withStandard(UploadStandard $standard): self
    {
        return new self(
            xml_path: $this->xml_path,
            parameters: [
                ...$this->parameters,
                'standard' => $standard->value,
            ],
        );
    }

    /**
     * Creates a new UploadParameters value object with the extern parameter
     */
    public function extern(): self
    {
        return new self(
            xml_path: $this->xml_path,
            parameters: [
                ...$this->parameters,
                'extern' => 'DA',
            ],
        );
    }

    /**
     * Creates a new UploadParameters value object with the selfInvoice parameter
     */
    public function selfInvoice(): self
    {
        return new self(
            xml_path: $this->xml_path,
            parameters: [
                ...$this->parameters,
                'autofactura' => 'DA',
            ],
        );
    }

    /**
     * @return array<string, string> $parameters
     */
    public function toArray(): array
    {
        $requiredKeys = ['cif', 'standard'];

        $missingKeys = array_diff($requiredKeys, array_keys($this->parameters));

        if ($missingKeys !== []) {
            throw new InvalidArgumentException('Missing required parameters: '.implode(', ', $missingKeys));
        }

        return $this->parameters;
    }

    /**
     * Xml path getter
     */
    public function getXmlPath(): string
    {
        if ($this->xml_path === '' || $this->xml_path === '0') {
            throw new InvalidArgumentException('Xml path is required');
        }

        return $this->xml_path;
    }
}
