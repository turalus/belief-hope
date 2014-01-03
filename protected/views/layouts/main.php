<?
$controllerName = Yii::app()->controller->id;
$actionName = Yii::app()->controller->action->id;
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link href="/min/?g=<?= $controllerName ?>_<?= $actionName ?>_css" rel="stylesheet">
    <?
    if (!isset($_SESSION)) {
        session_start();
        if (!isset($_SESSION["introShown"])) {
            echo "<link href='/assets/intro.css'  rel='stylesheet'>";
            $_SESSION["introShown"] = true;
        }

    }
    ?>
    <title>Belief & Hope</title>
</head>
<body>


<?
if (!isset($_SESSION)) {
    session_start();
    if (!isset($_SESSION["introShown"])) {
        ?>
        <div id="fade">
            <div class="clouds"></div>
            <img src="/assets/img/logo-larg.png"/>
        </div>
    <?
    }
}
?>



<div id="wrap">
    <div id="head-con">
        <div id="header">
            <div id="logo">
                <a href="/"><img src="/assets/img/logo.png" alt=""></a>
                <?
                $this->widget('application.widgets.LanguageSelector');
                ?>
            </div>

            <?
            $this->widget('application.widgets.Navigation');
            ?>

            <div class="clear"></div>
        </div>
    </div>
    <?= $content ?>
    <div class="push"></div>
</div>

<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=turalaliyev"></script>
<script type="text/javascript">
    addthis.layers({
        'theme': 'transparent',
        'share': {
            'position': 'left',
            'numPreferredServices': 5
        },
        'follow': {
            'services': [
                {'service': 'twitter', 'id': 'belief_and_hope'},
                {'service': 'youtube', 'id': 'beliefandhopedotcom'}
            ]
        },
        'whatsnext': {},
        'recommended': {}
    });
</script>

<div id="footer">
    <div id="ftlogo"></div>
    <p>
        <i class="fa fa-facebook-square"></i>
        <i class="fa fa-envelope-o"></i>
        <i class="fa fa-youtube-square"></i>
    </p>

    <p>All Rights Reserved &copy; 2013</p>
</div>


<script src="/min/?g=<?= $controllerName ?>_<?= $actionName ?>_js"></script>
<?
if (!isset($_SESSION)) {
    session_start();
    if (!isset($_SESSION["introShown"])) {
        echo "<script src='/assets/js/intro.js'></script>";
        $_SESSION["introShown"] = true;
    }

}
?>
</body>
</html>



