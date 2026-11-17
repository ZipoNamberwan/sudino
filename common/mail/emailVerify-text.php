<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

/*$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verify-email', 'token' => $user->verification_token]);*/
$verifyLink = "http://webapps.bps.go.id/jatim/sudino/frontend/web/index.php?r=site/verify-email&token=". $user->verification_token;
?>
Hello <?= $user->username ?>,

Follow the link below to verify your email:

<?= $verifyLink ?>
