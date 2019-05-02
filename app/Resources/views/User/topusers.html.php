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
foreach($this->users as $user) {
?>
<li><i class="fa fa-file-text-o"></i><?=$user->getFirstname() . ' ' . $user->getLastname();?> (<?=$user->getPosts();?>)</li>
<?php 
}
?>
</ul>                
</div>