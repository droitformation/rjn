<?php namespace Droit\Presenter;

class WpNavi extends \Illuminate\Pagination\Presenter {

    public function getActivePageWrapper($text)
    {
        return '<span class="current">'.$text.'</span>';
    }

    public function getDisabledTextWrapper($text)
    {
        return '<span>'.$text.'</span>';
    }

    public function getPageLinkWrapper($url, $page, $rel = null)
    {
        return '<a href="'.$url.'">'.$page.'</a>';
    }

}