<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');

/** @var \Symfony\Component\Form\FormView $form */
$form = $this->form;
?>

<div class="row">
    <div class="col-md-6 col-md-push-3">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <?= $this->translate('Please ask a question') ?>
                </h3>
            </div>

            <div class="panel-body">

                <?php if ($this->error): ?>
                    <div class="alert alert-danger"><?php echo $this->error->getMessage() ?></div>
                <?php endif ?>

          

                <?php
                $this->form()->setTheme($form, ':Form/login');
                ?>

                <?= $this->form()->start($form); ?>
				<?= $this->form()->row($form['category']) ?>
                <?= $this->form()->row($form['type']) ?>
                <?= $this->form()->row($form['title']) ?>
                <?= $this->form()->row($form['blurb']) ?>
				<?= $this->form()->row($form['content']) ?>
				<?= $this->form()->row($form['attachment']) ?>
				<?= $this->form()->widget($form['_target_path']) ?>
                <?= $this->form()->widget($form['_submit'], [
                    'attr' => [
                        'class' => 'btn btn-primary pull-right'
                    ]
                ]) ?>
                <?= $this->form()->end($form); ?>
                <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'ask_form_content');
            </script>
            </div>
        </div>
    </div>
</div>
