<?php

namespace OSSTools\LibreTranslate\Translation;

class TranslationCollection
{
    /**
     * @var TranslationItem[]
     */
    protected $translations;

    public function __construct(array $translations = [])
    {
        $this->translations = $translations;
    }

    /**
     * @return array|TranslationItem[]
     */
    public function getAll(): array
    {
        return $this->translations;
    }

    /**
     * @param string $key
     * @return TranslationItem|null
     */
    public function get(string $key): ?TranslationItem
    {
        $translations = array_filter($this->translations, static function (TranslationItem $translation) use ($key) {
            return $translation->getKey() === $key;
        });

        return array_values($translations)[0];
    }

    /**
     * @return TranslationItem|null
     */
    public function first(): ?TranslationItem
    {
        return array_values($this->translations)[0] ?? null;
    }

    /**
     * @return TranslationItem|null
     */
    public function last(): ?TranslationItem
    {
        return last($this->translations) ?: null;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_map(static function (TranslationItem $translation) {
            return $translation->toArray();
        }, $this->translations);
    }
}
