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
                <!-- ARTICLE CATEGORIES SECTION -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="fb-heading">
                            Frequently Asked Questions
                        </div>
                        <hr class="style-three">
                        <div class="row">
                            <div class="col-md-12">
							<?= $this->areablock('myAreablock'); ?>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END ARTICLES CATEOGIRES SECTION -->