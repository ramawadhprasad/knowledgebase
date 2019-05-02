<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */
?>

<?php
// start pagination
if ($this->pageCount): ?>
<nav class="text-center">
                        <ul class="pagination">
                            <?php if (isset($this->previous)): ?>
							<li>
                                <a href="<?= $this->pimcoreUrl(['page' => $this->first]); ?>"><?= $this->first; ?>
                                    <span aria-hidden="true">
                                        <i class="fa fa-arrow-circle-left"></i> Previous</span>
                                </a>
                            </li>
							<?php endif; ?>
                            <?php foreach ($this->pagesInRange as $page)
							{
								$class = '';
								if ($page == $current) $class = 'active';
								if( ($this->first < $page) && ($page < $this->last) || $page == $current)
								{
							?>
							<li class="<?= $class; ?>"><a href="<?= $this->pimcoreUrl(['page' => $page]); ?>"><?= $page; ?></a></li>
							<?php
								}
							}
							?>
                            
							<?php if (isset($this->next)): ?>
									<li class="last"><a href="<?= $this->pimcoreUrl(['page' => $this->last]); ?>">&rarr; <?= $this->last; ?></a></li>
							<?php endif; ?>
                            
							
                        </ul>
						
                    </nav>
<?php endif; ?>
