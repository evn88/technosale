<?php

use SleepingOwl\Admin\Navigation\Page;

// Default check access logic
// AdminNavigation::setAccessLogic(function(Page $page) {
// 	   return auth()->user()->isSuperAdmin();
// });
//
// AdminNavigation::addPage(\App\User::class)->setTitle('test')->setPages(function(Page $page) {
// 	  $page
//		  ->addPage()
//	  	  ->setTitle('Dashboard')
//		  ->setUrl(route('admin.dashboard'))
//		  ->setPriority(100);
//
//	  $page->addPage(\App\User::class);
// });
//
// // or
//
// AdminSection::addMenuPage(\App\User::class)

return [
    [
        'title' => 'Назад на сайт',
        'icon'  => 'fa fa-arrow-left',
        'url'   => '/',
    ],

    [
        'title' => 'Отчет по компьютерам',
        'icon'  => 'fa fa-file-text-o',
        'url'   => '/computer/total',
    ],

    [
        'title' => 'Отчет по оргтехнике',
        'icon'  => 'fa fa-file-text-o',
        'url'   => '/orgtech/total',
    ],

    [
        'title' => 'Компьютеры',
        'icon'  => 'fa fa-desktop',
        // 'url'   => route('admin.information'),
        'model'    => \App\Article_pc::class
    ],

    [
        'title' => 'Оргтехника',
        'icon'  => 'fa fa-print',
        // 'url'   => route('admin.information'),
        'model'    => \App\Article_orgtech::class
    ],

    [
        'title' => 'Заявки на компьютеры',
        'icon'  => 'fa fa-desktop',
        // 'url'   => route('admin.information'),
        'model'    => \App\Rate_pc::class
    ],

    [
        'title' => 'Заявки на оргтехнику',
        'icon'  => 'fa fa-print',
        // 'url'   => route('admin.information'),
        'model'    => \App\Rate_orgtech::class
    ],

    [
        'title' => 'Система',
        'pages' => [
            (new Page(\App\User::class)),
            (new Page(\App\Config::class)),
        ],
        'icon'  => 'fa fa-cogs',
        'priority' => 99998,
    ],

    
 
];