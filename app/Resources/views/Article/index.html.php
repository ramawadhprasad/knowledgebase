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
                                <a href="/">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li class="active">Questions</li>
                        </ol>
                    </div>
       
                    <!-- END BREADCRUMBS -->
					<!-- ARTICLES -->
                    <div class="fb-heading">
                        <?=$this->pageHeading;?>
                    </div>
                    <hr class="style-three">
					<?php foreach ($this->articles as $article) { ?>
					<?php
					/** @var BlogArticle $article */
					?>
					<!--<div class="media">-->
						<?php

							$detailLink = $this->path("articles", [
								"id"     => $article->getId(),
								"text"   => $article->getTitle(),
								"prefix" => $this->document->getFullPath()
							]);
							$poster = $article->getPostedBy();
							$category = $article->getCategory();
						?>
                    <div class="panel panel-default">
                        <div class="article-heading-abb">
                            <a href="<?= $detailLink; ?>">
                                <i class="glyphicon glyphicon-question-sign"></i><?= $article->getTitle(); ?></a>
                        </div>
                        <div class="article-info">
                            <div class="art-date">         
                                    <i class="fa fa-calendar-o"></i> asked on <?= date("d/m/Y", $article->getCreationDate()); ?> by <?= ($poster)->getFirstname();?> in <?= $category->getName(); ?>
                            </div>
                            <div class="art-category">
                               
                            </div>
                
                        </div>
                        <div class="article-content">
                            <p class="block-with-text">
                                <?= $article->getBlurb(); ?>
                            </p>
                        </div>
						<div class="article-info">
                            <?= count($article->getAnswers()); ?> Answers &nbsp;&nbsp;<?= $article->getViews();?> Views &nbsp;&nbsp;<?= $article->getUpvotes(); ?> Votes 
                Tags: 
				<?php
				$tags = \Pimcore\Model\Element\Tag::getTagsForElement('object', $article->getId());
				foreach ($tags as $tag) {
					echo $tag->name .', ';

				}
				?>
                        </div>
 
                    </div>
			<?php } ?>
                    <!-- END ARTICLES -->

                    <!-- PAGINATION -->
				<div>	
                    <?= $this->render(
						"Includes/paging.html.php",
						get_object_vars($this->articles->getPages("Sliding")));
					?>
                    <!-- END PAGINATION -->
                </div>
            
            <!-- END ARTICLES OVERVIEW SECTION-->
            