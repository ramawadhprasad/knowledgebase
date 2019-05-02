<?php

namespace AppBundle\Controller;

use AppBundle\Form\AskFormType;
use AppBundle\Form\AnswerFormType;
use AppBundle\Form\SearchFormType;
use Pimcore\Controller\FrontendController;
use Pimcore\Model\DataObject;
use Pimcore\Tool\Frontend;
use Pimcore\Model\Asset;
use Symfony\Component\HttpFoundation\Request;
use Zend\Paginator\Paginator;


class ArticleController extends FrontendController
{
    

    public function indexAction(Request $request, \Pimcore\Config\Config $websiteConfig)
    {
        
        $pageHeading = "Questions";
        $formData = [
			'search'    => $request->get('search'),
            '_target_path' => '/questions'
        ];
		 
		$form = $this->createForm(SearchFormType::class, $formData, [
            'action' => '', 
        ]);

        $form->handleRequest($request);
        $formData = $form->getData();
        $search = $formData['search'];
        $category = $request->get('category');
        $type = $request->get('type');
        
        // get a list of news objects and order them by date
        
        $articleList = $this->getArticles($search, $type, $category);    
        

        // we're using Zend\Paginator here, but you can use any other paginator (e.g. Pagerfanta)
        $paginator = new Paginator($articleList);
        $paginator->setCurrentPageNumber($request->get('page'));
		
		$pageSize = $websiteConfig->get('page-size');
        $paginator->setItemCountPerPage($pageSize);

        $this->view->articles = $paginator;
        $this->view->form = $form->createView();
        $this->view->pageHeading = $pageHeading;

    }
	
	 public function detailAction(Request $request)
    {
        // "id" is the named parameters in "Static Routes"
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        $user = $this->getUser();
        $article = DataObject\Article::getById($request->get('id'));
		//print_r($article);die;
		
        if (!$article instanceof DataObject\Article || !$article->isPublished()) {
            throw $this->createNotFoundException('Invalid request - no such article');
        }
		
		$formData = [
			'content'    => '',
            'question'    => $request->get('id'),
			'user'    => '40',
            '_target_path' => '/' . $request->getLocale() . '/articles'
        ];
		 
		$form = $this->createForm(AnswerFormType::class, $formData, [
            'action' => '', 
        ]);

        $form->handleRequest($request);

        $success = false;
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
				$formData = $form->getData();
				$answer = new DataObject\Comment(); 
				$answer->setKey(\Pimcore\File::getValidFilename($formData['content']));
				$answer->setParentId($formData['question']);
				$answer->setContent($formData['content']);
				$user = $this->getUser();
				$answer->setPostedBy($user);
                $answer->setPublished(true);
                
                // save uploaded file to assets
                $attachment = $form['attachment']->getData();
                $filename = 'file'. uniqid().'.'.$attachment->guessExtension();            
                $asset=$this->createAsset($attachment->getPathname(),$filename,'/attachments/');
                $answer->setDocuments([$asset,]);
                $answer->save();
                
				$question = DataObject\Article::getById($formData['question']);
                $question->setAnswers([$answer,]);
				$question->save();
                $success = true;
            }
        }

        $this->view->article = $article;
		$this->view->form = $form->createView();
    }
	
	public function askAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        $user = $this->getUser();
        $formData = [
			'category'    => $request->get('category'),
            'title'    => $request->get('title'),
			'blurb'    => $request->get('blurb'),
			'content'    => $request->get('content'),
            '_target_path' => '/' . $request->getLocale()
        ];
		
		$form = $this->createForm(AskFormType::class, $formData, [
            'action' => $this->generateUrl('kb_ask'),
        ]);

        $form->handleRequest($request);

        $success = false;
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
				$formData = $form->getData();
				$question = new DataObject\Article(); 
				$question->setKey(\Pimcore\File::getValidFilename($formData['title']));
				$question->setParentId(23);
				$question->setArticleType('question');
				$question->setTitle($formData['title']);
				$category = DataObject\Category::getById($formData['category']);
				//print_r($category);
                $question->setCategory($category);
                $question->setArticleType($formData['type']);
				$question->setBlurb($formData['blurb']);
				$question->setContent($formData['content']);
				$user = $this->getUser();
                $question->setPostedBy($user);
                //$question->setDateCreated(date('d/m/Y'));
				$question->setPublished(true);
                
                // save uploaded file to assets
                $attachment = $form['attachment']->getData();
                $filename = 'file'. uniqid().'.'.$attachment->guessExtension();            
                $asset=$this->createAsset($attachment->getPathname(),$filename,'/attachments/');
                $question->setDocuments([$asset,]);
                $question->save();
                $success = true;
                // increment post count for the user
                $user->setPosts($user->getPosts()+1);
                $user->save();
            }
        }

        // add success state and form view to the view
        $this->view->success = $success;
        $this->view->form    = $form->createView();
    }

    public function searchformAction(Request $request) {
        $formData = [
            'search'    => $request->get('search'),
            'type'    => $request->get('type'),
            '_target_path' => '/questions'
        ];
		 
		$form = $this->createForm(SearchFormType::class, $formData, [
            'action' => '/questions', 
        ]);
        $form->handleRequest($request);
        $this->view->form = $form->createView();
    }

    public function createAsset($filepath,$filename,$parentFolder) {
        $newAsset = new \Pimcore\Model\Asset();
        $newAsset->setFilename($filename);
        $newAsset->setData(file_get_contents($filepath));
        $newAsset->setParent(\Pimcore\Model\Asset::getByPath($parentFolder));
        $newAsset->save();
        return($newAsset);
    }

    public function categoriesAction() {
        $categoryList = new DataObject\Category\Listing();
        $categoryList->setOrderKey('name');
        $categoryList->setOrder('asc');
        $this->view->categories = $categoryList;
    }

    public function latestAction(int $count=5){
        $articles = $this->getArticles('', '', '', 'dateCreated','DESC',0, $count); 
        $this->view->articles = $articles;
    }

    public function popularAction(int $count=5){
        $articles = $this->getArticles('', '', '', 'views','DESC',0, $count); 
        $this->view->articles = $articles;
    }

    private function getArticles($search='', $type='', $category='', $sortby='dateCreated',$sortOrder='DESC',$offset=0, $perPage=0) {

        $articleList = new DataObject\Article\Listing();

        if($type!=''){
            $articleList->setCondition("articleType = ?", ["$type"], "AND"); 
        }

        if($search!=''){
            $articleList->setCondition("title LIKE ? or content LIKE ? or blurb LIKE ?", ["%$search%","%$search%", "%$search%"]); 
        }

        if($category!=''){
            $articleList->setCondition("category__id = ?", ["$category"]);
            $categoryObject = DataObject\Category::getById($category);
            $categoryName = $categoryObject->getName();
            $pageHeading .= " : ". $categoryName;

        }

        $articleList->setOrderKey($sortby);
        $articleList->setOrder($sortOrder);

        if($offset!=0) {
            $articleList->setOffset($offset); 
        }
        if($perPage!=0) {
            $articleList->setLimit($perPage); 
        }

        return($articleList);

    }

}
