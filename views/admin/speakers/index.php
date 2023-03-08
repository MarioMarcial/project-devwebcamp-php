<h2 class="dashboard__heading"><?php echo $title; ?></h2>
<div class="dashboard__container-button">
  <a class="dashboard__button" href="/admin/ponentes/crear">
    <i class="fa-solid fa-circle-plus"></i>
    Añadir Ponente
  </a>
</div>
<div class="dashboard__container">
  <?php if(!empty($speakers)) { ?>
    <table class="table">
      <thead>
        <tr>
          <th scope="col" class="table__th">Nombre</th>
          <th scope="col" class="table__th">Ubicación</th>
          <th scope="col" class="table__th"></th>
        </tr>
      </thead>
      <tbody class="table__tbody">
        <?php foreach ($speakers as $speaker) { ?>
          <tr class="table__tr">
            <td class="table__td">
              <?php echo $speaker->name . " " . $speaker->lastname;?>
            </td>
            <td class="table__td">
              <?php echo $speaker->city . ", " . $speaker->country;?>
            </td>
            <td class="table__td--actions">
              <a href="/admin/ponentes/editar?id=<?php echo $speaker->id; ?>">
                <i class="fa-solid fa-user-pen"></i>
                Editar
              </a>
              <form class="table__form" method="POST">
                <button type="submit">
                  <i class="fa-solid fa-circle-xmark"></i>
                  Eliminar
                </button>
              </form>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php } else { ?>
    <p class="text-center">No hay Ponentes Aún</p>
  <?php } ?>
</div>