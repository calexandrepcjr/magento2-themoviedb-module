<?php
namespace Capcj\TheMovieDb\Controller\Adminhtml\Movies;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\Page;

class Index extends Action
{
	protected $_pageFactory;

	public function __construct(Context $context, PageFactory $pageFactory)
	{
		parent::__construct($context);
        $this->_pageFactory = $pageFactory;
	}

	public function execute(): Page
	{
        return $this->_pageFactory->create();
	}
}
