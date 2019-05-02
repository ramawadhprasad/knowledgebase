<?php

namespace AppBundle\Controller;

use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Request;
use Pimcore\Model\Asset;

class ContentController extends FrontendController
{
    public function defaultAction(Request $request)
    {

    }
	
	public function productAction(Request $request)
    {
    }
	
	public function knowledgebaseAction(Request $request)
    {
    }
	
	public function faqAction(Request $request)
    {
    }
	
	public function articlesAction(Request $request)
    {
    }
	
	public function myGalleryAction(Request $request)
	{
		if ('asset' === $request->get('type')) {
			$asset = Asset::getById($request->get('id'));
			if ('folder' === $asset->getType()) {
				$this->view->assets = $asset->getChildren();
			}
		}
	}
}