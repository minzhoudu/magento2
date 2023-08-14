<?php
namespace BeeIT\HelloWorld\Plugin;

use Magento\Catalog\Model\Config as MagentoConfig;

class Bestsellers
{
    public function afterGetAttributeUsedForSortByArray(MagentoConfig $subject, array $result): array
    {
        $result['bestsellersPlugin'] = 'Bestsellers plugin';
        return $result;
    }
}
