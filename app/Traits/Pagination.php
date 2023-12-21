<?php

namespace App\Traits;

trait Pagination
{
    public function pagination($total, $per_page, $current_page, $last_page)
    {
        if ($total <= $per_page) {
            $pagination = false;
        } else {
            $pagination = true;
        }

        return [
            'pagination' => $pagination,
            'total' => $total,
            'current_page' => $current_page,
            'last_page' => $last_page
        ];
    }
}
