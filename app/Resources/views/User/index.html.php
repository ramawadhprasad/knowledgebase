<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');
?>
            <!-- ARTICLE OVERVIEW SECTION -->
            
                
              <!-- BREADCRUMBS -->
              <div class="breadcrumb-container">
                        <ol class="breadcrumb">
                            <li>
                                <a href="index.html">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li class="active">All Users</li>
                        </ol>
                    </div>
                    
                    <!-- END BREADCRUMBS -->
					<!-- ARTICLES -->
            
                    
            
                    
                    <div class="fb-heading">
                        All Users
                    </div>
                    <hr class="style-three">
                    <div class="panel panel-default">
                    <div class="article-info">
					<?php foreach ($this->users as $user) { 
					/** @var User $user */
					?>
					
                        <div class="col-md-6 margin-bottom-20">

                            <div class="article-heading-abb">
                                <a href="#">
                                    <i class="fa fa-pencil-square-o"></i><?= $user->getLastname(); ?>, <?= $user->getFirstname(); ?></a>
                            </div>
    
                        </div>
                        <?php } ?>
                    </div>
                    <!-- END ARTICLES -->

                </div>
         
           