<?php

namespace OSSTools\LibreTranslate\Translation;

class Translations
{
    /**
     * @var Translation[]
     */
    protected $translations;

    public function __construct(array $translations = [])
    {
        $this->translations = $translations;
    }

    /**
     * @return array|Translation[]
     */
    public function getAll(): array
    {
        return $this->translations;
    }

    /**
     * @param string $key
     * @return Translation|null
     */
    public function get(string $key): ?Translation
    {
        $translations = array_filter($this->translations, static function (Translation $translation) use ($key) {
            return $translation->getKey() === $key;
        });

        return array_values($translations)[0];
    }

    /**
     * @return $this
     */
    public function flush(): self
    {
        $this->translations = [];

        return $this;
    }
}
