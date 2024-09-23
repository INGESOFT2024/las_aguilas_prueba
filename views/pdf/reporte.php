<h1>Reporte desde la vista</h1>

<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Nombre del Empleado</th>
            <th>Puesto Asignado</th>
            <th>Fecha de Inicio</th>
            <th>Fecha de Fin</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($resultado as $key => $turnos): ?>
            <tr>
                <td><?= $key + 1 ?></td>
                <td><?= $turnos['turno_empleado'] ?></td>
                <td><?= $turnos['turno_puesto'] ?></td>
                <td><?= $turnos['turno_fecha_inicio'] ?></td>
                <td><?= $turnos['turno_fecha_fin'] ?></td>
            </tr>
        <?php endforeach ?>    
    </tbody>
</table>

<script>
    console.log(turnos)
</script>