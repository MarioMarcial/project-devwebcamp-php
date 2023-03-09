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
}
?>