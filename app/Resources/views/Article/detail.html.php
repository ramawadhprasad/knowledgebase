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
                    <!-- ARTICLE  -->
<?php 
$poster = $this->article->getPostedBy();
$category = $this->article->getCategory(); 

?>             
<div class="panel panel-default">
                        <div class="article-heading margin-bottom-5">
                            <a href="#">
                                <i class="fa fa-pencil-square-o"></i> <?= $this->article->getTitle(); ?></a>
                        </div>
                        <div class="article-info">
                            <div class="art-date">
                                <a href="#">
                                    <i class="fa fa-calendar-o"></i> <?= date("d/m/Y", $this->article->getCreationDate());?> by <?= ($poster)->getFirstname();?> </a>
                            </div>
                            <div class="art-category">
                                <a href="#">
                                    <i class="fa fa-folder"></i> <?= $category->getName(); ?> </a>
                            </div>
                            <div class="art-comments">
                                <a href="#">
                                    <i class="fa fa-comments-o"></i> 4 Comments </a>
                            </div>
                        </div>
                        <div class="article-content">
                            <p>
                            <?= $this->article->getBlurb(); ?>
                            </p>
                            <?php if($this->article->getContent()) { ?>
                            <hr class="style-transparent">

                            <h2> <small>Full Description</small>
                            </h2>
                            <p>
                            <?= $this->article->getContent(); ?>
                            </p>
                            <?php } ?>


                            <div class="article-tags">
                            <?php
				            $tags = \Pimcore\Model\Element\Tag::getTagsForElement('object', $article->getId());

                            ?>
                             <b>Tags:</b>
                              <?php
                              foreach ($tags as $tag) { ?>
                                <a href="#" class="btn btn-default btn-o btn-sm"><?=$tag->name?></a>
                              <?php
                              }
                              ?>
                            </div>
                             <div> 
                            <b>Documents:</b>
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
                                   <!-- </div>-->
                                
 
                            </div>
                    
                                        
                                
                            <div class="article-feedback">
                            <h2>
                                <small>Was This Article Helpful?</small>
                            </h2>
                            <button type="button" class="btn btn-success btn-o btn-wide">
                                <i class="fa fa-thumbs-o-up"></i> Yes</button>
                            <button type="button" class="btn btn-danger btn-o btn-wide">No
                                <i class="fa fa-thumbs-o-down"></i>
                            </button>
                        
                            </div>
                    
                    <!-- END ARTICLE -->

                    <!-- COMMENTS  -->
                    <div class="panel panel-default">
                        <div class="article-heading">
                            <i class="fa fa-comments-o"></i> Answers / Comments ( <?= count($article->getAnswers()); ?> )
                        </div>
                        <?php
							$answers = $this->article->getAnswers();
						?>
                        <!-- FIRST LEVEL COMMENT 1 -->
                        
                        <div class="article-content">
                        <?php
                            foreach($answers as $answer) {
                                $poster = $answer->getPostedBy();
                        ?>   
                            <div class="article-comment-top">
                                <div class="comments-user">
                                    <img src="images/user.png" alt="user avatar">
                                    <div class="user-name"><?=$poster->getFirstname()?></div>
                                    <div class="comment-post-date">Posted On
                                        <span class="italics"><?=date('d/m/Y',$answer->getCreationDate());?></span>
                                    </div>
                                </div>
                                <div class="comments-content">
                                    <p>
                                    <?=$answer->getContent();?>
                                    </p>
                                    
                                </div>

                                
                            </div>
                        
                        <?php
                            }
                        ?>
                        </div>
                        <!-- END FIRST LEVEL COMMENT 1 -->

                       
                        <hr class="style-three">
                        <!-- LEAVE A REPLY SECTION -->
                        <div class="panel-transparent">
                            <div class="article-heading">
                                <i class="fa fa-comment-o"></i> Your Answer
                            </div>
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
                                
            
            </div
        ></div>   
    </div> 
                
                <!-- END LEAVE A REPLY SECTION -->
                    
                

            