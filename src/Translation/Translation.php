<?php

namespace OSSTools\LibreTranslate\Translation;

class Translation
{
    /**
     * @var string|null
     */
    protected $key;

    /**
     * @var string|null
     */
    protected $text;

    /**
     * @var string|null
     */
    protected $locale;

    /**
     * @param string $key
     * @param string $text
     */
    public function __construct(string $key, string $text, string $locale)
    {
        $this->key = $key;
        $this->text = $text;
        $this->locale = $locale;
    }

    /**
     * @return string|null
     */
    public function getKey(): ?string
    {
        return $this->key;
    }

    /**
     * @return string|null
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }
}
