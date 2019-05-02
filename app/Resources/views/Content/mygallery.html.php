<?php
/** @var \Pimcore\Templating\PhpEngine $this */
?>
<?php if ($this->assets): ?>
    <div class="my-gallery">
        <?php
        foreach ($this->assets as $asset):
            if ($asset instanceof Pimcore\Model\Asset\Image):
                /** @var Pimcore\Model\Asset\Image $asset */
                ?>
                <div class="gallery-row">
                    <?= $asset->getThumbnail('galleryThumbnail')->getHTML(); ?>
                </div>
                <?php
            endif;
        endforeach; ?>
    </div>
<?php endif; ?>