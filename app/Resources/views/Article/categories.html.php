<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

?>
<div class="fat-content-small padding-left-10">
<ul>
<?php 
foreach($this->categories as $category) {
?>
<li><i class="fa fa-file-text-o"></i><a href='/questions?category=<?=$category->getId();?>'><?=$category->getName();?></a></li>
<?php 
}
?>
</ul>                
</div>