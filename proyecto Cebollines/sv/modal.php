<div id="modal<?= $uuid_modal;?>" class="modal fade" role="dialog"  tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form role="form" method="post" enctype="multipart/form-data">
          <div class="modal-header" style="background:#f8981d; color:white">
            <h4 class="modal-title">Descripción</h4>
          </div>
          <div class="modal-body">
            <div class="box-body">
                <div class="container">
                    <h2><?= $row['nombre_item_sv'];?></h2>
                    <div class="row">
                        <label style="text-align: justify;"><?= $row['descripcion_item_sv'];?></label>
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Listo</button>
          </div>
        </form>
      </div>
    </div>
  </div>
