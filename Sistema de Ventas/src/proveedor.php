<?php include_once "includes/header.php";
include "../conexion.php";
$id_user = $_SESSION['idUser'];
$permiso = "proveedor";
$sql = mysqli_query($conexion, "SELECT p.*, d.* FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_user AND p.nombre = '$permiso'");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header("Location: permisos.php");
}
if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['direccion'])) {
        $alert = '<div class="alert alert-danger" role="alert">
                                    Todo los campos son obligatorio
                                </div>';
    } else {
        $cuil = $_POST['cuil'];
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];

        $result = 0;
        $query = mysqli_query($conexion, "SELECT * FROM proveedor WHERE cuil = $cuil");
        $result = mysqli_fetch_array($query);
        if ($result > 0) {
            $alert = '<div class="alert alert-danger" role="alert">
                                    El proveedor ya existe
                                </div>';
        } else {
            $query_insert = mysqli_query($conexion, "INSERT INTO proveedor(cuil,nombre,direccion,telefono,email) values ($cuil,'$nombre', '$direccion',$telefono, '$email')");
            if ($query_insert) {
                $alert = '<div class="alert alert-success" role="alert">
                                    Proveedor registrado
                                </div>';
            } else {
                $alert = '<div class="alert alert-danger" role="alert">
                                    Error al registrar
                            </div>';
            }
        }
    }
    mysqli_close($conexion);
}
?>
<button class="btn btn-primary mb-2" type="button" data-toggle="modal" data-target="#nuevo_proveedor"><i class="fas fa-plus"></i></button>
<?php echo isset($alert) ? $alert : ''; ?>
<div class="table-responsive">
    <table class="table table-striped table-bordered" id="tbl">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>CUIL</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
            include "../conexion.php";
            $query = mysqli_query($conexion, "SELECT * FROM proveedor");
            $result = mysqli_num_rows($query);
            if ($result > 0) {
                while ($data = mysqli_fetch_assoc($query)) {

           ?>
           
                <tr>
                    <td><?php echo $data['idproveedor']; ?></td>
                    <td><?php echo $data['cuil']; ?></td>
                    <td><?php echo $data['nombre']; ?></td>
                    <td><?php echo $data['direccion']; ?></td>
                    <td><?php echo $data['telefono']; ?></td>
                    <td><?php echo $data['email']; ?></td>
                    <td>
                    
                        <a href="editar_cliente.php?id=<?php echo $data['idcliente']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
                        <form action="eliminar_cliente.php?id=<?php echo $data['idcliente']; ?>" method="post" class="confirmar d-inline">
                            <button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i> </button>
                        </form>

                    </td>
                </tr>
            <?php }
            } ?>
        </tbody>

    </table>
</div>
<div id="nuevo_proveedor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="my-modal-title">Nuevo Proveedor</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" autocomplete="off">
                    <div class="form-group">
                            <label for="nombre">CUIL</label>
                            <input type="number" placeholder="Ingrese CUIL" name="cuil" id="cuil" class="form-control">
                        </div>    
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" placeholder="Ingrese Nombre" name="nombre" id="nombre" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Dirección</label>
                        <input type="text" placeholder="Ingrese dirección" name="direccion" id="direccion" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="number" placeholder="Ingrese Teléfono" name="telefono" id="telefono" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="direccion">Email</label>
                        <input type="text" placeholder="Ingrese Email" name="email" id="email" class="form-control">
                    </div>
                    <input type="submit" value="Guardar Proveedor" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>
<?php include_once "includes/footer.php"; ?>