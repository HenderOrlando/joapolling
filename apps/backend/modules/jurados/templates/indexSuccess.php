<h1>Jurados List</h1>

<table>
  <thead>
    <tr>
      <th>Id mesa</th>
      <th>Id tipo</th>
      <th>Id jurado</th>
      <th>Fecha creado</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($jurados as $jurado): ?>
    <tr>
      <td><?php echo $jurado->getIdMesa() ?></td>
      <td><?php echo $jurado->getIdTipo() ?></td>
      <td><a href="<?php echo url_for('jurados/edit?id_jurado='.$jurado->getIdJurado()) ?>"><?php echo $jurado->getIdJurado() ?></a></td>
      <td><?php echo $jurado->getFechaCreado() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('jurados/new') ?>">New</a>
