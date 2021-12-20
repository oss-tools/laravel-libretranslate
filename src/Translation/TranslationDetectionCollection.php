<?php

namespace OSSTools\LibreTranslate\Translation;

class TranslationDetectionCollection
{
    /**
     * @var TranslationDetectionItem[]
     */
    protected $detections;

    public function __construct(array $detections = [])
    {
        $this->detections = $detections;
    }

    /**
     * @return array|TranslationDetectionItem[]
     */
    public function getAll(): array
    {
        return $this->detections;
    }

    /**
     * @param string $key
     * @return TranslationDetectionItem|null
     */
    public function get(string $key): ?TranslationDetectionItem
    {
        $translations = array_filter($this->detections, static function (TranslationDetectionItem $detection) use ($key) {
            return $detection->getKey() === $key;
        });

        return array_values($translations)[0];
    }

    /**
     * @return TranslationDetectionItem|null
     */
    public function first(): ?TranslationDetectionItem
    {
        return array_values($this->detections)[0] ?? null;
    }

    /**
     * @return TranslationDetectionItem|null
     */
    public function last(): ?TranslationDetectionItem
    {
        return last($this->detections) ?: null;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_map(static function (TranslationDetectionItem $detection) {
            return $detection->toArray();
        }, $this->detections);
    }
}
