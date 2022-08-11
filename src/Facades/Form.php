<?php

namespace Hafijul233\Form\Facades;

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\HtmlString;

/**
 * Class Form
 *
 * @method static HtmlString model(mixed $model, array $options = [])
 * @method static HtmlString open(array $options = [])
 * @method static HtmlString hidden(string $name, mixed $value = null, array $options = [])
 * @method static HtmlString input(string $type, string $name, mixed $value = null, array $options = [])
 * @method static HtmlString getIdAttribute(string $name, array $attributes)
 * @method static HtmlString getValueAttribute(string $name, string $value = null)
 * @method static HtmlString token()
 * @method static HtmlString close()
 * @method static HtmlString label(string $name, string $value = null, array $options = [], bool $escape_html = true)
 * @method static HtmlString text(string $name, string $value = null, array $options = [])
 * @method static HtmlString password(string $name, array $options = [])
 * @method static HtmlString range(string $name, string $value = null, array $options = [])
 * @method static HtmlString search(string $name, string $value = null, array $options = [])
 * @method static HtmlString email(string $name, string $value = null, array $options = [])
 * @method static HtmlString tel(string $name, string $value = null, array $options = [])
 * @method static HtmlString url(string $name, string $value = null, array $options = [])
 * @method static HtmlString number(string $name, string $value = null, array $options = [])
 * @method static HtmlString textarea(string $name, string $value = null, array $options = [])
 * @method static HtmlString file(string $name, array $options = [])
 * @method static HtmlString date(string $name, string $value = null, array $options = [])
 * @method static HtmlString datetime(string $name, string $value = null, array $options = [])
 * @method static HtmlString datetimeLocal(string $name, string $value = null, array $options = [])
 * @method static HtmlString time(string $name, string $value = null, array $options = [])
 * @method static HtmlString week(string $name, string $value = null, array $options = [])
 * @method static HtmlString selectRange(string $name, string $begin, string $end, string $selected = null, array $options = [])
 * @method static HtmlString select(string $name, array $list = [], string $selected = null, array $selectAttributes = [], array $optionsAttributes = [], array $optgroupsAttributes = [])
 * @method static HtmlString selectYear(string $name, string $begin, string $end, string $selected = null, array $options = [])
 *
 * @see \Hafijul233\Form\Builders\FormBuilder
 * @package Hafijul233\Form\Facades
 *
 */
class Form extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'form';
    }
}
