<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */ 
 
use Pimcore\Model\Document;
use Pimcore\Model\Document\Page;

/** @var \Symfony\Component\Security\Core\User\User $user */
$user = $this->app->getUser();
$form = $this->form;


// portal detection => portal needs an adapted version of the layout
$isPortal = $this->isPortal ?: false;

/** @var Document|Page $document */
$document = $this->document;

// output the collected meta-data
if (!$document) {
	// use "home" document as default if no document is present
	$document = Document::getById(1);
	$this->document = $document;
}

// resolve links to their target
if ($document instanceof Document\Link) {
	$document = $document->getObject();
	$this->document = $document;
}

if ($document instanceof Document\Page && $document->getTitle()) {
	// use the manually set title if available
	$this->headTitle()->set($document->getTitle());
}

if ($document instanceof Document\Page && $document->getDescription()) {
	// use the manually set description if available
	$this->headMeta()->setDescription($document->getDescription());
}

$this->headTitle()->append($this->translate('Pimcore Knowledge Base'));
$this->headTitle()->setSeparator(" : ");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php 
	    echo $this->headTitle();
		echo $this->headMeta();
    ?>
    
	<!-- Le styles -->
    <?php
    // we use the view helper here to have the cache buster functionality
    $this->headLink()->appendStylesheet('/static/css/bootstrap.css');
    $this->headLink()->appendStylesheet('/static/css/font-awesome.min.css');
    $this->headLink()->appendStylesheet('/static/css/style.css', "screen");
    $this->headLink()->appendStylesheet('/static/css/print.css', "print");
    if ($this->editmode) {
        $this->headLink()->appendStylesheet('/static/css/editmode.css', "screen");
    }
    ?>

    <?= $this->headLink(); ?>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/static/js/html5shiv.js"></script>
    <script src="/static/js/respond.min.js"></script>
	<![endif]-->
	
    <!-- LOADING STYLESHEETS -->
    <script src="/static/ckeditor/ckeditor.js"></script>
</head>

<body>
    <div class="container-fluid featured-area-white-border">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php if(!$user) {?>
                    <div class="login-box border-right-1">
                        <a href="/secure/login">
                            <i class="fa fa-key"></i> Login</a>
                    </div>
                    <div class="login-box border-left-1 border-right-1">
                        <a href="/secure/register">
                            <i class="fa fa-pencil"></i> Sign Up</a>
                    </div>
                    <?php
                    } else {
                    ?>
                    <div class="login-box border-right-1">
                    Welcome <?= $user->getUsername(); ?>
                    <a href="/secure/logout">
                            <i class="fa fa-key"></i> Logout</a>
                    </div>
                    <?php } ?>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- LOGO -->
    <div class="container">
        <div class="row">
            <div class="header">
                <div class="logo">
                    <img src="/static/images/pimcore-logo.png" width="220px" alt="logo">
                </div>
            </div>
        </div>
    </div>
    <!-- END LOGO-->
    <!-- TOP NAVIGATION -->
	<?php
    $mainNavStartNode = $document->getProperty('mainNavStartNode');
    if (!$mainNavStartNode) {
        $mainNavStartNode = Document::getById(1);
    }
    ?>
    <div class="container-fluid">
        <div class="navigation">
            <?php
                    $mainNavigation = $this->navigation()->buildNavigation($document, $mainNavStartNode);
					$home = Document::getById(1);
                    echo $this->navigation()->render($mainNavigation, 'menu', 'renderMenu', [
                        'maxDepth' => 1,
                        'ulClass'  => 'topnav'
                    ]);
                    ?>
        </div>
    </div>
    <!-- END TOP NAVIGATION -->
    <!-- SEARCH FIELD AREA -->
    <div class="searchfield bg-hed-six">
        <div class="container" style="padding-top: 20px; padding-bottom: 20px;">
            <!--<div class="row text-center margin-bottom-20">
                <h1 class="white"> <?=$this->translate('Knowledge Base');?></h1>
                <span class="nested"><?=$this->translate('Learn to use Pimcore');?></span>
            </div>
            <br>-->
            <?= $this->action("searchform", "Article", null, []) ?>
        </div>
    </div>
    <!-- END SEARCH FIELD AREA -->
    <!-- MAIN SECTION -->
    <div class="container featured-area-default padding-30">
        <div class="row">
            <div class="col-md-8 padding-20">
			<!-- Document Content Comes here-->
                <?php $this->slots()->output('_content') ?>
            </div>
            <!-- END ARTICLES CATEOGIRES SECTION -->
            <!-- SIDEBAR STUFF -->
            <?= $this->inc($document->getProperty('sidebar')); ?>
            <!-- END SIDEBAR STUFF -->
        </div>
    </div>
    <!-- END MAIN SECTION -->

    <!-- ABOUT CONTAINER BOTTOM -->
    <?= $this->template('Includes/aboutus.html.php') ?>
    <!-- END ABOUT CONTAINER BOTTOM -->

    <!-- FOOTER -->
   <?= $this->template('Includes/footer.html.php') ?>
    <!-- END FOOTER -->

    <!-- COPYRIGHT INFO -->
    <?= $this->template('Includes/copyright.html.php') ?>
    <!-- END COPYRIGHT INFO -->

    <!-- LOADING MAIN JAVASCRIPT -->
	<?php
// include a document-snippet - in this case the footer document
echo $this->inc('/' . $this->getLocale() . '/shared/includes/footer');

// global scripts, we use the view helper here to have the cache buster functionality
$this->headScript()->prependFile('/static/js/bootstrap.min.js');
$this->headScript()->prependFile('/static/js/main.js');
$this->headScript()->prependFile('/static/js/jquery-2.2.4.min.js');
$this->headScript()->appendFile('https://cdn.rawgit.com/VPenkov/okayNav/master/app/js/jquery.okayNav.js');
echo $this->headScript();
?>
</body>

</html>