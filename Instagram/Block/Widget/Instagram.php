<?php
declare(strict_types=1);

namespace Nadeem\Instagram\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class Instagram extends Template implements BlockInterface
{
    protected $_template = "widget/instagram.phtml";
}
