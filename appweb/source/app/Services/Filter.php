<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class Filter{

    const ASC = 'asc';
    const DESC = 'desc';

    private $orderByArray = [];
    private $model;
    private $builder = null;
    private $tableName = "";

    public function with($model, $with = []){
        $this->setModel($model);
        $this->builder = !empty($with)? $this->model::query()->with($with) : $this->model::query();
        return $this;
    }
    
    public function where($relationship, $property, $comparator, $value){
        if ($this->getTableName() === $relationship)
            if (gettype($value) === 'array')
                $this->builder = $this->builder->whereBetween($property, $value);
                
            else
                $this->builder = $this->builder->where($property, $comparator, $value);
        
        //* External relationship query...
        else
            $this->builder = $this->builder->whereHas(
                $relationship, 
                function($query) use ($relationship, $property, $comparator, $value){
                    if (gettype($value) === 'array')
                        $query->whereBetween($property, $value);
                    
                    else
                        /**
                         * ! Hotfix for SQL Exception 1052:
                         * !    Integrity constraint violation. 
                         * !    Column name is ambiguous 
                         */
                        $query->where("{$this->model->$relationship()->getRelated()->getTable()}.$property", $comparator, $value);
                    
                }
            );
    
        return $this;
	}
	
    public function in($relationship, $foreign = null, $local = null, $comparator = "="){
        $this->builder = $this->builder->whereIn($this->model->getKeyName(), function ($query) use ($relationship, $local, $foreign, $comparator) {
			$query->select($foreign ? : $this->model->getForeignKey())
				  ->from((new $relationship)->getTable())
				  ->where($foreign ? : $this->model->getForeignKey(), $comparator, $local ? : $this->model->getKeyName());
		});
        return $this;
    }
	
    public function notIn($relationship, $foreign = null, $local = null, $comparator = "<>"){
        $this->builder = $this->builder->whereNotIn($this->model->getKeyName(), function ($query) use ($relationship, $local, $foreign, $comparator) {
			$query->select($foreign ? : $this->model->getForeignKey())
				  ->from((new $relationship)->getTable())
				  ->where($foreign ? : $this->model->getForeignKey(), $comparator, $local ? : $this->model->getKeyName());
		});
        return $this;
    }

    public function get(){
        if (!empty($this->orderByArray))
            return collect($this->sort(
                $this->orderByArray['relationship'], 
                $this->orderByArray['query'], 
                $this->orderByArray['order'], 
                $this->orderByArray['by']
            ));

        return $this->builder->get();
    }

    public function all(){
        return $this->builder;
    }

    public function options(callable $callback){
        $this->builder = $callback($this->builder) ?: $this->builder;
        return $this;
    }

    public function paginate($items, $perPage = 15, $page = null){
        $arr = [];
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $count = $items->count();
        $items = $items->forPage($page, $perPage);
        $items->each(function($e, $i) use (&$arr){$arr[] = $e;});

        return new LengthAwarePaginator($arr, $count, $perPage, $page);
    }

    /* public function paginate(int $records){
        return $this->builder->paginate($records);
    } */

    public function orderBy($relationship, $by, $order){
        if ($this->getTableName() !== $relationship)
            $this->orderByArray = [
                'by'           => $by,
                'order'        => $order,
                'relationship' => $relationship,
                'query'        => $this->builder->get(),
            ];
            
        else
            return $this->builder = $this->builder->orderBy($by, $order);

        return $this;
    }
    
    private function setModel($model){
        $this->model = new $model;
    }

    private function getTableName(){
        $this->tableName = empty($this->tableName) ? (new $this->model)->getTable() : $this->tableName;
        return $this->tableName;
    }
        
    private function sort($relationship, $query, $order, $by){
        if ($order === self::ASC)
            return $query
            ->sortBy(function($array, $key) use ($relationship, $by){
                return $array[$relationship][$by];
            })->values()->all();

        else if ($order === self::DESC)
            return $query
            ->sortByDesc(function($array, $key) use ($relationship, $by){
                return $array[$relationship][$by];
            })->values()->all();
    }
        
}
    
