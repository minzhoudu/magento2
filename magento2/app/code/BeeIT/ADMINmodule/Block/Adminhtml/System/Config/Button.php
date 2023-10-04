<?php

namespace BeeIT\ADMINmodule\Block\Adminhtml\System\Config;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Exception\LocalizedException;

class Button extends Field
{
    /**
     * @var string
     */
    protected $_template = 'BeeIT_ADMINmodule::system/config/button.phtml';

    public function __construct(
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * @throws LocalizedException
     */
    public function render(AbstractElement $element): string
    {
        $this->setElement($element);
        return $this->toHtml();
    }
}
