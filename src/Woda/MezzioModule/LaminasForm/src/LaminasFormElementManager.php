<?php

declare(strict_types=1);

namespace Woda\MezzioModule\LaminasForm;

use Laminas\Form\FormInterface;
use RuntimeException;

class LaminasFormElementManager implements FormElementManagerInterface
{
    private PolyfillFormElementManager $formManager;

    public function __construct(PolyfillFormElementManager $formManager)
    {
        $this->formManager = $formManager;
    }

    /**
     * @inheritDoc
     */
    public function get(string $name, ?array $options = null): FormInterface
    {
        $form = $this->formManager->get($name, $options);
        if (!$form instanceof FormInterface) {
            throw new RuntimeException(\Safe\sprintf('Form with name "%s" not found in FormElementManager', $name));
        }
        return $form;
    }
}
