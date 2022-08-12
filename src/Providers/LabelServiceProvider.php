<?php

namespace Hafijul233\Form\Providers;

use Hafijul233\Form\Facades\Form;
use Hafijul233\Form\Facades\Html;
use Illuminate\Support\ServiceProvider;

/**
 * Class LabelServiceProvider
 */
class LabelServiceProvider extends ServiceProvider
{
    /**
     * Loading All Label Style
     */
    public function boot()
    {
        Form::macro('hLabel', function ($name, $value, $required = false, $col_size = 2, $options = []) {
            return Form::label($name, $value, $required, array_merge(['class' => "col-md-$col_size col-form-label"], $options), false);
        });

        Form::macro('fLabel', function ($name, $value, $required = false, $options = []) {
            return str_replace('label', 'span', Form::label($name, $value, $required, $options, false));
        });

        Form::macro('nCancel', function ($title, $options = []) {
            $attributes = array_merge($options, ['class' => 'btn btn-danger fw-bold']);

            return Html::link('<i class="mdi mdi-close-outline fw-bolder"></i>&nbsp;&nbsp;' . $title, $attributes, null, false);
        });
    }
}
