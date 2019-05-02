<?php

namespace AppBundle\Controller;

use Pimcore\Controller\FrontendController;
use Pimcore\Model\DataObject;
use Pimcore\Tool\Frontend;
use Symfony\Component\HttpFoundation\Request;
use Zend\Paginator\Paginator;


class UserController extends FrontendController
{
    public function indexAction(Request $request) {
        $userList = new DataObject\User\Listing();
        $userList->setOrderKey('firstname');
        $userList->setOrder('ASC');
        $this->view->users= $userList;
    }

    public function topusersAction(Request $request) {
        $userList = new DataObject\User\Listing();
        $userList->setOrderKey('posts');
        $userList->setOrder('DESC');
        $userList->setLimit(5);
        $this->view->users= $userList;
    }
}
