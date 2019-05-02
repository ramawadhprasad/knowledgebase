<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */
?>

<section class="area-image-banner">

    <?php if($this->editmode) { ?>
      <div> Select Banner Image <?= $this->image('bannerImage');?></div>
	  <div> Enter Banner URL <?= $this->input('bannerUrl');?></div>
	  <div> Enter Banner Title<?=$this->input('bannerTitle');?></div>
         
    <?php } ?>
	<div>
	<a href="<?=$this->input('bannerUrl');?>">
	<img src="<?=$this->image('bannerImage')->getThumbnail("banner");?>" alt="<?=$this->input('bannerTitle');?>">
	</a>
    <div>

</section>
