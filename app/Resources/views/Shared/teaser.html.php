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
<div class="row margin-bottom-30">
                    <div class="col-md-12 ">
                        <div class="support-container">
                            <h2 class="support-heading"><?= $this->input("headline".$suffix) ?></h2>
                            <?= $this->wysiwyg("text".$suffix, ["height" => 100]); ?>
							<span style"align-right"><?= $this->link("link".$suffix, ["class" => "btn btn-default"]); ?></span>
                        </div>
						<p>
							
						</p>
                    </div>
</div>
<?php if($this->editmode) { ?>
            </div>
        </div>

    </body>
    </html>
<?php } ?>		