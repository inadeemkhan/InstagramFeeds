<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Nadeem\Instagram\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Serialize\Serializer\Json;

class Data extends AbstractHelper
{
    const INSTAGRAM_IS_ENABLE = "instagram_feed/configuration/is_enable";
    const INSTAGRAM_ACCESS_TOKEN = "instagram_feed/configuration/access_token";
    const INSTAGRAM_HEADING = "instagram_feed/configuration/heading_text";
    const INSTAGRAM_API_URL = "https://graph.instagram.com/me/media?fields=media_url,permalink,media_type";
    
    /**
     * @var Curl
     */
    protected $_curl;
    /**
     * @var ScopeConfigInterface
     */
    protected $_scopeConfig;
    /**
     * @var Json
     */
    protected $_json;

    /**
     * @param Context $context
     * @param Curl $curl
     * @param ScopeConfigInterface $scopeConfig
     * @param Json $json
     */
    public function __construct(
        Context $context,
        Curl $curl,
        ScopeConfigInterface $scopeConfig,
        Json $json
    ) {
        $this->_curl = $curl;
        $this->_scopeConfig = $scopeConfig;
        $this->_json = $json;
        parent::__construct($context);
    }

    /**
     * @return bool
     */
    public function isEnabled() {
        $isEnable = $this->_scopeConfig->getValue(self::INSTAGRAM_IS_ENABLE);
        return $isEnable;
    }
    /**
     * @return string
     */
    public function getAccessToken() {
        $accessToken = $this->_scopeConfig->getValue(self::INSTAGRAM_ACCESS_TOKEN);
        return $accessToken;
    }
    /**
     * @return string
     */
    public function getHeadingText() {
        $headingText = $this->_scopeConfig->getValue(self::INSTAGRAM_HEADING);
        return $headingText;
    }
    /**
     * @return json
     */
    public function getInstagramPostData() {
        if ($this->isEnabled()) {
            $photo_count = 5;
            $accessToken = $this->getAccessToken();
            $url = self::INSTAGRAM_API_URL."&access_token={$accessToken}";
            $this->_curl->get($url);
            $response = $this->_curl->getBody();
            return json_decode($response, true);
        }
    }
}

