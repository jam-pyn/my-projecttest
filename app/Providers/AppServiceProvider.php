<?php

namespace App\Providers;


use Illuminate\Database\Eloquent\Builder;

// use Illuminate\Database\Query\Builder;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        //
    }
    public function boot(): void
    {
        //
        Builder::macro('search', function ($fields, $string, $mode = 'contains', $condition = 'or') {
            $query = $this;

            if (empty($string)) {
                return $query;
            }

            $query->where(function ($q) use ($fields, $string, $mode, $condition) {
                foreach ($fields as $field) {
                    // ตรวจสอบว่า field เป็นความสัมพันธ์ (มี .) เช่น category.name
                    if (Str::contains($field, '.')) {
                        [$relation, $column] = explode('.', $field);
                        $q->orWhereHas($relation, function ($subQuery) use ($column, $string, $mode) {
                            switch ($mode) {
                                case 'contains':
                                    $subQuery->where($column, 'like', "%$string%");
                                    break;
                                case 'exact':
                                    $subQuery->where($column, '=', $string);
                                    break;
                            }
                        });
                    } else {
                        switch ($mode) {
                            case 'contains':
                                $condition === 'or'
                                    ? $q->orWhere($field, 'like', "%$string%")
                                    : $q->where($field, 'like', "%$string%");
                                break;
                            case 'exact':
                                $condition === 'or'
                                    ? $q->orWhere($field, '=', $string)
                                    : $q->where($field, '=', $string);
                                break;
                        }
                    }
                }
            });

            return $query;
        });
    }
}
