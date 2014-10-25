
        <div id="ejemplo" class="container-fluid">
            <div id="reloj"></div>
            <h3>GESTION TIPO DE INSUMO</h3>
            <div id="divbtn">
                <a href="form_insumo.html"><button id="btna" type="button" class="btn btn-primary btn-sm">+ Nuevo</button></a>
            </div>
            
            <table id="tabla" class="table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Fecha de ingreso</th>
                        <th>Fecha de vencimiento</th>
                        <th>Cantidad</th>
                        <th>Tipo de insumo</th>
                        <th>Lote</th>
                        <th>Transportador</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tr>
                    <td>Alimento para machos</td>
                    <td>2014-09-25</td>
                    <td>2014-10-30</td>
                    <td>2500</td>
                    <td>Alimento</td>
                    <td>51</td>
                    <td>Jhonny Diaz</td>
                    <td id="btnaccion">
                        <a href="form_insumos_ver.html" class="btn btn-warning btn-xs"><i class="fa fa-eye" title="VISTA COMPLETA"></i></a>-
                        <a href="form_insumo_editar.html" class="btn btn-info btn-xs"><i class="fa fa-edit" title="EDITAR"></i></a>-
                        <a href="" class="btn btn-danger btn-xs" onclick="eliminar();"><i class="fa fa-trash" title="ELIMINAR"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </table>
            
            <select id="pagina">
                <option value="1">1</option>
                <option value="1">2</option>
                <option value="1">3</option>
                <option value="1">4</option>
                <option value="1">5</option>
            </select>de 5
        </div>
