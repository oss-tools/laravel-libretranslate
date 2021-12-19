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
    protected $value;

    /**
     * @param $key
     * @param $value
     */
    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
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
    public function getValue(): ?string
    {
        return $this->value;
    }
}
