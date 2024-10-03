<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='utf-8' />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Agenda</title>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
    <style>
        body {
            margin: 40px 100px;
            padding: 0;
            font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
            font-size: 14px;
        }

        #calendar {
            max-width: 1100px;
            margin: 0 auto;
        }

        .list-group {
            position: absolute;
            z-index: 1000;
            max-height: 200px;
            overflow-y: auto;
        }
    </style>
</head>

<body>

    <!-- Modal CADASTRAR CONSULTA-->
    <div class="modal fade" id="cadastrarModal" tabindex="-1" aria-labelledby="cadastrarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="cadastrarModalLabel">NOVO AGENDAMENTO:</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="nome_paciente" class="col-12 col-form-label">Nome do paciente:</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="nome_paciente" onkeyup="buscarPacientes(this.value)">
                                <div id="sugestoes" class="list-group" style="display: none;"></div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="profissional" class="col-12 col-form-label">Profissional:</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="profissional" onkeyup="buscarMedicos(this.value)">
                                <div id="sugestoes_medicos" class="list-group" style="display: none;"></div>
                            </div>
                        </div>


                       <div class="row mb-3">
                        <label for="especialidade" class="col-12 col-form-label">Especialidade:</label>
                        <div class="col-12">
                            <input type="text" class="form-control" id="especialidade" onkeyup="buscarEspecialidades(this.value)">
                            <div id="sugestoes_especialidades" class="list-group" style="display: none;"></div>

                        </div>
                    </div>



                        <div class="row mb-3">
                            <label for="data_cons" class="col-12 col-form-label">Data:</label>
                            <div class="col-12">
                                <input type="datetime-local" class="form-control" id="data_cons">
                            </div>
                        </div>


                        <button type="submit" name="btnCad" id="btnCad" class="btn btn-success">Agendar</button>


                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id='calendar'></div>
    <script src='{{ asset('js/index.global.min.js') }}'></script>
    <script src='{{ asset('Js/core/locales-all.global.min.js') }}'></script>
    <script src='{{ asset('js/custom.js') }}'></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src='{{ asset('js/bootstrap5/index.global.min.js') }}'></script>

</body>
</html>
