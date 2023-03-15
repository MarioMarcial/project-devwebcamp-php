<?php 
namespace Classes;
class Pagination {
  public $current_page;
  public $records_per_page;
  public $total_records;

  public function __construct($current_page = 1, $records_per_page = 10, $total_records = 0)
  {
    $this->current_page = (int) $current_page;
    $this->records_per_page = (int) $records_per_page;
    $this->total_records = (int) $total_records;
  }

  public function offset() {
    return $this->records_per_page * ($this->current_page - 1);
  }

  public function total_pages() {
    return ceil($this->total_records / $this->records_per_page);
  }

  public function prev_page() {
    $prev = $this->current_page - 1;
    return ($prev > 0) ? $prev : false;
  }

  public function next_page() {
    $next = $this->current_page + 1;
    return ($next <= $this->total_pages()) ? $next : false;
  }

  public function prev_link() {
    $html = '';
    if($this->prev_page()) {
      $html .= "<a class=\"pagination__link pagination__link--text\" href=\"?page={$this->prev_page()}\">&laquo; Anterior</a>";
    }
    return $html;
  }

  public function next_link() {
    $html = '';
    if($this->next_page()) {
      $html .= "<a class=\"pagination__link pagination__link--text\" href=\"?page={$this->next_page()}\">Siguiente &raquo;</a>";
    }
    return $html;
  }

  public function page_numbers() {
    $html = '';
    for($i = 1; $i <= $this->total_pages(); $i++) {
      if($i === $this->current_page) {
        $html .= "<span class=\"pagination__link pagination__link--current\">{$i}</span>";
      } else {
        $html .= "<a class=\"pagination__link pagination__link--number\" href=\"/admin/ponentes?page={$i}\">{$i}</a>";
      }
      
    }

    return $html;
  }

  public function pagination() {
    $html = '';
    if($this->total_records > $this->records_per_page) {
      $html .= '<div class="pagination">';
      $html .= $this->prev_link();
      $html .= $this->page_numbers();
      $html .= $this->next_link();

      $html .= '</div>';
    }
    return $html;
  }
}
?>