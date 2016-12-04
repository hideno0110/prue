<?php

Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('ホーム', route('home'));
});

Breadcrumbs::register('search', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('検索', route('search'));
});
