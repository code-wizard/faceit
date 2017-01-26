<?php
	
use yii\helpers\Url;
?>

<style>
	div#wrapper {
	    position: relative;
	    width: 20%;
	    -float: right;
	}
	div#wrapper img{
		display: inline
	}
	img.visualization {
    margin-bottom: 10px;
	    margin-right: 10px;
	}
	.img-rounded {
	    -webkit-border-radius: 6px;
	    -moz-border-radius: 6px;
	    border-radius: 6px;
	}
	img {
	    width: auto\9;
	    height: auto;
	    max-width: 100%;
	    vertical-align: middle;
	    border: 0;
	    -ms-interpolation-mode: bicubic;
	}
</style>
<?php $this->registerJsFile( Url::base().'/js/draw.faces.js',['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<div id="wrapper">

</div>