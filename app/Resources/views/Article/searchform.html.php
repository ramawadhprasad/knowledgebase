<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */
$form = $this->form;
?>
<div class="row search-row">

                <?= $this->form()->start($form); ?>
                <?= $this->form()->widget($form['search'], [
                    'attr' => [
                        'class' => 'search'
                        ] 
                    ]) ?>
                <?= $this->form()->widget($form['type'], [
                    'attr' => [
                        'class' => 'buttonsearch btn btn-info btn-lg'
                    ]
                ]) ?>
                <?= $this->form()->widget($form['_target_path']) ?>
                <?= $this->form()->widget($form['_submit'], [
                    'attr' => [
                        'class' => 'buttonsearch btn btn-info btn-lg'
                    ]
                ]) ?>
                <?= $this->form()->end($form); ?>
</div>