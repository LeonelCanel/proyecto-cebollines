  <!-- Modal -->
<div class="modal fade" id="modal<?= $uuid_modal;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><b>ORDEN DE <?= $row['nombre_seccion'];?></b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" >
            <div class="container">
                <div class="row">
                    <div class="col">
                        <label>Número de ordenamiento</label>
                        <input type="text" class="form-control" id="orden" name="orden" placeholder="Ejemplo: 5" maxlength="2" value="<?= $row['posicionamiento'];?>" onKeyPress="return soloNumeros(event)" > 
                    </div>
                </div>
            </div>
            <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <input type="submit" class="btn btn-primary" name="registrarPosicion" value="Guardar">
        
      </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
// Solo permite ingresar numeros.
function soloNumeros(e){
	var key = window.Event ? e.which : e.keyCode
	return (key >= 48 && key <= 57)
}
</script>



