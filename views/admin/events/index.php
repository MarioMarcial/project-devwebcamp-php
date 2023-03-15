<h2 class="dashboard__heading"><?php echo $title; ?></h2>
<div class="dashboard__container-button">
  <a class="dashboard__button" href="/admin/eventos/crear">
    <i class="fa-solid fa-circle-plus"></i>
    Añadir Evento
  </a>
</div>
<div class="dashboard__container">
  <?php if(!empty($events)) { ?>
    <table class="table">
      <thead class="table__head">
        <tr class="table__tr">
          <th scope="col" class="table__th">Evento</th>
          <th scope="col" class="table__th">Categoría</th>
          <th scope="col" class="table__th">Día y Hora</th>
          <th scope="col" class="table__th">Ponente</th>
          <th scope="col" class="table__th"></th>
        </tr>
      </thead>
      <tbody class="table__tbody">
        <?php foreach ($events as $event) { ?>
          <tr class="table__tr">
            <td class="table__td">
              <?php echo $event->name?>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php } else { ?>
    <p class="text-center">No hay Ponentes Aún</p>
  <?php } ?>
</div>
<?php
  echo $pagination;
?>