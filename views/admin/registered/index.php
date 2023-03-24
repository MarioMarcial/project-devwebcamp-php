<h2 class="dashboard__heading"><?php echo $title; ?></h2>
<div class="dashboard__container">
  <?php if(!empty($registrations)) { ?>
    <table class="table">
      <thead class="table__head">
        <tr class="table__tr">
          <th scope="col" class="table__th">Nombre</th>
          <th scope="col" class="table__th">Email</th>
          <th scope="col" class="table__th">Plan</th>
        </tr>
      </thead>
      <tbody class="table__tbody">
        <?php foreach ($registrations as $registration) { ?>
          <tr class="table__tr">
            <td class="table__td">
                <?php echo $registration->user->name . " " . $registration->user->lastname;?>
            </td>
            <td class="table__td">
              <?php echo $registration->user->email;?>
            </td>
            <td class="table__td">
              <?php echo $registration->pack->name;?>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php } else { ?>
    <p class="text-center">No hay Registros Aún</p>
  <?php } ?>
</div>
<?php
  echo $pagination;
?>