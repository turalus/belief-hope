<div class="context">
    <div class="con-left">
        <h1><?= $title ?></h1>
    </div>
    <div class="clear"></div>

    <div class="con-date-cat">
        <p><i class="fa fa-calendar"></i><?= $timestamp ?></p>

        <?
        if (isset($category))
            echo "<h5>
                    <i class='fa fa-bookmark'></i>
                    <span>" . Yii::t('common', 'category') . ": " . $category . "</span>
                   </h5>";
        ?>
    </div>
    <br class="clear"/>

    <div class="ReadableText">

        <?
        if (isset($imgUrl))
            echo "<img src='$imgUrl' alt=''/>";
        echo $content;
        ?>
    </div>
    <div class="clear"></div>
</div>

<?
if (isset($videoHtml))
    echo "<h1>Videolar</h1>" . $videoHtml;

?>

<?
if (isset($galleryHtml))
    echo "<h1>Fotolar</h1>" . $galleryHtml;

?>

