<?php

namespace App\Repositories;

abstract class CoreRepository
{
    protected $model;

    function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * @return mixed
     */
    abstract protected function getModelClass();

    /**
     * @return \Illuminate\Contracts\Foundation\Application|mixed
     */
    protected function startConditions()
    {
        return clone $this->model;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getId($id)
    {
        return $this->startConditions()->find($id);
    }
    
    /**
     * @return mixed
     */
    public function all($columns = array('*'), $orderBy = 'id', $sortBy = 'asc')
    {
        return $this->startConditions()->orderBy($orderBy, $sortBy)->get($columns);
    }
    
    /**
     * @param $id
     * @return mixed
     */
    public function findBy($data)
    {
        return $this->startConditions()->where($data)->get();
    }
    
    /**
     * @param $id
     * @return mixed
     */
    public function findOneBy($data)
    {
        return $this->startConditions()->where($data)->first();
    }
    
    /**
     * @return mixed
     */
    public function paginate($perPage = 20, $columns = array('*'), $orderBy = 'id', $sortBy = 'asc')
    {
        return $this->startConditions()
                ->select($columns)
                ->orderBy($orderBy, $sortBy)
                ->paginate($perPage);
    }
    
    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->startConditions()->count();
    }
    
    /**
     * @return mixed
     */
    public function exists($id)
    {
        return $this->startConditions()
            ->where('id', $id)
            ->exists();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function existsOneBy($data)
    {
        return $this->startConditions()->where($data)->exists();
    }
    
    /**
     * Функция рекурсии
     * 
     */
    protected function buildTree($arr, $pid = 0) {
        // Находим всех детей раздела
        $found = $arr->filter(function($item) use ($pid) {
            return $item->parent_id == $pid;
        });

        // Каждому ребенку запускаем поиск его детей
        foreach ($found as $key => $cat) {
            $children = $this->buildTree($arr, $cat->id);
            $cat->children = $children;
        }

        return $found;
    }
    
    /**
     * Update one or something fields
     */
    public function changeFields($id, $fields = [])
    {
        $item = $this->getId($id);

        if ( ! $item) {
            abort(404);
        }
        
        foreach ($fields as $key => $value) {
            $item->{$key} = $value;
        }
        return $item->update();
    }
    
    /**
     * Пример, как можно подгружать связанные таблицы
     * с инициализацией один раз
     */
    public function test()
    {
        return $this->startConditions($id)
            ->select('id', 'title', 'alias')
            ->where('id', $id)
            // ->with(['category', 'user'])
            ->with([
                // можно так
                'category' => function($query) {
                    $query->select(['id', 'title']);
                },
                // или так
                'iser:id,name'
            ])
            ->paginate(25);
    }

}