<?php

declare(strict_types=1);

namespace Woda\MezzioModule\LaminasForm;

use Woda\Form\FormElementManager;

class LaminasFormElementManager implements FormElementManager
{
    /** @var PolyfillFormElementManager */
    private $formManager;

    public function __construct(PolyfillFormElementManager $formManager)
    {
        $this->formManager = $formManager;
    }

    /**
     * @inheritDoc
     */
    public function get(string $name, ?array $options = null): object
    {
        return $this->formManager->get($name, $options);
    }
}
