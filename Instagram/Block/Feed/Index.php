<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Nadeem\Instagram\Block\Feed;

use Nadeem\Instagram\Helper\Data;

class Index extends \Magento\Framework\View\Element\Template
{

    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context  $context
     * @param Data $helperData
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        Data $helperData,
        array $data = []
    ) {
        $this->helper = $helperData;
        parent::__construct($context, $data);
    }

    /**
     * @return jsonArray 
     */
    public function getInstagramPostData() {
        return $this->helper->getInstagramPostData();
    }
    /**
     * @return string 
     */
    public function getHeadingText() {
        return $this->helper->getHeadingText();
    }
}

