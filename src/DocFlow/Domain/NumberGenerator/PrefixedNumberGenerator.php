<?php


namespace DocFlow\Domain\NumberGenerator;


use DocFlow\Domain\NumberGenerator;

class PrefixedNumberGenerator implements NumberGenerator
{
    /**
     * @var NumberGenerator
     */
    private $numberGenerator;
    /**
     * @var string
     */
    private $prefix;
    /**
     * @var string
     */
    private $separator;

    /**
     * PrefixedNumberGenerator constructor.
     * @param NumberGenerator $numberGenerator
     * @param string $prefix
     * @param string $separator
     */
    public function __construct(NumberGenerator $numberGenerator, string $prefix, string $separator = ':')
    {

        $this->numberGenerator = $numberGenerator;
        $this->prefix = $prefix;
        $this->separator = $separator;
    }

    public function generate(): string
    {
        return $this->prefix . $this->numberGenerator->generate();
    }
}