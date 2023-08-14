<?php
namespace BeeIT\HelloWorld\Block\Product\ProductList;

use Magento\Catalog\Block\Product\ProductList\Toolbar as OriginalToolbar;

class Toolbar extends OriginalToolbar
{
    public function getAvailableOrders()
    {
        $options = parent::getAvailableOrders();
        $options['bestsellers'] = __('Bestsellers');
        return $options;
    }
}
