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

/* /app/code/local/Atwix/ProductOptions/Helper/Data.php */
class Atwix_ProductOptions_Helper_Data extends Mage_Core_Helper_Abstract
{
    protected $_storageModel = null;

    public function  __construct()
    {
        $this->_storageModel = Mage::getSingleton('atwix_productoptions/storage');
    }

    /**
     * gets options from storage and generates string
     * @param $id
     * @param $code
     * @return string
     */
    public function getConfigurableProductAttributeOptions($id, $code)
    {
        $values = $this->_storageModel->getOptions($id, $code);
        if ($values){
            return implode(', ',$values);
        }
        return '';
    }
}