<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Sitecontent */

$this->title = $model->filename_user;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sitecontent-view">

    <div class="row">
        <div class="row-lg-12">
            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <input action="action" type="button" class="btn btn-primary" value="<?= Yii::t('files', 'Back'); ?>"
                       onclick="history.go(-1);"/>

                <?= $model->downloadLink(); ?>

                <?= Html::a(Yii::t('files', 'Remove file'), ['/files/file/delete', 'id' => $model->id],
                    ['class' => 'btn btn-danger', 'data-confirm' => 'Are you sure?']);

                ?>
            </p>
            <?php

            echo DetailView::widget([
                'model' => $model,
                'attributes' => [
                    ['label' => 'Target',
                        'value' => function ($data) {
                            if ($data->target) {
                                $identifierAttribute = 'id';

                                if (method_exists($data->target, 'identifierAttribute'))
                                    $identifierAttribute = $data->target->identifierAttribute();

                                return Html::a($data->target->$identifierAttribute, $data->target_url);
                            }
                        }
                    ],
                    'created_at',
                    'updated_at',
                    'created_by',
                    'updated_by',
                    'owner.username',
                    'filename_user',
                    [
                        'attribute' => 'model',
                        'visible' => Yii::$app->user->can('admin'),
                    ],
                    [
                        'attribute' => 'filename_path',
                        'visible' => Yii::$app->user->can('admin'),
                    ],
                    'status',
                    'mimetype',
                    [
                        'format' => 'html',
                        'attribute' => 'target_url',
                        'value' => Html::a($model->target_url, $model->target_url)
                    ]
                ]
            ]);
            ?>
        </div>
    </div>
</div>