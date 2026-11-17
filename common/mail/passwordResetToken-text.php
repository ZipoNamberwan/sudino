<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

/*$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);*/
$resetLink = "http://webapps.bps.go.id/jatim/sudino/frontend/web/index.php?r=site/reset-password&token=". $user->password_reset_token;
?>
Hello <?= $user->username ?>,

Follow the link below to reset your password:

<?= $resetLink ?>
