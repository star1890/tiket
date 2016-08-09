<?php
/**
 * @link http://www.bintang.me/
 * @copyright Copyright (c) 2015 Bintang Pratama
 */

namespace app\components;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\base\Widget;
use yii\helpers\Url;

class SideBar extends \yii\widgets\Menu
{
    public $iconPrefix = 'fa fa-';
    public $indMenuClose = '<span class="fa fa-chevron-down"></span>';
    public $indMenuOpen = '<i class="fa fa-angle-down pull-right"></i>';

    public $items;

    public function init()
    {
        parent::init();
//        $this->topTemplate = '<a>{icon}{label}{arrow}</a>';
        $this->linkTemplate = '<a {url}>{icon}{label}{arrow}</a>';
        $this->submenuTemplate = "\n<ul class='nav child_menu' style='display: none'>\n{items}\n</ul>\n";
        $this->markTopItems();
    }

    protected function markTopItems()
    {       
        $items = [];
        foreach ($this->items as $item) {
            if (empty($item['items'])) {
                $item['top'] = true;
            }
            $items[] = $item;
        }
        $this->items = $items;
    }

    public function run()
    {

        if ($this->route === null && Yii::$app->controller !== null) {
            $this->route = Yii::$app->controller->getRoute();
        }
        if ($this->params === null) {
            $this->params = Yii::$app->request->getQueryParams();
        }

        $items = $this->normalizeItems($this->items, $hasActiveChild);
        $items = $this->normalItems($items);

        if (!empty($items))
        {
            $options = $this->options;
            Html::addCssClass($options, 'nav side-menu');
            $tag = ArrayHelper::remove($options, 'tag', 'ul');  

            if ($tag !== false)
            {
                echo Html::tag($tag, $this->renderItems($items), $options);
            } else {
                echo $this->renderItems($items);
            }
        }
        
    }

    protected function renderItems($items)
    {
        $n = count($items);
        $lines = [];
        foreach ($items as $i => $item)
        {
            $options = array_merge($this->itemOptions, ArrayHelper::getValue($item, 'options', []));
//            Html::addCssClass($options, 'treeview');
            $tag = ArrayHelper::remove($options, 'tag', 'li');

            $class = [];
            if ($item['active']) {
                $class[] = $this->activeCssClass;
            }
            if ($i === 0 && $this->firstItemCssClass !== null) {
                $class[] = $this->firstItemCssClass;
            }
            if ($i === $n - 1 && $this->lastItemCssClass !== null) {
                $class[] = $this->lastItemCssClass;
            }
            if (!empty($class)) {
                if (empty($options['class'])) {
                    $options['class'] = implode(' ', $class);
                } else {
                    $options['class'] .= ' ' . implode(' ', $class);
                }
            }

            $menu = $this->renderItem($item);

            if (!empty($item['items'])) {
                $submenuTemplate = ArrayHelper::getValue($item, 'submenuTemplate', $this->submenuTemplate);
                $menu .= strtr($submenuTemplate, [
                    '{items}' => $this->renderItems($item['items']),
                ]);
            }
            if ($tag === false) {
                $lines[] = $menu;
            } else {
                $lines[] = Html::tag($tag, $menu, $options);
            }
        }

        return implode("\n", $lines);
    }

    protected function renderItem($item)
    {
            $template = ArrayHelper::getValue($item, 'template', $this->linkTemplate);
            $icon = empty($item['icon']) ? '' : '<i class="' . $this->iconPrefix . $item['icon'] . '"></i> &nbsp;';
            $url = Url::to(ArrayHelper::getValue($item, 'url', '#'));
            $options = array_merge($this->itemOptions, ArrayHelper::getValue($item, 'options', []));

            if (empty($item['top'])) {
                if (empty($item['items'])) {
                    $template = str_replace('{arrow}', '', $template);
                } else {
                    $template = str_replace('{arrow}', $this->indMenuClose, $template);
                }
            } else {
                $template = str_replace('{arrow}', '', $template);
            }

            return strtr($template, [
                '{url}' => $url == '#' ? '' : 'href="'.$url.'"',
                '{icon}' => $icon,
                '{label}' => $item['label'],
            ]);
    }

    protected function normalItems($items)
    {
        foreach ($items as $i => $item) {
            if (isset($item['items'])) {

                $items[$i]['items'] = $this->normalItems($item['items']);

                if ($this->activeChild($items[$i]['items'])) {
                    $items[$i]['active'] = true;
                } else {
                    $items[$i]['active'] = false;
                }
            }
        }

        return array_values($items);
    }

    protected function activeChild($items)
    {
        foreach ($items as $i => $item) {
            if (isset($item['active'])) {
                if ($item['active']) {
                    return true;
                }
            }
        }

        return false;
    }
}
