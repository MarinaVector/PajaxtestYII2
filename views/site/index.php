<?php

/* @var $this yii\web\View */

use kartik\select2\Select2;
use kartik\daterange\DateRangePicker;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use common\components\Modal;
use yii\widgets\Pjax;
use yii\helpers\Html;

$this->title = 'My Yii Application';

?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-12">
                <?php Pjax::begin(); ?>


                <div class="dropdown">
                    <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?= $name ?>
                    </a>

                    <div class="dropdown-menu bg-white" aria-labelledby="dropdownMenuLink">
                        <?= Html::a(
                            'Неделя',
                            ['action' => 'week'],
                            ['class' => 'dropdown-item']
                        ) ?>
                        <?= Html::a(
                            '2 недели',
                            ['action' => 'weeks2'],
                            ['class' => 'dropdown-item']
                        ) ?>
                        <?= Html::a(
                            'Месяц',
                            ['action' => 'month'],
                            ['class' => 'dropdown-item']
                        ) ?>
                        <?= Html::a(
                            '2 месяца',
                            ['action' => 'months2'],
                            ['class' => 'dropdown-item']
                        ) ?>
                    </div>
                </div>
                <?php

                echo '<div class="col-md-3 col-lg-3">';



                echo '<div class="col-md-3 px-0">';
                echo '<p class="time-date pt-2">Свой период:</p>';
                echo '</div>';

                echo '<div class="col-md-8 px-0">';
                $addon = <<< HTML
   
                        <div class="input-group-append">
                            <span class="input-group-text ">
                        <i class="fas fa-calendar-alt fa-2x"></i>
                            </span>
                          </div>
HTML;


                echo '<div class="input-group border-0 drp-container">';
                echo DateRangePicker::widget([
                        'name' => 'date_range_1',
                        'value' => $date_before . ' / ' . $today,
                        'convertFormat' => true,
                        'useWithAddon' => true,
                        'pluginOptions' => [
                            'locale' => [
                                'format' => 'Y-m-d',
                                'separator' => ' / ',
                            ],
                            'opens' => 'right'
                        ]
                    ]) . $addon;
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                ?>
    <?php Pjax::end(); ?>

            </div>
            <div class="col-lg-4">

                <p><a class="btn btn-outline-secondary" href="http://www.yiiframework.com/extensions/">Yii Extensions
                        &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
