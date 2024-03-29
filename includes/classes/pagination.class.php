<?php

class Pagination {

    public $current_page;
    public $per_page;
    public $total_count;

    public function __construct($current_page=1, $per_page=16, $total_count=0)
    {
        $this->current_page = (int) $current_page;
        $this->per_page = (int) $per_page;
        $this->total_count = (int) $total_count;
    }

    public function offset() : int
    {
        return $this->per_page * ($this->current_page - 1);
    }

    public function total_pages()
    {
        return ceil($this->total_count / $this->per_page);
    }

    public function previous_page() 
    {
        $prev = $this->current_page - 1;
        return ($prev > 0) ? $prev : false;
    }

    public function next_page() 
    {
        $next = $this->current_page + 1;
        return ($next <= $this->total_pages()) ? $next : false;
    }
}
