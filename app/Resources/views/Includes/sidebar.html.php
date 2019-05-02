<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */
?>

<?php

if($this->editmode) {
        // add some wrapping HTML to make it looking nicer in the editmode
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="/static/css/bootstrap.css" rel="stylesheet">
		<link href="/static/css/font-awesome.min.css" rel="stylesheet">
		<link href="/static/css/style.css" rel="stylesheet">
        <link href="/static/css/editmode.css?_dc=<?= time(); ?>" rel="stylesheet">
    </head>

    <body>
        <div style="max-width: 300px;">
            <div class="sidebar">
<?php } ?>
			<div class="col-md-4 padding-20">
			<?php
                // include a document-snippet - standard support teaser
				echo $this->inc('/shared/teasers/standard-teaser');
			?>
				

                <div class="row margin-top-20">
                    <div class="col-md-12">
                       <div class="fb-heading-small">
                            Categories
                        </div>
                        <hr class="style-three">
                        <?= $this->action("categories", "Article", null, []) ?> 
                    </div>
                </div>

                <div class="row margin-top-20">
                    <div class="col-md-12">
                        <div class="fb-heading-small">
                            Top Contributers
                        </div>
                        <hr class="style-three">
                        <?= $this->action("topusers", "User", null, []) ?> 
                    </div>
                </div>

                <!-- POPULAR TAGS (SHOW MAX 20 TAGS) -->
                <!--<div class="row margin-top-20">
                    <div class="col-md-12">
                        <div class="fb-heading-small">
                            Popular Tags
                        </div>
                        <hr class="style-three">
                        
                </div>-->
                <!-- END POPULAR TAGS (SHOW MAX 20 TAGS) -->
            </div>
<?php if($this->editmode) { ?>
            </div>
        </div>

    </body>
    </html>
<?php } ?>			