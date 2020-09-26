<?php

    // Home
    Breadcrumbs::register('home', function ($breadcrumbs) {
        $breadcrumbs->push('Главная', route('home'));
    });


    // Pages
    Breadcrumbs::register('page', function ($breadcrumbs, $page) {
        $breadcrumbs->parent('home');
        $breadcrumbs->push($page->title, route('page.show', [
            'name' => $page->alias
        ]));
    });

    Breadcrumbs::register('contacts', function ($breadcrumbs) {
        $breadcrumbs->parent('home');
        $breadcrumbs->push('Контакты', route('page.contacts'));
    });


    // FAQ
    Breadcrumbs::register('faq', function ($breadcrumbs) {
        $breadcrumbs->parent('home');
        $breadcrumbs->push('Вопрос-ответ', route('faq'));
    });


    // Articles
    Breadcrumbs::register('articles', function ($breadcrumbs) {
        $breadcrumbs->parent('home');
        $breadcrumbs->push('Новости', route('articles'));
    });

    Breadcrumbs::register('articlesCategoryShow', function ($breadcrumbs, $category) {
        $breadcrumbs->parent('articles');
        $breadcrumbs->push($category->title, route('articles.category.show', [
            'name' => $category->alias
        ]));
    });

    Breadcrumbs::register('articleShow', function ($breadcrumbs, $category, $article) {
        $breadcrumbs->parent('articlesCategoryShow', $category);

        $breadcrumbs->push($article->title, route('article.show', [
            'name' => $article->alias
        ]));
    });
    
    // Search
    Breadcrumbs::register('search', function ($breadcrumbs) {
        $breadcrumbs->parent('home');
        $breadcrumbs->push('Поиск', route('search'));
    });
    
    // Search
    // Breadcrumbs::register('profile', function ($breadcrumbs) {
    //     $breadcrumbs->parent('home');
    //     $breadcrumbs->push('Личный кабинет', route('profile'));
    // });

