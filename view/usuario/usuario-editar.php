<h1 class="page-header">
    <?php echo $usu->getId() != null ? $usu->getNombre() : 'Nuevo Registro'; ?>
</h1>

<ol class="breadcrumb">
  <li><a href="?c=Usuario">Usuarios</a></li>
  <li class="active"><?php echo $usu->getId() != null ? $usu->getNombre() : 'Nuevo Registro'; ?></li>
</ol>

<form id="frm-usuario" action="?c=Usuario&a=Guardar" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $usu->getId(); ?>" />
    
    <div class="form-group">
        <label>Nombre</label>
        <input type="text" name="Nombre" value="<?php echo $usu->getNombre(); ?>" class="form-control" placeholder="Ingrese su nombre" data-validacion-tipo="requerido|min:3" />
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="Password" value="" class="form-control" placeholder="Ingrese su password" data-validacion-tipo="requerido|min:6" />
    </div>
    
    <hr />
    
    <div class="text-right">
        <button class="btn btn-success">Guardar</button>
    </div>
</form>

<script>
    $(document).ready(function(){
        $("#frm-usuario").submit(function(){
            return $(this).validate();
        });
    })
</script>