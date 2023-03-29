<script>
    const monta = '<?php echo $_POST['monta']; ?>';
    const fecha = '<?php echo $_POST['fecha']; ?>';
    const user = '<?php echo $_POST['usuario']; ?>';
    const turno = '<?php echo $_POST['turno']; ?>';
</script>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Check-list</title>
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../dist/css/styles.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<style type="text/css">
		.screen-block{
	       	position: fixed;
			width: 100%;
			height: 100%;
			top: 0;
			left: 0;
			background: linear-gradient(201.6deg,#02020263, #66666663,#13131375);
			z-index: 1030;
			text-align: center;
			display: block;
			color:white;
			font-size: xx-large;
	      }
      	.progress{
			background-color: #fff;
      	}
	</style>
</head>
<body style="background-color: #f2f2f2;">
	<form id="formCheck" class="mt-4">
		<div class="container border rounded p-3 border-dark" style="width: 95%;">
			<section id="section1" >
                <div class="float-right"><h3> 1/4</h3></div>
				<div class="row">
					<div class="col-sm-12 col-md-7 mt-5">
						<div class="row mb-2"> <!-- CONDICIONES GRAL -->
                            <div class="col-12">
                                <p class="mb-1">Condicion del equipo <small>(golpeado, rayado)</small></p>
                            </div>
                            <div class="col-12">
                                <label>
                                    <input name="CondicionEq" value="ok" required type="radio" onchange="$('#hiddenCondic').fadeOut(function(){$('#CondicionObs').prop('disabled', true)})" />
                                    <span>OK</span>
                                </label>
    
                                <label>
                                    <input name="CondicionEq" value="nok" type="radio" onchange="$('#hiddenCondic').fadeIn(function(){$('#CondicionObs').prop('disabled', false)})" />
                                    <span>Req. Mtto</span>
                                </label>
    
                                <div class="" id="hiddenCondic" hidden style="float: right;">
                                    <input type="text" name="CondicionObs" id="CondicionObs" placeholder="Observación" required disabled>
                                    
                                    <label>
                                        <input type='checkbox' name='CondicionEqSOL'/><span>Solucionado</span>
                                    </label>
                                </div>
                            </div>
						</div>

						<div class="row mb-2"> <!-- CONDICIONES DE LOS PROTECTORES -->
							<div class="col-12">
                                <p class="mb-1">Protectores <small><i>(Operador | Carga)</i></small></p>
                            </div>
                            <div class="col-12">
                                <label><input type="radio" name="Protectores" value="ok" onchange="setformModalOk('ProtectoresRadioIModal')" required><span>Ok</span></label>
                                <label><input type="radio" name="Protectores" value="nok" onchange="hereProblem(this)" id="ProtectoresRadioI"><span>No ok</span></label>
                            </div>
						</div>

						<div class="row mb-2"> <!-- CONDICIONES DE  MASTIL, TORRE, CADENAS DE ASCENSO Y DESCENSO -->
							<div class="col-12">
                                <p class="mb-1">Condiciones de <small><i>(Mastil | Torre | Cadenas de ascenso - Descenso)</i></small></p>
                            </div>
                            <div class="col-12">
                                <label><input type="radio" name="MastilCadenas" value="ok" onclick="setformModalOk('MastilCadenasIModal')" required><span>Ok</span></label>
                                <label><input type="radio" name="MastilCadenas" value="nok" onchange="hereProblem(this)" id="MastilCadenasI"><span>No ok</span></label>
                            </div>
						</div>

						<div class="row mb-2"> <!-- CONDICIONES DE PISTONES -->
							<div class="col-12">
                                <p class="mb-1">Pistones de <small><i>(Elevación-descenso | Inclinación-retroceso | Movimiento lateral)</i></small></p>
                            </div>
                            <div class="col-12">
                                <label><input type="radio" name="PistonesGral" value="ok" onclick="setformModalOk('PistonesGralIModal')" required><span>Ok</span></label>
                                <label><input type="radio" name="PistonesGral" value="nok" onchange="hereProblem(this)" id="PistonesGralI"><span>No ok</span></label>
                            </div>
						</div>

						<div class="row mb-2"> <!-- CONDICIONES DE UÑAS U HORQUILLAS -->
							<div class="col-12">
                                <p class="mb-1">Uñas u horquillas <small><i>(Seguros de horquillas)</i></small></p>
                            </div>
                            <div class="col-12">
                                <label><input type="radio" name="UnasHorq" value="ok" onclick="setformModalOk('UnasHorqIModal')" required><span>Ok</span></label>
                                <label><input type="radio" name="UnasHorq" value="nok" onchange="hereProblem(this)" id="UnasHorqI"><span>No ok</span></label>
                            </div>
						</div>

					</div>
					<div class="col-sm-12 col-md-4">
						<img src="img/montacargas.gif" style="width: 100%">
					</div>
				</div>
			</section>

			<section id="section2" style="display: none;">
                <div class="float-right"><h3> 2/4</h3></div>
				<div class="row">
					<div class="col-sm-12 col-md-7 mt-5">
						<div class="row mb-2"> <!-- CONDICIONES DE LAS LLANTAS -->
							<div class="col-12">
                                <p class="mb-1">Condición de las llantas <small><i>(Llantas | Birlos/tuercas)</i></small></p>
                            </div>
                            <div class="col-12">
                                <label><input type="radio" name="LlantasTuercas" onclick="setformModalOk('LlantasTuercasIModal')" value="ok" required><span>Ok</span></label>
                                <label><input type="radio" name="LlantasTuercas" value="nok" onchange="hereProblem(this)" id="LlantasTuercasI"><span>No ok</span></label>
                            </div>
						</div>

						<div class="row mb-2"> <!-- CONDICIONES DE TANQUE DE GAS -->
							<div class="col-12">
                                <p class="mb-1">Tanque de gas <small><i>(Tanque | Manometro)</i></small></p>
                            </div>
                            <div class="col-12">
                                <label><input type="radio" name="TanqueGas" onclick="setformModalOk('TanqueGasIModal')" value="ok" required><span>Ok</span></label>
                                <label><input type="radio" name="TanqueGas" value="nok" onchange="hereProblem(this)" id="TanqueGasI"><span>No ok</span></label>
                            </div>
						</div>

						<div class="row">	<!-- NIVEL DE COMBUSTIBLE -->
							<div class="col s8">
								<p>Nivel de combustible <small>(indicar porcentaje sí hay manometro)</small></p>
								<input type="number" name="manometroNivel" id="manometroField" class="form-control" required>
								<label>
									<input type='checkbox' class="noused" onchange="if($(this).prop('checked')){$('#manometroField').prop('readonly', true);$('#manometroField').val('NA')}else{$('#manometroField').prop('readonly', false);}" /><span>NA.</span>
								</label>
							</div>
						</div>

						<div class="row mb-2"> <!-- CONDICIONES DE SEGUROS DEL TANQUE -->
							<div class="col-12">
                                <p class="mb-1">Seguros del tanque <small><i>(Seguros | Tubería | Válvula check)</i></small></p>
                            </div>
                            <div class="col-12">
                                <label><input type="radio" name="SegurosCheck" onclick="setformModalOk('SegurosCheckIModal')" value="ok" required><span>Ok</span></label>
                                <label><input type="radio" name="SegurosCheck" value="nok" onchange="hereProblem(this)" id="SegurosCheckI"><span>No ok</span></label>
                            </div>
						</div>

						<div class="row mb-2"> <!-- FUGAS -->
							<div class="col-12">
                                <p class="mb-1">Fugas <small><i>(Gas | Aceite de motor | Sistema hidráulico)</i></small></p>
                            </div>
                            <div class="col-12">
                                <label><input type="radio" name="Fugas" onclick="setformModalOk('FugasIModal')"  value="ok" required><span>Ok</span></label>
                                <label><input type="radio" name="Fugas" value="nok" onchange="hereProblem(this)" id="FugasI"><span>No ok</span></label>
                            </div>
						</div>

					</div>
					<div class="col-sm-12 col-md-4">
						<img src="img/montacargasllantas.gif" style="width: 100%">
					</div>
				</div>
			</section>

			<section id="section3" style="display: none;">
                <div class="float-right"><h3> 3/4</h3></div>
				<div class="row">
					<div class="col-sm-12 col-md-7 mt-5">
						<div class="row mb-2"> <!-- CONDICIONES DE TABLERO -->
							<div class="col-12">
                                <p class="mb-1">Tablero <small><i>(Sistema de encendido | Tablero de instrumentos)</i></small></p>
                            </div>
                            <div class="col-12">
                                <label><input type="radio" name="Tablero" value="ok" onclick="setformModalOk('TableroIModal')" required><span>Ok</span></label>
                                <label><input type="radio" name="Tablero" value="nok" onchange="hereProblem(this)" id="TableroI"><span>No ok</span></label>
                            </div>
						</div>

						<div class="row mb-2"> <!-- CONDICIONES DE CONTROL -->
							<div class="col-12">
                                <p class="mb-1">Control <small><i>(Palanca de dirección | Palancas de control | Sistema de dirección)</i></small></p>
                            </div>
                            <div class="col-12">
                                <label><input type="radio" name="Control" value="ok" onclick="setformModalOk('ControlIModal')" required><span>Ok</span></label>
                                <label><input type="radio" name="Control" value="nok" onchange="hereProblem(this)" id="ControlI"><span>No ok</span></label>
                            </div>
						</div>

						<div class="row mb-2"> <!-- SISTEMA DE FRENOS -->
							<div class="col-12">
                                <p class="mb-1">Frenos <small><i>(Sistema de frenos | Freno de mano | Gobernador de velocidad)</i></small></p>
                            </div>
                            <div class="col-12">
                                <label><input type="radio" name="FrenosSist" value="ok" onclick="setformModalOk('FrenosSistIModal')" required><span>Ok</span></label>
                                <label><input type="radio" name="FrenosSist" value="nok" onchange="hereProblem(this)" id="FrenosSistI"><span>No ok</span></label>
                            </div>
						</div>

						<div class="row mb-2"> <!-- CONDICIONES RADIO -->
							<div class="col-12">
                                <p class="mb-1">Radio de comunicación</p>
                            </div>
                            <div class="col-12">
                                <label>
                                    <input name="CondicionRad" value="ok" required type="radio" onchange="$('#hiddenRadioC').fadeOut(function(){$('#CondicionRadioObs').prop('disabled', true)})" />
                                    <span>OK</span>
                                </label>
    
                                <label>
                                    <input name="CondicionRad" value="nok" type="radio" onchange="$('#hiddenRadioC').fadeIn(function(){$('#CondicionRadioObs').prop('disabled', false)})" />
                                    <span>Req. Mtto</span>
                                </label>
    
                                <div class="" id="hiddenRadioC" hidden style="float: right;">
                                    <input type="text" name="CondicionRadioObs" id="CondicionRadioObs" placeholder="Observación" required disabled>
                                    
                                    <label>
                                        <input type='checkbox' name='CondicionRadSOL'/><span>Solucionado</span>
                                    </label>
                                </div>
                            </div>
						</div>

						<div class="row mb-2"> <!-- CONDICIONES EXTINTOR -->
							<div class="col-12">
                                <p class="mb-1">Extintor operable <small>Manecilla amarilla en área verde</small></p>
                            </div>
                            <div class="col-12">
                                <label>
                                    <input name="CondicionExt" value="ok" required type="radio" onchange="$('#hiddenExtintorC').fadeOut(function(){$('#CondicionExtintObs').prop('disabled', true)})" />
                                    <span>OK</span>
                                </label>
    
                                <label>
                                    <input name="CondicionExt" value="nok" type="radio" onchange="$('#hiddenExtintorC').fadeIn(function(){$('#CondicionExtintObs').prop('disabled', false)})" />
                                    <span>Req. Mtto</span>
                                </label>
    
                                <div class="" id="hiddenExtintorC" hidden style="float: right;">
                                    <input type="text" name="CondicionExtintObs" id="CondicionExtintObs" placeholder="Observación" required disabled>
                                    
                                    <label>
                                        <input type='checkbox' name='CondicionExtSOL'/><span>Solucionado</span>
                                    </label>
                                </div>
                            </div>
						</div>
					</div>
					<div class="col-sm-12 col-md-4">
						<div style="height: 10vh"></div>
						<img src="img/tableroInv.jpg" style="width: 70%">
					</div>
				</div>
			</section>

			<section id="section4" style="display: none;">
                <div class="float-right"><h3> 4/4</h3></div>
				<div class="row">
					<div class="col-sm-12 col-md-7 mt-5">
						<div class="row mb-2"> <!-- CONDICIONES DE LUCES -->
							<div class="col-12">
                                <p class="mb-1">Luces <small><i>(Delantera, Trasera, Torreta | blue spot)</i></small></p>
                            </div>
                            <div class="col-12">
                                <label><input type="radio" name="Luces" value="ok" onclick="setformModalOk('LucesIModal')" required><span>Ok</span></label>
                                <label><input type="radio" name="Luces" value="nok" onchange="hereProblem(this)" id="LucesI"><span>No ok</span></label>
                            </div>
						</div>

						<div class="row mb-2"> <!-- ALARMA -->
							<div class="col-12">
                                <p class="mb-1">Alarma <small><i>(Reversa | Claxon)</i></small></p>
                            </div>
                            <div class="col-12">
                                <label><input type="radio" name="Alarma" value="ok" onclick="setformModalOk('AlarmaIModal')" required><span>Ok</span></label>
                                <label><input type="radio" name="Alarma" value="nok" onchange="hereProblem(this)" id="AlarmaI"><span>No ok</span></label>
                            </div>
						</div>

						<div class="row mb-2"> <!-- CONDICION DEL ASIENTO -->
							<div class="col-12">
                                <p class="mb-1">Asiento <small><i>(Condición del asiento | Cinturon de seguridad)</i></small></p>
                            </div>
                            <div class="col-12">
                                <label><input type="radio" name="Asiento" value="ok" onclick="setformModalOk('AsientoIModal')" required><span>Ok</span></label>
                                <label><input type="radio" name="Asiento" value="nok" onchange="hereProblem(this)" id="AsientoI"><span>No ok</span></label>
                            </div>
						</div>

						<div class="row mb-2"> <!-- CONDICIONES GRAL -->
							<div class="col-12">
                                <p class="mb-1">Banda antiestática</p>
                            </div>
                            <div class="col-12">
                                <label>
                                    <input name="CondicionBanda" value="ok" required type="radio" onchange="$('#hiddenBanda').fadeOut(function(){$('#CondicionBandaObs').prop('disabled', true)})" />
                                    <span>OK</span>
                                </label>
    
                                <label>
                                    <input name="CondicionBanda" value="nok" type="radio" onchange="$('#hiddenBanda').fadeIn(function(){$('#CondicionBandaObs').prop('disabled', false)})" />
                                    <span>Req. Mtto</span>
                                </label>
    
                                <div class="" id="hiddenBanda" hidden style="float: right;">
                                    <input type="text" name="CondicionBandaObs" id="CondicionBandaObs" placeholder="Observación" required disabled>
                                    
                                    <label>
                                        <input type='checkbox' name='CondicionBandaSOL'/><span>Solucionado</span>
                                    </label>
                                </div>
                            </div>
						</div>
					</div>
					<div class="col-sm-12 col-md-4">
						<img src="img/montacargas.jpg" style="width: 100%">
					</div>
				</div>
			</section>
		</div>
			

		<!-- SECCION DE MODALS -->
		<section>
            <div class="modal fade" id="ProtectoresRadioIModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Reportar mal estado.</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col s6"><p>Protector del operador</p>
                                <label>
                                    <input name="ProtectorOp" value="ok" type="radio" onchange="$('.CondicionOper').prop('disabled', true); $('.CondicionOper').val('').prop('checked',false)" /><span>OK</span>
                                </label>
                                <label>
                                    <input name="ProtectorOp" value="na" type="radio" onchange="$('.CondicionOper').prop('disabled', true); $('.CondicionOper').val('').prop('checked',false)" /><span>NA</span>
                                </label>
                                <br>
                                <label>
                                    <input name="ProtectorOp" value="nok" type="radio" onchange="$('.CondicionOper').prop('disabled', false);" /><span>Req. Mtto</span>
                                </label>
                            </div>
    
                            <div class="col s6" id="hiddenOperador" style="float: right;">
                                <input type="text" name="CondicionOperObs" class="CondicionOper" placeholder="Observación" disabled>
                                
                                <label>
                                    <input type='checkbox' name='ProtectorOpSOL' class="CondicionOper" disabled /><span>Solucionado</span>
                                </label>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="row">
                            <div class="col s6"><p>Protector de Carga</p>
                                <label>
                                    <input name="ProtectorCarga" value="ok" type="radio" onchange="$('.CondicionCarga').prop('disabled', true); $('.CondicionCarga').val('').prop('checked',false)" /><span>OK</span>
                                </label>
                                <label>
                                    <input name="ProtectorCarga" value="na" type="radio" onchange="$('.CondicionCarga').prop('disabled', true); $('.CondicionCarga').val('').prop('checked',false)" /><span>NA</span>
                                </label>
                                <br>
                                <label>
                                    <input name="ProtectorCarga" value="nok" type="radio" onchange="$('.CondicionCarga').prop('disabled', false);" /><span>Req. Mtto</span>
                                </label>
                            </div>
    
                            <div class="col s6" id="hiddenCarga" style="float: right;">
                                <input type="text" name="CondicionCargaObs" class="CondicionCarga" placeholder="Observación" disabled>
                                
                                <label>
                                    <input type='checkbox' name='nameSOL' class="CondicionCarga" disabled /><span>Solucionado</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
					    <a class="waves-effect waves-green btn-flat" onclick="validar('ProtectoresRadioIModal')">Listo</a>
                    </div>
                  </div>
                </div>
              </div>
			<div id="MastilCadenasIModal" class="modal fade" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content p-3">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reportar mal estado.</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="row">
                            <div class="col s6"><p>Mastil o torre</p>
                                <label>
                                    <input name="Mastil" value="ok" type="radio" onchange="$('.CondicionMastil').prop('disabled', true); $('.CondicionMastil').val('').prop('checked',false)" /><span>OK</span>
                                </label>
                                <label>
                                    <input name="Mastil" value="na" type="radio" onchange="$('.CondicionMastil').prop('disabled', true); $('.CondicionMastil').val('').prop('checked',false)" /><span>NA</span>
                                </label>
                                <br>
                                <label>
                                    <input name="Mastil" value="nok" type="radio" onchange="$('.CondicionMastil').prop('disabled', false);" /><span>Req. Mtto</span>
                                </label>
                            </div>

                            <div class="col s6" style="float: right;">
                                <input type="text" name="CondicionMastilObs" class="CondicionMastil" placeholder="Observación" disabled>
                                
                                <label>
                                    <input type='checkbox' name='MastilSOL' class="CondicionMastil" disabled /><span>Solucionado</span>
                                </label>

                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="row">
                            <div class="col s6"><p>Cadenas de ascenso y descenso</p>
                                <label>
                                    <input name="Cadenas" value="ok" type="radio" onchange="$('.CondicionCadenas').prop('disabled', true); $('.CondicionCadenas').val('').prop('checked',false)" /><span>OK</span>
                                </label>
                                <label>
                                    <input name="Cadenas" value="na" type="radio" onchange="$('.CondicionCadenas').prop('disabled', true); $('.CondicionCadenas').val('').prop('checked',false)" /><span>NA</span>
                                </label>
                                <br>
                                <label>
                                    <input name="Cadenas" value="nok" type="radio" onchange="$('.CondicionCadenas').prop('disabled', false);" /><span>Req. Mtto</span>
                                </label>
                            </div>

                            <div class="col s6" id="hiddenCarga" style="float: right;">
                                <input type="text" name="CondicionCadenasObs" class="CondicionCadenas" placeholder="Observación" disabled>
                                
                                <label>
                                    <input type='checkbox' name='CadenasSOL' class="CondicionCadenas" disabled /><span>Solucionado</span>
                                </label>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <a href="#!" class="modal-close waves-effect waves-green btn-flat">Listo</a> -->
                        <a class="waves-effect waves-green btn-flat" onclick="validar('MastilCadenasIModal')">Listo</a>
                    </div>
                </div>
			</div>
			<div id="PistonesGralIModal" class="modal fade" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content p-3">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reportar mal estado.</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="row">
                            <div class="col s6"><p>Pistón de elevación y descenso</p>
                                <label>
                                    <input name="PistonED" value="ok" type="radio" onchange="$('.CondicionPistonED').prop('disabled', true); $('.CondicionPistonED').val('').prop('checked',false)" /><span>OK</span>
                                </label>
                                <label>
                                    <input name="PistonED" value="na" type="radio" onchange="$('.CondicionPistonED').prop('disabled', true); $('.CondicionPistonED').val('').prop('checked',false)" />				<span>NA</span>
                                </label>
                                <br>
                                <label>
                                    <input name="PistonED" value="nok" type="radio" onchange="$('.CondicionPistonED').prop('disabled', false);" />			<span>Req. Mtto</span>
                                </label>
                            </div>

                            <div class="col s6" style="float: right;">
                                <input type="text" name="CondicionPistonEDObs" class="CondicionPistonED" placeholder="Observación" disabled>
                                
                                <label>
                                    <input type='checkbox' name='PistonEDSOL' class="CondicionPistonED" disabled /><span>Solucionado</span>
                                </label>

                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="row">
                            <div class="col s6"><p>Pistón de inclinación y retroceso</p>
                                <label>
                                    <input name="PistonIR" value="ok" type="radio" onchange="$('.CondicionPistonIR').prop('disabled', true); $('.CondicionPistonIR').val('').prop('checked',false)" /><span>OK</span>
                                </label>
                                <label>
                                    <input name="PistonIR" value="na" type="radio" onchange="$('.CondicionPistonIR').prop('disabled', true); $('.CondicionPistonIR').val('').prop('checked',false)" /><span>NA</span>
                                </label>
                                <br>
                                <label>
                                    <input name="PistonIR" value="nok" type="radio" onchange="$('.CondicionPistonIR').prop('disabled', false);" /><span>Req. Mtto</span>
                                </label>
                            </div>

                            <div class="col s6" id="hiddenCarga" style="float: right;">
                                <input type="text" name="CondicionPistonIRObs" class="CondicionPistonIR" placeholder="Observación" disabled>
                                
                                <label>
                                    <input type='checkbox' name='PistonIRSOL' class="CondicionPistonIR" disabled /><span>Solucionado</span>
                                </label>

                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="row">
                            <div class="col s6"><p>Pistón de movimiento lateral</p>
                                <label>
                                    <input name="PistonLat" value="ok" type="radio" onchange="$('.CondicionPistonLat').prop('disabled', true); $('.CondicionPistonLat').val('').prop('checked',false)" /><span>OK</span>
                                </label>
                                <label>
                                    <input name="PistonLat" value="na" type="radio" onchange="$('.CondicionPistonLat').prop('disabled', true); $('.CondicionPistonLat').val('').prop('checked',false)" /><span>NA</span>
                                </label>
                                <br>
                                <label>
                                    <input name="PistonLat" value="nok" type="radio" onchange="$('.CondicionPistonLat').prop('disabled', false);" /><span>Req. Mtto</span>
                                </label>
                            </div>

                            <div class="col s6" id="hiddenCarga" style="float: right;">
                                <input type="text" name="CondicionPistonLatObs" class="CondicionPistonLat" placeholder="Observación" disabled>
                                
                                <label>
                                    <input type='checkbox' name='PistonLatSOL' class="CondicionPistonLat" disabled /><span>Solucionado</span>
                                </label>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <a href="#!" class="modal-close waves-effect waves-green btn-flat">Listo</a> -->
                        <a class="waves-effect waves-green btn-flat" onclick="validar('PistonesGralIModal')">Listo</a>
                    </div>
                </div>
			</div>
			<div id="UnasHorqIModal" class="modal fade" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content p-3">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reportar mal estado.</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="row">
                            <div class="col s6"><p>Uñas u horquillas</p>
                                <label>
                                    <input name="UnasH" value="ok" type="radio" onchange="$('.CondicionUnasH').prop('disabled', true); $('.CondicionUnasH').val('').prop('checked',false)" /><span>OK</span>
                                </label>
                                <label>
                                    <input name="UnasH" value="na" type="radio" onchange="$('.CondicionUnasH').prop('disabled', true); $('.CondicionUnasH').val('').prop('checked',false)" /><span>NA</span>
                                </label>
                                <br>
                                <label>
                                    <input name="UnasH" value="nok" type="radio" onchange="$('.CondicionUnasH').prop('disabled', false);" /><span>Req. Mtto</span>
                                </label>
                            </div>

                            <div class="col s6" id="hiddenOperador" style="float: right;">
                                <input type="text" name="CondicionUnasHObs" class="CondicionUnasH" placeholder="Observación" disabled>
                                
                                <label>
                                    <input type='checkbox' name='UnasHSOL' class="CondicionUnasH" disabled /><span>Solucionado</span>
                                </label>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="row">
                            <div class="col s6"><p>Seguros de horquillas</p>
                                <label>
                                    <input name="SegurosH" value="ok" type="radio" onchange="$('.CondicionSegurosH').prop('disabled', true); $('.CondicionSegurosH').val('').prop('checked',false)" /><span>OK</span>
                                </label>
                                <label>
                                    <input name="SegurosH" value="na" type="radio" onchange="$('.CondicionSegurosH').prop('disabled', true); $('.CondicionSegurosH').val('').prop('checked',false)" /><span>NA</span>
                                </label>
                                <br>
                                <label>
                                    <input name="SegurosH" value="nok" type="radio" onchange="$('.CondicionSegurosH').prop('disabled', false);" /><span>Req. Mtto</span>
                                </label>
                            </div>

                            <div class="col s6" id="hiddenCarga" style="float: right;">
                                <input type="text" name="CondicionSegurosHObs" class="CondicionSegurosH" placeholder="Observación" disabled>
                                
                                <label>
                                    <input type='checkbox' name='SegurosHSOL' class="CondicionSegurosH" disabled /><span>Solucionado</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <a href="#!" class="modal-close waves-effect waves-green btn-flat">Listo</a> -->
                        <a class="waves-effect waves-green btn-flat" onclick="validar('UnasHorqIModal')">Listo</a>
                    </div>
                </div>
			</div>
		</section>
		<section>
			<div id="LlantasTuercasIModal" class="modal fade" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content p-3">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reportar mal estado.</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="row">
                            <div class="col s6"><p>Condicion de las Llantas</p>
                                <label>
                                    <input name="Llantas" value="ok" type="radio" onchange="$('.CondicionLlantas').prop('disabled', true); $('.CondicionLlantas').val('').prop('checked',false)" /><span>OK</span>
                                </label>
                                <label>
                                    <input name="Llantas" value="na" type="radio" onchange="$('.CondicionLlantas').prop('disabled', true); $('.CondicionLlantas').val('').prop('checked',false)" /><span>NA</span>
                                </label>
                                <br>
                                <label>
                                    <input name="Llantas" value="nok" type="radio" onchange="$('.CondicionLlantas').prop('disabled', false);" /><span>Req. Mtto</span>
                                </label>
                            </div>

                            <div class="col s6" id="hiddenOperador" style="float: right;">
                                <input type="text" name="CondicionLlantasObs" class="CondicionLlantas" placeholder="Observación" disabled>
                                
                                <label>
                                    <input type='checkbox' name='CondicionLlantasSolucion' class="CondicionLlantas" disabled /><span>Solucionado</span>
                                </label>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="row">
                            <div class="col s6"><p>Tuercas / birlos no están flojos</p>
                                <label>
                                    <input name="Tuercas" value="ok" type="radio" onchange="$('.CondicionTuercas').prop('disabled', true); $('.CondicionTuercas').val('').prop('checked',false)" /><span>OK</span>
                                </label>
                                <label>
                                    <input name="Tuercas" value="na" type="radio" onchange="$('.CondicionTuercas').prop('disabled', true); $('.CondicionTuercas').val('').prop('checked',false)" /><span>NA</span>
                                </label>
                                <br>
                                <label>
                                    <input name="Tuercas" value="nok" type="radio" onchange="$('.CondicionTuercas').prop('disabled', false);" /><span>Req. Mtto</span>
                                </label>
                            </div>

                            <div class="col s6" id="hiddenCarga" style="float: right;">
                                <input type="text" name="CondicionTuercasObs" class="CondicionTuercas" placeholder="Observación" disabled>
                                
                                <label>
                                    <input type='checkbox' name='CondicionTuercasSolucion' class="CondicionTuercas" disabled /><span>Solucionado</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <a href="#!" class="modal-close waves-effect waves-green btn-flat">Listo</a> -->
                        <a class="waves-effect waves-green btn-flat" onclick="validar('LlantasTuercasIModal')">Listo</a>
                    </div>
                </div>
			</div>
			<div id="TanqueGasIModal" class="modal fade" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content p-3">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reportar mal estado.</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="row">
                            <div class="col s6"><p>Condición del tanque</p>
                                <label>
                                    <input name="Tanque" value="ok" type="radio" onchange="$('.CondicionTanque').prop('disabled', true); $('.CondicionTanque').val('').prop('checked',false)" /><span>OK</span>
                                </label>
                                <label>
                                    <input name="Tanque" value="na" type="radio" onchange="$('.CondicionTanque').prop('disabled', true); $('.CondicionTanque').val('').prop('checked',false)" /><span>NA</span>
                                </label>
                                <br>
                                <label>
                                    <input name="Tanque" value="nok" type="radio" onchange="$('.CondicionTanque').prop('disabled', false);" /><span>Req. Mtto</span>
                                </label>
                            </div>

                            <div class="col s6" id="hiddenOperador" style="float: right;">
                                <input type="text" name="CondicionTanqueObs" class="CondicionTanque" placeholder="Observación" disabled>
                                
                                <label>
                                    <input type='checkbox' name='TanqueSOL' class="CondicionTanque" disabled /><span>Solucionado</span>
                                </label>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="row">
                            <div class="col s6"><p>Manometro del tanque <small>(Solo aplica a gas natural)</small></p>
                                <label>
                                    <input name="Manometro" value="ok" type="radio" onchange="$('.CondicionManometro').prop('disabled', true); $('.CondicionManometro').val('').prop('checked',false)" /><span>OK</span>
                                </label>
                                <label>
                                    <input name="Manometro" value="na" type="radio" onchange="$('.CondicionManometro').prop('disabled', true); $('.CondicionManometro').val('').prop('checked',false)" /><span>NA</span>
                                </label>
                                <br>
                                <label>
                                    <input name="Manometro" value="nok" type="radio" onchange="$('.CondicionManometro').prop('disabled', false);" /><span>Req. Mtto</span>
                                </label>
                            </div>

                            <div class="col s6" id="hiddenCarga" style="float: right;">
                                <input type="text" name="CondicionManometroObs" class="CondicionManometro" placeholder="Observación" disabled>
                                
                                <label>
                                    <input type='checkbox' name='ManometroSOL' class="CondicionManometro" disabled /><span>Solucionado</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <a href="#!" class="modal-close waves-effect waves-green btn-flat">Listo</a> -->
                        <a class="waves-effect waves-green btn-flat" onclick="validar('TanqueGasIModal')">Listo</a>
                    </div>
                </div>
			</div>
			<div id="SegurosCheckIModal" class="modal fade" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content p-3">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reportar mal estado.</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="row">
                            <div class="col s6"><p>Seguros del tanque</p>
                                <label>
                                    <input name="SegurosTanq" value="ok" type="radio" onchange="$('.CondicionSegurosTanq').prop('disabled', true); $('.CondicionSegurosTanq').val('').prop('checked',false)" /><span>OK</span>
                                </label>
                                <label>
                                    <input name="SegurosTanq" value="na" type="radio" onchange="$('.CondicionSegurosTanq').prop('disabled', true); $('.CondicionSegurosTanq').val('').prop('checked',false)" /><span>NA</span>
                                </label>
                                <br>
                                <label>
                                    <input name="SegurosTanq" value="nok" type="radio" onchange="$('.CondicionSegurosTanq').prop('disabled', false);" /><span>Req. Mtto</span>
                                </label>
                            </div>

                            <div class="col s6" id="hiddenOperador" style="float: right;">
                                <input type="text" name="CondicionSegurosTanqObs" class="CondicionSegurosTanq" placeholder="Observación" disabled>
                                
                                <label>
                                    <input type='checkbox' name='SegurosTanqSOL' class="CondicionSegurosTanq" disabled /><span>Solucionado</span>
                                </label>
                            </div>
                        </div>
                            <div class="divider"></div>
                        <div class="row">
                            <div class="col s6"><p>Tubería de gas</p>
                                <label>
                                    <input name="Tuberia" value="ok" type="radio" onchange="$('.CondicionTuberia').prop('disabled', true); $('.CondicionTuberia').val('').prop('checked',false)" /><span>OK</span>
                                </label>
                                <label>
                                    <input name="Tuberia" value="na" type="radio" onchange="$('.CondicionTuberia').prop('disabled', true); $('.CondicionTuberia').val('').prop('checked',false)" /><span>NA</span>
                                </label>
                                <br>
                                <label>
                                    <input name="Tuberia" value="nok" type="radio" onchange="$('.CondicionTuberia').prop('disabled', false);" /><span>Req. Mtto</span>
                                </label>
                            </div>

                            <div class="col s6" id="hiddenCarga" style="float: right;">
                                <input type="text" name="CondicionTuberiaObs" class="CondicionTuberia" placeholder="Observación" disabled>
                                
                                <label>
                                    <input type='checkbox' name='TuberiaSOL' class="CondicionTuberia" disabled /><span>Solucionado</span>
                                </label>
                            </div>
                        </div>
                            <div class="divider"></div>
                        <div class="row">
                            <div class="col s6"><p>Válvula check / conexión para llenado</p>
                                <label>
                                    <input name="ValvCheck" value="ok" type="radio" onchange="$('.CondicionValvCheck').prop('disabled', true); $('.CondicionValvCheck').val('').prop('checked',false)" /><span>OK</span>
                                </label>
                                <label>
                                    <input name="ValvCheck" value="na" type="radio" onchange="$('.CondicionValvCheck').prop('disabled', true); $('.CondicionValvCheck').val('').prop('checked',false)" /><span>NA</span>
                                </label>
                                <br>
                                <label>
                                    <input name="ValvCheck" value="nok" type="radio" onchange="$('.CondicionValvCheck').prop('disabled', false);" /><span>Req. Mtto</span>
                                </label>
                            </div>

                            <div class="col s6" id="hiddenCarga" style="float: right;">
                                <input type="text" name="CondicionValvCheckObs" class="CondicionValvCheck" placeholder="Observación" disabled>
                                
                                <label>
                                    <input type='checkbox' name='ValvCheckSOL' class="CondicionValvCheck" disabled /><span>Solucionado</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <a href="#!" class="modal-close waves-effect waves-green btn-flat">Listo</a> -->
                        <a class="waves-effect waves-green btn-flat" onclick="validar('SegurosCheckIModal')">Listo</a>
                    </div>
                </div>
			</div>
			<div id="FugasIModal" class="modal fade" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content p-3">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reportar mal estado.</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="row">
                            <div class="col s6"><p>Fuga de gas</p>
                                <label>
                                    <input name="FugaGas" value="ok" type="radio" onchange="$('.CondicionFugaGas').prop('disabled', true); $('.CondicionFugaGas').val('').prop('checked',false)" /><span>OK</span>
                                </label>
                                <label>
                                    <input name="FugaGas" value="na" type="radio" onchange="$('.CondicionFugaGas').prop('disabled', true); $('.CondicionFugaGas').val('').prop('checked',false)" /><span>NA</span>
                                </label>
                                <br>
                                <label>
                                    <input name="FugaGas" value="nok" type="radio" onchange="$('.CondicionFugaGas').prop('disabled', false);" /><span>Req. Mtto</span>
                                </label>
                            </div>

                            <div class="col s6" id="hiddenOperador" style="float: right;">
                                <input type="text" name="CondicionFugaGasObs" class="CondicionFugaGas" placeholder="Observación" disabled>
                                
                                <label>
                                    <input type='checkbox' name='FugaGasSOL' class="CondicionFugaGas" disabled /><span>Solucionado</span>
                                </label>
                            </div>
                        </div>
                            <div class="divider"></div>
                        <div class="row">
                            <div class="col s6"><p>Fuga en el aceite de motor</p>
                                <label>
                                    <input name="FugaAceite" value="ok" type="radio" onchange="$('.CondicionFugaAceite').prop('disabled', true); $('.CondicionFugaAceite').val('').prop('checked',false)" /><span>OK</span>
                                </label>
                                <label>
                                    <input name="FugaAceite" value="na" type="radio" onchange="$('.CondicionFugaAceite').prop('disabled', true); $('.CondicionFugaAceite').val('').prop('checked',false)" /><span>NA</span>
                                </label>
                                <br>
                                <label>
                                    <input name="FugaAceite" value="nok" type="radio" onchange="$('.CondicionFugaAceite').prop('disabled', false);" /><span>Req. Mtto</span>
                                </label>
                            </div>

                            <div class="col s6" id="hiddenCarga" style="float: right;">
                                <input type="text" name="CondicionFugaAceiteObs" class="CondicionFugaAceite" placeholder="Observación" disabled>
                                
                                <label>
                                    <input type='checkbox' name='FugaAceiteSOL' class="CondicionFugaAceite" disabled /><span>Solucionado</span>
                                </label>
                            </div>
                        </div>
                            <div class="divider"></div>
                        <div class="row">
                            <div class="col s6"><p>Fuga en el sistema Hidráulico</p>
                                <label>
                                    <input name="FugaHidra" value="ok" type="radio" onchange="$('.CondicionFugaHidra').prop('disabled', true); $('.CondicionFugaHidra').val('').prop('checked',false)" /><span>OK</span>
                                </label>
                                <label>
                                    <input name="FugaHidra" value="na" type="radio" onchange="$('.CondicionFugaHidra').prop('disabled', true); $('.CondicionFugaHidra').val('').prop('checked',false)" /><span>NA</span>
                                </label>
                                <br>
                                <label>
                                    <input name="FugaHidra" value="nok" type="radio" onchange="$('.CondicionFugaHidra').prop('disabled', false);" /><span>Req. Mtto</span>
                                </label>
                            </div>

                            <div class="col s6" id="hiddenCarga" style="float: right;">
                                <input type="text" name="CondicionFugaHidraObs" class="CondicionFugaHidra" placeholder="Observación" disabled>
                                
                                <label>
                                    <input type='checkbox' name='FugaHidraSOL' class="CondicionFugaHidra" disabled /><span>Solucionado</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <a href="#!" class="modal-close waves-effect waves-green btn-flat">Listo</a> -->
                        <a class="waves-effect waves-green btn-flat" onclick="validar('FugasIModal')">Listo</a>
                    </div>
                </div>
			</div>
		</section>
		<section>
			<div id="TableroIModal" class="modal fade" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content p-3">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reportar mal estado.</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="row">
                            <div class="col s6"><p>Sistema de encendido (switch)</p>
                                <label>
                                    <input name="Switch" value="ok" type="radio" onchange="$('.CondicionSwitch').prop('disabled', true); $('.CondicionSwitch').val('').prop('checked',false)" /><span>OK</span>
                                </label>
                                <label>
                                    <input name="Switch" value="na" type="radio" onchange="$('.CondicionSwitch').prop('disabled', true); $('.CondicionSwitch').val('').prop('checked',false)" /><span>NA</span>
                                </label>
                                <br>
                                <label>
                                    <input name="Switch" value="nok" type="radio" onchange="$('.CondicionSwitch').prop('disabled', false);" /><span>Req. Mtto</span>
                                </label>
                            </div>

                            <div class="col s6" style="float: right;">
                                <input type="text" name="CondicionSwitchObs" class="CondicionSwitch" placeholder="Observación" disabled>
                                
                                <label>
                                    <input type='checkbox' name='SwitchSOL' class="CondicionSwitch" disabled /><span>Solucionado</span>
                                </label>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="row">
                            <div class="col s6"><p>Tablero de instrumentos</p>
                                <label>
                                    <input name="TabInstru" value="ok" type="radio" onchange="$('.CondicionTabInstru').prop('disabled', true); $('.CondicionTabInstru').val('').prop('checked',false)" /><span>OK</span>
                                </label>
                                <label>
                                    <input name="TabInstru" value="na" type="radio" onchange="$('.CondicionTabInstru').prop('disabled', true); $('.CondicionTabInstru').val('').prop('checked',false)" /><span>NA</span>
                                </label>
                                <br>
                                <label>
                                    <input name="TabInstru" value="nok" type="radio" onchange="$('.CondicionTabInstru').prop('disabled', false);" /><span>Req. Mtto</span>
                                </label>
                            </div>

                            <div class="col s6" id="hiddenCarga" style="float: right;">
                                <input type="text" name="CondicionTabInstruObs" class="CondicionTabInstru" placeholder="Observación" disabled>
                                
                                <label>
                                    <input type='checkbox' name='TabInstruSOL' class="CondicionTabInstru" disabled /><span>Solucionado</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <a href="#!" class="modal-close waves-effect waves-green btn-flat">Listo</a> -->
                        <a class="waves-effect waves-green btn-flat" onclick="validar('TableroIModal')">Listo</a>
                    </div>
                </div>
			</div>

			<div id="ControlIModal" class="modal fade" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content p-3">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reportar mal estado.</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="row">
                            <div class="col s6"><p>Palanca de dirección</p>
                                <label>
                                    <input name="DireccionP" value="ok" type="radio" onchange="$('.CondicionDireccionP').prop('disabled', true); $('.CondicionDireccionP').val('').prop('checked',false)" /><span>OK</span>
                                </label>
                                <label>
                                    <input name="DireccionP" value="na" type="radio" onchange="$('.CondicionDireccionP').prop('disabled', true); $('.CondicionDireccionP').val('').prop('checked',false)" /><span>NA</span>
                                </label>
                                <br>
                                <label>
                                    <input name="DireccionP" value="nok" type="radio" onchange="$('.CondicionDireccionP').prop('disabled', false);" /><span>Req. Mtto</span>
                                </label>
                            </div>

                            <div class="col s6" style="float: right;">
                                <input type="text" name="CondicionDireccionPObs" class="CondicionDireccionP" placeholder="Observación" disabled>
                                
                                <label>
                                    <input type='checkbox' name='DireccionPSOL' class="CondicionDireccionP" disabled /><span>Solucionado</span>
                                </label>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="row">
                            <div class="col s6"><p>Funcionamiento de las palancas de control</p>
                                <label>
                                    <input name="ControlPl" value="ok" type="radio" onchange="$('.CondicionControlPl').prop('disabled', true); $('.CondicionControlPl').val('').prop('checked',false)" /><span>OK</span>
                                </label>
                                <label>
                                    <input name="ControlPl" value="na" type="radio" onchange="$('.CondicionControlPl').prop('disabled', true); $('.CondicionControlPl').val('').prop('checked',false)" /><span>NA</span>
                                </label>
                                <br>
                                <label>
                                    <input name="ControlPl" value="nok" type="radio" onchange="$('.CondicionControlPl').prop('disabled', false);" /><span>Req. Mtto</span>
                                </label>
                            </div>

                            <div class="col s6" id="hiddenCarga" style="float: right;">
                                <input type="text" name="CondicionControlPlObs" class="CondicionControlPl" placeholder="Observación" disabled>
                                
                                <label>
                                    <input type='checkbox' name='ControlPlSOL' class="CondicionControlPl" disabled /><span>Solucionado</span>
                                </label>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="row">
                            <div class="col s6"><p>Sistema de dirección</p>
                                <label>
                                    <input name="DireccionSist" value="ok" type="radio" onchange="$('.CondicionDireccionSist').prop('disabled', true); $('.CondicionDireccionSist').val('').prop('checked',false)" /><span>OK</span>
                                </label>
                                <label>
                                    <input name="DireccionSist" value="na" type="radio" onchange="$('.CondicionDireccionSist').prop('disabled', true); $('.CondicionDireccionSist').val('').prop('checked',false)" /><span>NA</span>
                                </label>
                                <br>
                                <label>
                                    <input name="DireccionSist" value="nok" type="radio" onchange="$('.CondicionDireccionSist').prop('disabled', false);" /><span>Req. Mtto</span>
                                </label>
                            </div>

                            <div class="col s6" id="hiddenCarga" style="float: right;">
                                <input type="text" name="CondicionDireccionSistObs" class="CondicionDireccionSist" placeholder="Observación" disabled>
                                
                                <label>
                                    <input type='checkbox' name='DireccionSistSOL' class="CondicionDireccionSist" disabled /><span>Solucionado</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <a href="#!" class="modal-close waves-effect waves-green btn-flat">Listo</a> -->
                        <a class="waves-effect waves-green btn-flat" onclick="validar('ControlIModal')">Listo</a>
                    </div>
                </div>
			</div>

			<div id="FrenosSistIModal" class="modal fade" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content p-3">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reportar mal estado.</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="row">
                            <div class="col s6"><p>Sistema de frenos</p>
                                <label>
                                    <input name="Frenos" value="ok" type="radio" onchange="$('.CondicionFrenos').prop('disabled', true); $('.CondicionFrenos').val('').prop('checked',false)" /><span>OK</span>
                                </label>
                                <label>
                                    <input name="Frenos" value="na" type="radio" onchange="$('.CondicionFrenos').prop('disabled', true); $('.CondicionFrenos').val('').prop('checked',false)" /><span>NA</span>
                                </label>
                                <br>
                                <label>
                                    <input name="Frenos" value="nok" type="radio" onchange="$('.CondicionFrenos').prop('disabled', false);" /><span>Req. Mtto</span>
                                </label>
                            </div>

                            <div class="col s6" style="float: right;">
                                <input type="text" name="CondicionFrenosObs" class="CondicionFrenos" placeholder="Observación" disabled>
                                
                                <label>
                                    <input type='checkbox' name='FrenosSOL' class="CondicionFrenos" disabled /><span>Solucionado</span>
                                </label>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="row">
                            <div class="col s6"><p>Freno de mano</p>
                                <label>
                                    <input name="FrenoMano" value="ok" type="radio" onchange="$('.CondicionFrenoMano').prop('disabled', true); $('.CondicionFrenoMano').val('').prop('checked',false)" /><span>OK</span>
                                </label>
                                <label>
                                    <input name="FrenoMano" value="na" type="radio" onchange="$('.CondicionFrenoMano').prop('disabled', true); $('.CondicionFrenoMano').val('').prop('checked',false)" /><span>NA</span>
                                </label>
                                <br>
                                <label>
                                    <input name="FrenoMano" value="nok" type="radio" onchange="$('.CondicionFrenoMano').prop('disabled', false);" /><span>Req. Mtto</span>
                                </label>
                            </div>

                            <div class="col s6" id="hiddenCarga" style="float: right;">
                                <input type="text" name="CondicionFrenoManoObs" class="CondicionFrenoMano" placeholder="Observación" disabled>
                                
                                <label>
                                    <input type='checkbox' name='FrenoManoSOL' class="CondicionFrenoMano" disabled /><span>Solucionado</span>
                                </label>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="row">
                            <div class="col s6"><p>Gobernador de velocidad</p>
                                <label>
                                    <input name="GoberVeloc" value="ok" type="radio" onchange="$('.CondicionGoberVeloc').prop('disabled', true); $('.CondicionGoberVeloc').val('').prop('checked',false)" /><span>OK</span>
                                </label>
                                <label>
                                    <input name="GoberVeloc" value="na" type="radio" onchange="$('.CondicionGoberVeloc').prop('disabled', true); $('.CondicionGoberVeloc').val('').prop('checked',false)" /><span>NA</span>
                                </label>
                                <br>
                                <label>
                                    <input name="GoberVeloc" value="nok" type="radio" onchange="$('.CondicionGoberVeloc').prop('disabled', false);" /><span>Req. Mtto</span>
                                </label>
                            </div>

                            <div class="col s6" id="hiddenCarga" style="float: right;">
                                <input type="text" name="CondicionGoberVelocObs" class="CondicionGoberVeloc" placeholder="Observación" disabled>
                                
                                <label>
                                    <input type='checkbox' name='GoberVelocSOL' class="CondicionGoberVeloc" disabled /><span>Solucionado</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <a href="#!" class="modal-close waves-effect waves-green btn-flat">Listo</a> -->
                        <a class="waves-effect waves-green btn-flat" onclick="validar('FrenosSistIModal')">Listo</a>
                    </div>
                </div>
			</div>

			<div id="LucesIModal" class="modal fade" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content p-3">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reportar mal estado.</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="row">
                            <div class="col s6"><p>Luces delanteras, traseras y torreta</p>
                                <label>
                                    <input name="LucesGral" value="ok" type="radio" onchange="$('.CondicionLucesGral').prop('disabled', true); $('.CondicionLucesGral').val('').prop('checked',false)" /><span>OK</span>
                                </label>
                                <label>
                                    <input name="LucesGral" value="na" type="radio" onchange="$('.CondicionLucesGral').prop('disabled', true); $('.CondicionLucesGral').val('').prop('checked',false)" /><span>NA</span>
                                </label>
                                <br>
                                <label>
                                    <input name="LucesGral" value="nok" type="radio" onchange="$('.CondicionLucesGral').prop('disabled', false);" /><span>Req. Mtto</span>
                                </label>
                            </div>

                            <div class="col s6" style="float: right;">
                                <input type="text" name="CondicionLucesGralObs" class="CondicionLucesGral" placeholder="Observación" disabled>
                                
                                <label>
                                    <input type='checkbox' name='LucesGralSOL' class="CondicionLucesGral" disabled /><span>Solucionado</span>
                                </label>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="row">
                            <div class="col s6"><p>Blue Spot</p>
                                <label>
                                    <input name="BlueSpot" value="ok" type="radio" onchange="$('.CondicionBlueSpot').prop('disabled', true); $('.CondicionBlueSpot').val('').prop('checked',false)" /><span>OK</span>
                                </label>
                                <label>
                                    <input name="BlueSpot" value="na" type="radio" onchange="$('.CondicionBlueSpot').prop('disabled', true); $('.CondicionBlueSpot').val('').prop('checked',false)" /><span>NA</span>
                                </label>
                                <br>
                                <label>
                                    <input name="BlueSpot" value="nok" type="radio" onchange="$('.CondicionBlueSpot').prop('disabled', false);" /><span>Req. Mtto</span>
                                </label>
                            </div>

                            <div class="col s6" id="hiddenCarga" style="float: right;">
                                <input type="text" name="CondicionBlueSpotObs" class="CondicionBlueSpot" placeholder="Observación" disabled>
                                
                                <label>
                                    <input type='checkbox' name='BlueSpotSOL' class="CondicionBlueSpot" disabled /><span>Solucionado</span>
                                </label>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <!-- <a href="#!" class="modal-close waves-effect waves-green btn-flat">Listo</a> -->
                        <a class="waves-effect waves-green btn-flat" onclick="validar('LucesIModal')">Listo</a>
                    </div>
                </div>
			</div>

			<div id="AlarmaIModal" class="modal fade" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content p-3">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reportar mal estado.</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="row">
                            <div class="col s6"><p>Alarma de reversa</p>
                                <label>
                                    <input name="AlarmaR" value="ok" type="radio" onchange="$('.CondicionAlarmaR').prop('disabled', true); $('.CondicionAlarmaR').val('').prop('checked',false)" /><span>OK</span>
                                </label>
                                <label>
                                    <input name="AlarmaR" value="na" type="radio" onchange="$('.CondicionAlarmaR').prop('disabled', true); $('.CondicionAlarmaR').val('').prop('checked',false)" /><span>NA</span>
                                </label>
                                <br>
                                <label>
                                    <input name="AlarmaR" value="nok" type="radio" onchange="$('.CondicionAlarmaR').prop('disabled', false);" /><span>Req. Mtto</span>
                                </label>
                            </div>

                            <div class="col s6" style="float: right;">
                                <input type="text" name="CondicionAlarmaRObs" class="CondicionAlarmaR" placeholder="Observación" disabled>
                                
                                <label>
                                    <input type='checkbox' name='AlarmaRSOL' class="CondicionAlarmaR" disabled /><span>Solucionado</span>
                                </label>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="row">
                            <div class="col s6"><p>Bocina y/o claxon</p>
                                <label>
                                    <input name="Claxon" value="ok" type="radio" onchange="$('.CondicionClaxon').prop('disabled', true); $('.CondicionClaxon').val('').prop('checked',false)" /><span>OK</span>
                                </label>
                                <label>
                                    <input name="Claxon" value="na" type="radio" onchange="$('.CondicionClaxon').prop('disabled', true); $('.CondicionClaxon').val('').prop('checked',false)" /><span>NA</span>
                                </label>
                                <br>
                                <label>
                                    <input name="Claxon" value="nok" type="radio" onchange="$('.CondicionClaxon').prop('disabled', false);" /><span>Req. Mtto</span>
                                </label>
                            </div>

                            <div class="col s6" id="hiddenCarga" style="float: right;">
                                <input type="text" name="CondicionClaxonObs" class="CondicionClaxon" placeholder="Observación" disabled>
                                
                                <label>
                                    <input type='checkbox' name='ClaxonSOL' class="CondicionClaxon" disabled /><span>Solucionado</span>
                                </label>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <!-- <a href="#!" class="modal-close waves-effect waves-green btn-flat">Listo</a> -->
                        <a class="waves-effect waves-green btn-flat" onclick="validar('AlarmaIModal')">Listo</a>
                    </div>
                </div>
			</div>

			<div id="AsientoIModal" class="modal fade" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content p-3">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reportar mal estado.</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="row">
                            <div class="col s6"><p>Cinturón de seguridad</p>
                                <label>
                                    <input name="Cinturon" value="ok" type="radio" onchange="$('.CondicionCinturon').prop('disabled', true); $('.CondicionCinturon').val('').prop('checked',false)" /><span>OK</span>
                                </label>
                                <label>
                                    <input name="Cinturon" value="na" type="radio" onchange="$('.CondicionCinturon').prop('disabled', true); $('.CondicionCinturon').val('').prop('checked',false)" /><span>NA</span>
                                </label>
                                <br>
                                <label>
                                    <input name="Cinturon" value="nok" type="radio" onchange="$('.CondicionCinturon').prop('disabled', false);" /><span>Req. Mtto</span>
                                </label>
                            </div>

                            <div class="col s6" style="float: right;">
                                <input type="text" name="CondicionCinturonObs" class="CondicionCinturon" placeholder="Observación" disabled>
                                
                                <label>
                                    <input type='checkbox' name='CinturonSOL' class="CondicionCinturon" disabled /><span>Solucionado</span>
                                </label>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="row">
                            <div class="col s6"><p>Condición del asiento</p>
                                <label>
                                    <input name="AsientoC" value="ok" type="radio" onchange="$('.CondicionAsientoC').prop('disabled', true); $('.CondicionAsientoC').val('').prop('checked',false)" /><span>OK</span>
                                </label>
                                <label>
                                    <input name="AsientoC" value="na" type="radio" onchange="$('.CondicionAsientoC').prop('disabled', true); $('.CondicionAsientoC').val('').prop('checked',false)" /><span>NA</span>
                                </label>
                                <br>
                                <label>
                                    <input name="AsientoC" value="nok" type="radio" onchange="$('.CondicionAsientoC').prop('disabled', false);" /><span>Req. Mtto</span>
                                </label>
                            </div>

                            <div class="col s6" id="hiddenCarga" style="float: right;">
                                <input type="text" name="CondicionAsientoCObs" class="CondicionAsientoC" placeholder="Observación" disabled>
                                
                                <label>
                                    <input type='checkbox' name='AsientoCSOL' class="CondicionAsientoC" disabled /><span>Solucionado</span>
                                </label>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <!-- <a href="#!" class="modal-close waves-effect waves-green btn-flat">Listo</a> -->
                        <a class="waves-effect waves-green btn-flat" onclick="validar('AsientoIModal')">Listo</a>
                    </div>
                </div>
			</div>
		</section>
	</form>
	<div class="row container mx-auto">
		<div class="col s12 mx-5 mt-5">
            <div class="btn-group w-100" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-primary" id="anteriorBTN">Anterior</button>
                <button type="button" class="btn btn-success" id="FinForm" disabled>Terminar</button>
                <button type="button" class="btn btn-primary" id="siguienteBTN">Siguiente</button>
            </div>
			<!-- <button class="waves-effect waves-light btn-small light-green" id="anteriorBTN"><< anterior</button>
			<button class="waves-effect waves-light btn-small light-green" id="siguienteBTN">siguiente >></button> -->
		</div>		
	</div>	

	<!-- <button id="FinForm" class="waves-effect waves-light btn-small light-green accent-4" style="display: none;position: fixed;bottom: 10%;right: 50%;">Guardar</button> -->
	<div class="screen-block" id="overlay-block">
 		<div style="margin: 25%;">
			<div class="progress">
			  <div class="indeterminate"></div>
			</div>
			    
        	<span>Espere...</span>
  		</div>
    </div>
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
	<script type="text/javascript" src="../dist/js/check_list.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
</html>