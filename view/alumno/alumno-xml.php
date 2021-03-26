<h1 class="page-header">
    Cursos XML
</h1>

<div class="container">
	<table class="table table-striped">
		<thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
        </tr>
    	</thead>
    	<tbody>
			<?php foreach($this->cursosXML->curso as $curso): ?>
			<tr>
            	<td><?php echo $curso->id; ?></td>
            	<td><?php echo $curso->nombre; ?></td>
            </tr>
           	<?php endforeach; ?>
		</tbody>
	</table>
</div>
