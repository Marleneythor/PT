<!DOCTYPE html>
<html lang="en">

<div class="modal fade" id="modalFormulario" tabindex="-1" aria-labelledby="modalFormularioLabel" aria-hidden="true">
    <div class="modal-dialog"> 
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFormularioLabel">Agregar Requisito</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../includes/upload.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="opciones">Selecciona una opción:</label>
                        <select id="opciones" name="opciones" class="form-control" onchange="mostrarDescripcion()" required>
                            <option value="0">Seleccione un Requisito</option>
                            <?php for ($i = 1; $i <= 14; $i++): ?>
                                <option value="<?php echo $i; ?>">Requisito <?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <div id="botonCrearDocumento" style="display: none;">
                        <button type="button" class="btn btn-secondary" onclick="crearDocumento()">Crear documento</button>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Nombre</label>
                        <input type="text" id="descripcion" name="descripcion" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion2" class="form-label">Descripción</label>
            
                        <textarea id="descripcion2" name="descripcion2" class="form-control" rows="3" required></textarea>

                    </div>

                    <div class="mb-3">
                        <label for="archivo" class="form-label">Seleccionar archivo (PDF, Word o JPG no mayor a 700 KB):</label>
                        <input type="file" name="archivo[]" id="archivo" accept=".pdf, .doc, .docx, .jpg" class="form-control" multiple required>
                    </div>
                    
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-success m-2" name="registrar">Guardar</button>
                        <button type="button" class="btn btn-primary m-2" onclick="limpiarFormulario()">Limpiar</button>
                        <button type="button" class="btn btn-danger m-2" data-bs-dismiss="modal">Cancelar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
</html>