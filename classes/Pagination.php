<?php 
namespace Classes;
class Pagination {
  public $current_page;
  public $page_records;
  public $total_records;

  public function __construct($current_page = 1, $page_records = 10, $total_records = 0)
  {
    $this->current_page = (int) $current_page;
    $this->page_records = (int) $page_records;
    $this->total_records = (int) $total_records;
  }

  public function offset() {
    return $this->page_records * ($this->current_page -1);
  }

  public function total_pages() {
    return ceil($this->total_records / $this->page_records);
  }

  public function prev_page() {
    $prev = $this->current_page - 1;
    return ($prev > 0) ? $prev : false;
  }
  
  public function next_page() {
    $next = $this->current_page + 1;
    return ($next <= $this->total_pages()) ? $next : false;
  }
}
?>