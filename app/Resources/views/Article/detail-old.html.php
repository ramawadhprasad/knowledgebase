<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');
$form = $this->form;
?>

<?php
    // set page meta-data
    $this->headTitle()->set($this->article->getTitle());
    $this->headMeta()->setDescription($this->article->getContent(), 160);
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
                            <li class="active">All Articles</li>
                        </ol>
                    </div>
                    <!-- END BREADCRUMBS -->

                    
					<!-- ARTICLE  -->
                    <div class="panel panel-default">
                        <div class="article-heading margin-bottom-5">
                            <a href="#">
                                <i class="fa fa-pencil-square-o"></i> <?= $this->article->getTitle(); ?></a>
                        </div>
                        <div class="article-info">
                            <div class="art-category">
							<?php 
							$poster = $this->article->getPostedBy();
							$category = $this->article->getCategory(); 

							?>
                                <a href="#">
                                    <i class="fa fa-folder"></i> 
									asked on <?= date("d/m/Y", $this->article->getCreationDate());?> by <?= ($poster)->getFirstname();?> in <?= $category->getName(); ?>
									</a>
                            </div>
                            <!--
							<div class="art-comments">
                                <a href="#">
                                    <i class="fa fa-comments-o"></i> 4 Comments </a>
                            </div>
							-->
                        </div>
                        <div class="article-content">
                            <?= $this->article->getBlurb(); ?>
                        </div>
                        <div class="article-content">
                            <?php if($documents = $this->article->getDocuments()){ 
                               foreach($documents as $document) { 
                              //     print_r($document);
                            if($document->getType()=='document') {
                                   ?>

                               <a href="<?=\Pimcore\Tool::getHostUrl() . $document->getFullPath();?>"><?= $document->getFilename();?></a><br/>
                               
                               <?php
                            } elseif($document->getType()=='image'){
                                ?>

                               <img src="<?=\Pimcore\Tool::getHostUrl() . $document->getFullPath();?>" width="300"><br/>
                               
                               <?php

                            } elseif($document->getType()=='video'){
                                ?>
                               <video width="320" height="240" controls>
                                <source src="<?=\Pimcore\Tool::getHostUrl() . $document->getFullPath();?>"><?= $document->getFilename();?>" type="video/mp4">
                                 Your browser does not support the video tag.
                                </video><br/>
                               <?php

                            }
                               } 
                            }
                            ?>
                            
                        </div>
						<div>
						<div class="row">
    <div class="col-md-7 col-md-push-2">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <?= $this->translate('Can you answer this question?') ?>
                </h3>
            </div>

            <div class="panel-body">

                <?php if ($this->error): ?>
                    <div class="alert alert-danger"><?php echo $this->error->getMessage() ?></div>
                <?php endif ?>

                <?= $this->form()->start($form); ?>
				<?= $this->form()->row($form['content']) ?>
                <?= $this->form()->row($form['question']) ?>
				<?= $this->form()->row($form['attachment']) ?>
                <?= $this->form()->widget($form['_target_path']) ?>
                <?= $this->form()->widget($form['_submit'], [
                    'attr' => [
                        'class' => 'btn btn-primary pull-right'
                    ]
                ]) ?>
                <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'answer_form_content');
            </script>
                <?= $this->form()->end($form); ?>
            </div>
        </div>
    </div>
</div>
						<h3>Answers</h3>
						
						<div class="article-answers">
                            <?php
							$answers = $this->article->getAnswers(); 
							//print_r($answers);
							foreach($answers as $answer) {
								
								//$answer= $object->getObject();
								echo $answer->getContent();
								if($poster = $answer->getPostedBy()) {
								echo '<div> Posted By:' . $poster->getFirstname() . '</div>';
								}
								echo '<hr>';
							}
						
						?>
                        </div>
						
						
						
						
                        
                    </div>
                    <!-- END ARTICLE -->

               
                </div>
            </div>
            <!-- END ARTICLES OVERVIEW SECTION-->