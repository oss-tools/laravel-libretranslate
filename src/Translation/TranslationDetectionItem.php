<?php

namespace OSSTools\LibreTranslate\Translation;

class TranslationDetectionItem
{
    /**
     * @var int
     */
    protected $confidence;

    /**
     * @var string
     */
    protected $language;

    public function __construct(int $confidence, string $language)
    {
        $this->confidence = $confidence;
        $this->language = $language;
    }

    /**
     * @return int
     */
    public function getConfidence(): int
    {
        return $this->confidence;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'confidence' => $this->confidence,
            'language' => $this->language,
        ];
    }
}
