<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-view">
 
    <?= "<?= " ?>DetailView::widget([
        'model' => $model,
        'attributes' => [
<?php
            if (($tableSchema = $generator->getTableSchema()) === false) {
                foreach ($generator->getColumnNames() as $name) {
                    echo "            '" . $name . "',\n";
                }
            } else {
                foreach ($generator->getTableSchema()->columns as $column) {
                    $format = $generator->generateColumnFormat($column);
                    if ($column->name === 'created_at'){
                        echo "\t\t\t[
                'label' => 'Creacion',
                'value' => ".'$model->created_at,'."
                'format' => ['DateTime', 'php:Y-m-d H:i:s']
            ]" . ",\n";
                    } else if ($column->name === 'updated_at'){
                        echo "\t\t\t[
                'label' => 'Actualizacion',
                'value' => ".'$model->updated_at,'."
                'format' => ['DateTime', 'php:Y-m-d H:i:s']
            ]" . ",\n";
                    } else if ($column->name === 'estado'){
                        echo "\t\t\t[
                'label' => 'Estado',
                'value' => (\$model->estado == 1) ? 'Activo' : 'Inactivo',
            ]" . ",\n";
                    } else{
                        if ($column->name != 'id'){
                            echo "            '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                        }
                    }
                }
            }
            ?>
        ],
    ]) ?>

</div>
