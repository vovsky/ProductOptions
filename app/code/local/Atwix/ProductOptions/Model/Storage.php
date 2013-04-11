<?php
/**
 * Atwix
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @category    Atwix Mod
 * @package     Atwix_ProductOptions
 * @author      Atwix Core Team
 * @copyright   Copyright (c) 2013 Atwix (http://www.atwix.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
/* /app/code/local/Atwix/ProductOptions/Model/Storage.php */

class Atwix_ProductOptions_Model_Storage extends Mage_Core_Model_Abstract
{
    /**
     * options will be stored in this array
     * @var null|array
     */
    protected $_attributes = null;

    /**
     * options labels
     * @var null|array
     */
    protected $_options = null;

    /**
     * Puts Color options to $_attributes array
     * @param $collection
     * @return $this
     */
    public function storeData($collection)
    {
        foreach($collection->getItems() as $item){
            if ($color = $item->getColor()){
                $this->_attributes[$item->getParentId()]['color'][$color] = $this->getOptionLabel('color', $color);
            }
        }
        return $this;
    }

    /**
     * Retrieves option label by attribute name and value
     * stores all labels in array on first calling
     * @param $attrName
     * @param $value
     * @return mixed
     */
    public function getOptionLabel($attrName, $value){
        if (!isset($this->_options[$attrName])){
            $attribute = Mage::getModel('eav/config')->getAttribute('catalog_product', $attrName);
            $optArray = $attribute->getSource()->getAllOptions(false);
            foreach($optArray as $item){
                $this->_options[$attrName][$item['value']] = $item['label'];
            }
        }
        return $this->_options[$attrName][$value];
    }

    /**
     * Returns options for products
     * @param product id $id
     * @param $code
     * @return bool|array
     */
    public function getOptions($id, $code)
    {
        if (isset($this->_attributes[$id][$code])){
            return $this->_attributes[$id][$code];
        }
        return false;
    }
}
