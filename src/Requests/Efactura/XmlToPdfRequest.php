<?php

namespace Anaf\Requests\Efactura;

use Anaf\Enums\Efactura\ConvertXmlStandard;
use InvalidArgumentException;

class XmlToPdfRequest
{
    public function __construct(
        private readonly string $xml_path,
        public readonly ConvertXmlStandard $standard = ConvertXmlStandard::INVOICE,
        public readonly bool $validate = true,
    ) {
        // ..
    }

    /**
     * Creates a new UploadParameters value object with the xml_path parameter
     */
    public static function withXmlPath(string $xml_path): self
    {
        return new self(xml_path: $xml_path);
    }

    /**
     * Creates XML to PDF request with the standard parameter
     */
    public function withStandard(ConvertXmlStandard $standard): self
    {
        return new self(
            xml_path: $this->xml_path,
            standard: $standard,
            validate: $this->validate,
        );
    }

    /**
     * Creates a new UploadParameters value object with the selfInvoice parameter
     */
    public function withoutValidation(): self
    {
        return new self(
            xml_path: $this->xml_path,
            standard: $this->standard,
            validate: false,
        );
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
