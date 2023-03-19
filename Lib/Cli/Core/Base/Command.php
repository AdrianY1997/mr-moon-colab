<?php

namespace Lib\Cli\Core\Base;

use Lib\Cli\Core\Printer;

class Command
{
    protected array $property;
    protected array $options;
    protected Printer $printer;

    public function __construct(array $property, array $options)
    {
        $this->property = $property;
        $this->options = $options;
        $this->printer = new Printer();
    }
}
