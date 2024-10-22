// Função para buscar pacientes com base em uma consulta
function buscarPacientes(query) {
    const sugestoesDiv = document.getElementById('pacienteSuggestions'); // Obtém a div para sugestões

    // Se a consulta for vazia, esconde as sugestões e limpa o conteúdo
    if (query.length < 1) {
        sugestoesDiv.style.display = 'none'; // Esconde a div
        sugestoesDiv.innerHTML = ''; // Limpa o conteúdo
        return; // Sai da função
    }

    // Faz uma requisição para buscar pacientes que correspondam à consulta
    fetch(`/pacientes/buscar?query=${query}`)
        .then(response => response.json()) // Converte a resposta em JSON
        .then(data => {
            sugestoesDiv.innerHTML = ''; // Limpa sugestões anteriores
            if (data.length > 0) { // Se houver pacientes retornados
                // Para cada paciente retornado, cria um item de sugestão
                data.forEach(paciente => {
                    const dataNascimento = new Date(paciente.data_nasci_paci); // Converte a data de nascimento para objeto Date
                    const dataFormatada = dataNascimento.toLocaleDateString('pt-BR'); // Formata a data para o padrão brasileiro

                    const item = document.createElement('a'); // Cria um novo elemento <a> para a sugestão
                    item.className = 'list-group-item list-group-item-action'; // Define classes para estilização
                    item.href = '#'; // Define o href como '#' para que não redirecione
                    item.textContent = `${paciente.nome_paci} - ${dataFormatada}`; // Define o texto da sugestão

                    // Adiciona um evento de clique para o item de sugestão
                    item.onclick = function () {
                        document.getElementById('paciente').value = paciente.nome_paci; // Preenche o campo com o nome do paciente

                        // Busca o convênio do paciente selecionado
                        fetch(`/convenio/buscar-por-paciente?pacienteId=${paciente.pk_cod_paci}`) // Faz uma requisição para buscar o convênio
                            .then(response => response.json()) // Converte a resposta em JSON
                            .then(convenioData => {
                                const convenioSelect = document.getElementById('convenio'); // Obtém o campo de convênio
                                convenioSelect.value = convenioData.convenio_id; // Atualiza o campo de convênio com o ID retornado
                                convenioSelect.dispatchEvent(new Event('change')); // Dispara um evento de mudança para atualizar o estado do select
                            })
                            .catch(error => console.error('Erro ao buscar convênio:', error)); // Tratamento de erro na busca do convênio

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
