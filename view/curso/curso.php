<h1 class="page-header">Cursos</h1>

<div class="well well-sm text-right">
    <a class="btn btn-primary" href="?c=curso&a=Sincronizar">Sincronizar cursos</a>
    <a class="btn btn-primary" href="?c=curso&a=PDF">Obtener PDF</a>
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
