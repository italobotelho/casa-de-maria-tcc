// Função para buscar pacientes com base em uma consulta
// Função para buscar pacientes com base em uma consulta
function buscarPacientes(query) {
    const sugestoesDiv = document.getElementById('pacienteSuggestions');

    if (query.length < 1) {
        sugestoesDiv.style.display = 'none';
        sugestoesDiv.innerHTML = '';
        return;
    }

    fetch(`/pacientes/buscar?query=${query}`)
        .then(response => response.json())
        .then(data => {
            sugestoesDiv.innerHTML = '';
            if (data.length > 0) {
                data.forEach(paciente => {
                    const dataNascimento = new Date(paciente.data_nasci_paci);
                    const dataFormatada = dataNascimento.toLocaleDateString('pt-BR');

                    const item = document.createElement('a');
                    item.className = 'list-group-item list-group-item-action';
                    item.href = '#';
                    item.textContent = `${paciente.nome_paci} - ${dataFormatada}`;
                    item.dataset.id = paciente.pk_cod_paci; // Armazena o ID do médico

                    item.onclick = function () {
                        document.getElementById('paciente').value = paciente.nome_paci;
                        document.getElementById('paciente_id').value = paciente.pk_cod_paci; // Preenche o campo oculto com o ID do médico
                        sugestoesDiv.style.display = 'none'; // Esconde a div de sugestões após a seleção
                        preencherConvenio(paciente.pk_cod_paci);
                    
                        // Remova o setTimeout e verifique o valor do convênio diretamente após o preenchimento
                        preencherConvenio(paciente.pk_cod_paci).then(() => {
                            let convenioId = document.getElementById('convenio_id').value;
                            console.log("Valor do convênio:", convenioId); // Exibe o valor no console
                    
                            // Verifique se o valor ainda é undefined
                            if (convenioId === undefined || convenioId === '') {
                                console.error("O valor do convênio é undefined ou vazio.");
                            }
                        });
                    
                        sugestoesDiv.style.display = 'none';
                    };
                    sugestoesDiv.appendChild(item);
                });
                sugestoesDiv.style.display = 'block';
            } else {
                sugestoesDiv.innerHTML = '<div class="list-group-item">Paciente não cadastrado</div>';
                sugestoesDiv.style.display = 'block';
            }
        })
        .catch(error => console.error('Erro:', error));
}


// Função para buscar médicos no modal de agendamento
function buscarMedico(query) {
    console.log("Buscando medico com a consulta:", query); // Loga a consulta no console
    const sugestoesDiv = document.getElementById('medicoSuggestions'); // Obtém a div para sugestões

    // Se a consulta for vazia, esconde as sugestões e limpa o conteúdo
    if (query.length < 1) {
        sugestoesDiv.style.display = 'none'; // Esconde a div
        sugestoesDiv.innerHTML = ''; // Limpa o conteúdo
        return; // Sai da função
    }

    // Faz uma requisição para buscar médicos que correspondam à consulta
    fetch(`/medico/buscar?query=${query}`)
        .then(response => response.json()) // Converte a resposta em JSON
        .then(data => {
            sugestoesDiv.innerHTML = ''; // Limpa sugestões anteriores
            if (data.length > 0) { // Se houver médicos retornados
                // Para cada médico retornado, cria um item de sugestão
                data.forEach(medico => {
                    const item = document.createElement('a'); // Cria um novo elemento <a> para a sugestão
                    item.className = 'list-group-item list-group-item-action'; // Define classes para estilização
                    item.href = '#'; // Define o href como '#' para que não redirecione
                    item.textContent = medico.nome_med; // Use o nome do médico
                    item.dataset.id = medico.pk_crm_med; // Armazena o ID do médico

                    // Adiciona um evento de clique para o item de sugestão
                    item.onclick = function () {
                        document.getElementById('medico').value = medico.pk_crm_med; // Preenche o campo oculto com o ID do médico
                        document.getElementById('medico_nome').value = medico.nome_med; // Se você tiver um campo para o nome do médico
                        sugestoesDiv.style.display = 'none'; // Esconde a div de sugestões após a seleção
                    };
                    sugestoesDiv.appendChild(item); // Adiciona o item de sugestão à div
                });
                sugestoesDiv.style.display = 'block'; // Exibe a div de sugestões
            } else {
                sugestoesDiv.style.display = 'none'; // Esconde a div se não houver sugestões
            }
        })
        .catch(error => console.error('Erro:', error)); // Tratamento de erro na requisição
}

function preencherConvenio(pacienteId) {
    return fetch(`/api/pacientes/${pacienteId}`)
        .then(response => response.json())
        .then(data => {
            console.log('Dados recebidos:', data); // Verifique a estrutura exata dos dados

            if (data && data.convenio && data.convenio.nome_conv) {
                document.getElementById('convenio_id').value = data.convenio.nome_conv; // Preencha com 'nome_conv'
                console.log("Convênio preenchido:", data.convenio.nome_conv); // Verifique se o valor está correto
            } else {
                console.error('A estrutura dos dados não contém o nome do convênio');
            }
        })
        .catch(error => {
            console.error('Erro ao buscar os dados do paciente:', error);
        });
}

// Função para ocultar sugestões ao clicar fora
document.addEventListener('click', function(event) {
    const sugestoesDivPaciente = document.getElementById('pacienteSuggestions');
    const sugestoesDivMedico = document.getElementById('medicoSuggestions');

    // Verifica se o clique foi fora das sugestões de pacientes
    if (sugestoesDivPaciente && !sugestoesDivPaciente.contains(event.target) && event.target.id !== 'paciente') {
        sugestoesDivPaciente.style.display = 'none'; // Esconde as sugestões de pacientes
    }

    // Verifica se o clique foi fora das sugestões de médicos
    if (sugestoesDivMedico && !sugestoesDivMedico.contains(event.target) && event.target.id !== 'medico') {
        sugestoesDivMedico.style.display = 'none'; // Esconde as sugestões de médicos
    }
});



