// Função para buscar pacientes com base em uma consulta
function buscarPacientes(query) {
    const sugestoesDiv = document.getElementById('pacienteSuggestions'); // Obtém o elemento onde as sugestões de pacientes serão exibidas

    // Se a consulta estiver vazia, esconde as sugestões e limpa o conteúdo
    if (query.length < 1) {
        sugestoesDiv.style.display = 'none'; // Esconde a div de sugestões
        sugestoesDiv.innerHTML = ''; // Limpa o conteúdo da div
        return; // Sai da função
    }

    // Faz uma requisição para buscar pacientes que correspondam à consulta
    fetch(`/pacientes/buscar?query=${query}`)
        .then(response => response.json()) // Converte a resposta da requisição para JSON
        .then(data => {
            sugestoesDiv.innerHTML = ''; // Limpa sugestões anteriores
            if (data.length > 0) { // Se houver pacientes retornados
                // Para cada paciente retornado, cria um item de sugestão
                data.forEach(paciente => {
                    const dataNascimento = new Date(paciente.data_nasci_paci); // Cria um objeto de data a partir da data de nascimento do paciente
                    const dataFormatada = dataNascimento.toLocaleDateString('pt-BR'); // Formata a data para o padrão brasileiro

                    const item = document.createElement('a'); // Cria um novo elemento <a> para a sugestão
                    item.className = 'list-group-item list-group-item-action'; // Define classes para estilização
                    item.href = '#'; // Define o href como '#' para que não redirecione
                    item.textContent = `${paciente.nome_paci} - ${dataFormatada}`; // Define o texto da sugestão com o nome do paciente e a data formatada

                    // Adiciona um evento de clique para o item de sugestão
                    item.onclick = function () {
                        document.getElementById('paciente').value = paciente.nome_paci; // Preenche o campo com o nome do paciente
                        preencherConvenio(paciente.pk_cod_paci); // Chama a função para preencher o convênio do paciente

                        // Remova o setTimeout e verifique o valor do convênio diretamente após o preenchimento
                        preencherConvenio(paciente.pk_cod_paci).then(() => {
                            let convenioId = document.getElementById('convenio_id').value; // Obtém o ID do convênio preenchido
                            console.log("Valor do convênio:", convenioId); // Exibe o valor no console

                            // Verifica se o valor ainda é undefined
                            if (convenioId === undefined || convenioId === '') {
                                console.error("O valor do convênio é undefined ou vazio."); // Exibe erro no console se o valor for inválido
                            }
                        });

                        sugestoesDiv.style.display = 'none'; // Esconde as sugestões após a seleção
                    };
                    sugestoesDiv.appendChild(item); // Adiciona o item de sugestão à div
                });
                sugestoesDiv.style.display = 'block'; // Exibe a div de sugestões
            } else {
                // Se não houver pacientes, exibe uma mensagem
                sugestoesDiv.innerHTML = '<div class="list-group-item">Paciente não cadastrado</div>';
                sugestoesDiv.style.display = 'block'; // Exibe a div de sugestões
            }
        })
        .catch(error => console.error('Erro:', error)); // Tratamento de erro na requisição
}

// Função para buscar médicos no modal de agendamento
function buscarMedico(query) {
    console.log("Buscando medico com a consulta:", query); // Loga a consulta no console
    const sugestoesDiv = document.getElementById('medicoSuggestions'); // Obtém a div para sugestões de médicos

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
                data.forEach(nome => {
                    const item = document.createElement('a'); // Cria um novo elemento <a> para a sugestão
                    item.className = 'list-group-item list-group-item-action'; // Define classes para estilização
                    item.href = '#'; // Define o href como '#' para que não redirecione
                    item.textContent = nome; // Define o texto da sugestão como o nome do médico

                    // Adiciona um evento de clique para o item de sugestão
                    item.onclick = function () {
                        document.getElementById('medico').value = nome; // Preenche o campo com o nome do médico
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

// Função para preencher o convênio do paciente
function preencherConvenio(pacienteId) {
    return fetch(`/api/pacientes/${pacienteId}`) // Faz uma requisição para obter os dados do paciente
        .then(response => response.json()) // Converte a resposta em JSON
        .then(data => {
            console.log('Dados recebidos:', data); // Exibe os dados recebidos no console

            // Verifica se a estrutura dos dados contém as informações do convênio
            if (data && data.convenio && data.convenio.nome_conv) {
                document.getElementById('convenio_id').value = data.convenio.nome_conv; // Preenche o campo com o nome do convênio
                console.log("Convênio preenchido:", data.convenio.nome_conv); // Exibe o valor preenchido no console
            } else {
                console.error('A estrutura dos dados não contém o nome do convênio'); // Log de erro se a estrutura for inesperada
            }
        })
        .catch(error => {
            console.error('Erro ao buscar os dados do paciente:', error); // Tratamento de erro na requisição
        });
}

// Função para ocultar sugestões ao clicar fora
document.addEventListener('click', function(event) {
    const sugestoesDivPaciente = document.getElementById('pacienteSuggestions'); // Obtém a div de sugestões de pacientes
    const sugestoesDivMedico = document.getElementById('medicoSuggestions'); // Obtém a div de sugestões de médicos

    // Verifica se o clique foi fora das sugestões de pacientes
    if (sugestoesDivPaciente && !sugestoesDivPaciente.contains(event.target) && event.target.id !== 'paciente') {
        sugestoesDivPaciente.style.display = 'none'; // Esconde as sugestões de pacientes
    }

    // Verifica se o clique foi fora das sugestões de médicos
    if (sugestoesDivMedico && !sugestoesDivMedico.contains(event.target) && event.target.id !== 'medico') {
        sugestoesDivMedico.style.display = 'none'; // Esconde as sugestões de médicos
    }
});
