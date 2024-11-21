<div class="modal fade modal-lg" id="modalViewCalendar" aria-hidden="true" aria-labelledby="modalViewCalendarLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalViewCalendarLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <p><strong>Nome:</strong> <span id="pacienteNome"></span></p>
                    <p><strong>CPF:</strong> <span id="pacienteCPF"></span></p>
                    <p><strong>Telefone:</strong> <span id="pacienteTelefone"></span></p>
                    <p><strong>E-mail:</strong> <span id="pacienteEmail"></span></p>
                    <p><strong>Convênio:</strong> <span id="pacienteConvenio"></span></p>
                    <p><strong>Médico:</strong> <span id="medicoNome"></span></p>
                    <p><strong>Procedimento:</strong> <span id="procedimento"></span></p>
                    <p><strong>Hora Inicial:</strong> <span id="horaInicial"></span></p>
                    <p><strong>Hora Final:</strong> <span id="horaFinal"></span></p>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <div class="dropup-center dropup">
                    <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Status
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="#" data-color="#85d17b"> <!-- Cor: Verde -->
                                <span class="dot" style="background-color: #85d17b;"></span> Finalizado
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" data-color="#9D9D9B"> <!-- Cor: Cinza -->
                                <span class="dot" style="background-color: #9D9D9B;"></span> Agendado
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" data-color="#8ea7e8"> <!-- Cor: Azul -->
                                <span class="dot" style="background-color: #8ea7e8;"></span> Confirmado
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" data-color="#f0b34a"> <!-- Cor: Laranja -->
                                <span class="dot" style="background-color: #f0b34a;"></span> Esperando
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" data-color="#f58493"> <!-- Cor: Rosa -->
                                <span class="dot" style="background-color: #f58493;"></span> Não Compareceu
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" data-color="#ff0000"> <!-- Cor: Vermelho -->
                                <span class="dot" style="background-color: #ff0000;"></span> Cancelado
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" data-color="#803c45"> <!-- Cor: Marrom -->
                                <span class="dot" style="background-color: #803c45"></span> Reagendado
                            </a>
                        </li>
                    </ul>
                </div>
                <button class="btn btn-primary" data-bs-target="#modalCalendar" data-bs-toggle="modal">Alterar Agendamento</button>
            </div>
        </div>
    </div>
</div>
<style>
    .dot {
        height: 10px;
        /* Tamanho do ponto */
        width: 10px;
        /* Tamanho do ponto */
        border-radius: 50%;
        /* Faz o ponto ser redondo */
        display: inline-block;
        /* Para que o ponto fique ao lado do texto */
        margin-right: 8px;
        /* Espaçamento entre o ponto e o texto */
        vertical-align: middle;
        /* Alinha o ponto verticalmente ao centro do texto */
    }
</style>