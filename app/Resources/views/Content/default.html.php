<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');

?>
 <div class="row margin-bottom-30">
                    <div class="col-md-12">

                    <!-- BREADCRUMBS -->
                    <div class="breadcrumb-container">
                        <ol class="breadcrumb">
                            <li>
                                <a href="index.html">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li class="active">Knowledge Base</li>
                        </ol>
                    </div>
                    <!-- END BREADCRUMBS -->
                    <!-- ARTICLES CATEGORIES SECTION -->
                    <hr class="style-three">
                    <?= $this->action("latest", "Article", null, ['count'=>5]) ?>
					<hr class="style-three">
                    <?= $this->action("popular", "Article", null, ['count'=>5]) ?>
                </div>
            </div>
                