<?php declare(strict_types=1);

namespace Woda\MezzioModule\LaminasForm;

use Laminas\Form\FormInterface;

interface FormElementManagerInterface
{
    /**
     * @param string $name
     * @param array<string, mixed>|null $options
     * @return FormInterface
     */
    public function get(string $name, ?array $options = null): FormInterface;
}
