<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */
$articles=$this->articles;
?>
<div class="row margin-bottom-30">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="featured-box">
<div class="row">
                        <div class="col-md-9 margin-bottom-20">
                            <div class="fb-heading-small">
                                
                                    Popular Articles
                                
                            </div>
                            <div class="fat-content-small padding-left-30">
                                <ul>
                                <?php
                                foreach($articles as $article) {
                                    $detailLink = $this->path("articles", [
                                        "id"     => $article->getId(),
                                        "text"   => $article->getTitle(),
                                        "prefix" => $this->document->getFullPath()
                                    ]);
                                ?>
                                    <li>
                                        <a href="<?=$detailLink?>">
                                            <i class="fa fa-file-text-o"></i><?=$article->getTitle();?></a>
                                    </li>
                                <?php
                                }
                                ?>    
                                </ul>
                            </div>
                        </div>
                </div> 
                </div>
                        </div>
                    </div>
                </div>              