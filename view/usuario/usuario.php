<h1 class="page-header">Usuarios</h1>

<div class="well well-sm text-right">
    <a class="btn btn-primary" href="?c=Usuario&a=Crud">Nuevo Usuario</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th style="width:180px;">Id</th>
            <th>Nombre</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($this->model->Listar() as $r): ?>
        <tr>
            <td><?php echo $r->getId(); ?></td>
            <td><?php echo $r->getNombre(); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table> 
