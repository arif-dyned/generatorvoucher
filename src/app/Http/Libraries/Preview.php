<?php

namespace App\Http\Libraries;


use App\Http\Models\ViewGroupView;
use App\Http\Models\ViewGroupViewTemplate;

class Preview
{

    public static function preview($view_group_id, $mode = '')
    {
        if ($mode == 'template') {
            $view = ViewGroupViewTemplate::where('view_group_id', $view_group_id)->get();
        } else {
            $view = ViewGroupView::where('view_group_id', $view_group_id)->get();
        }
        $attr = [];
        foreach ($view as $views) {
            foreach ($views->attribute as $attribute) {
                $attr[] = $attribute;
            }
        }

        return $attr;
    }
}