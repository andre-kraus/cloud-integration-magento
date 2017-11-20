<?php

/**
 * Copyright Shopgate Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @author    Shopgate Inc, 804 Congress Ave, Austin, Texas 78701 <interfaces@shopgate.com>
 * @copyright Shopgate Inc
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */

class Shopgate_Cloudapi_Model_Api2_Carts_Customer_Rest extends Shopgate_Cloudapi_Model_Api2_Carts_Utility
{
    /** @noinspection PhpHierarchyChecksInspection */
    /**
     * @inheritdoc
     * @throws Exception
     */
    public function _create(array $filteredData)
    {
        $this->validateGuestCartId();
        $guestQuoteId = $this->getRequest()->getParam('cartId');
        $guestQuote   = $this->loadQuoteById($guestQuoteId);
        $this->validateGuestQuote($guestQuote);

        $customerQuote = $this->loadQuoteByCustomer();
        $this->validateCustomerQuote($customerQuote);

        $customerQuote->merge($guestQuote)
                      ->collectTotals()
                      ->save();

        return array('cartId' => $customerQuote->getId());
    }
}