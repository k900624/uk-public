<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\Models\MenuGroup;
use App\Models\Page;

class Menu extends Model
{
    protected $fillable = [
        'id',
        'parent_id',
        'group_id',
        'type',
        'title',
        'link',
        'icon',
        'published',
        'ordering',
    ];

    public $timestamps = false;

    public function group()
    {
        return $this->belongsTo(MenuGroup::class, 'group_id');
    }
    
    /*public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }*/

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }

    public function url()
    {
        switch ($this->type) {
            case 'external_link':
                return $this->link;
                break;

            case 'internal_link':
                return is_null($this->link)
                    ? '#'
                    : url((App::getLocale() != config('locale.default_lang'))
                        ? App::getLocale() . $this->link
                        : $this->link
                    );
                break;

            default: // page_link
                if ($this->page) {
                    return url((App::getLocale() != config('locale.default_lang'))
                        ? App::getLocale() .'/page/'. $this->page->alias
                        : '/page/'. $this->page->alias
                    );
                }
                break;
        }
    }

    public static function getMenu($group)
    {
        $result = self::whereHas('group', function($query) use ($group) {
            $query->where([
                'menu_groups.name' => $group,
                'menus.published' => '1'
            ]);
        })
        ->orderBy('menus.ordering')
        ->get();
        
        return self::buildTree($result);
    }
    
    /**
     * Функция рекурсии
     * 
     */
    protected static function buildTree($arr, $pid = 0) {
        // Находим всех детей раздела
        $found = $arr->filter(function($item) use ($pid) {
            return $item->parent_id == $pid;
        });

        // Каждому ребенку запускаем поиск его детей
        foreach ($found as $key => $cat) {
            $children = self::buildTree($arr, $cat->id);
            $cat->children = $children;
        }

        return $found;
    }

}
