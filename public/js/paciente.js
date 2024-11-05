
            function aplicarMascaraCPF(input) {
                let cpf = input.value.replace(/\D/g, '');
                if (cpf.length <= 11) {
                    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
                    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
                    cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                }
                input.value = cpf;
            }

            function TestaCPF(strCPF) {
                let Soma = 0;
                let Resto;
                strCPF = strCPF.replace(/\D/g, '');
                if (!/^\d{11}$/.test(strCPF) || /^(\d)\1{10}$/.test(strCPF)) return false;

                for (let i = 1; i <= 9; i++) {
                    Soma += parseInt(strCPF.charAt(i - 1)) * (11 - i);
                }
                Resto = (Soma * 10) % 11;
                if (Resto === 10 || Resto === 11) Resto = 0;
                if (Resto !== parseInt(strCPF.charAt(9))) return false;

                Soma = 0;
                for (let i = 1; i <= 10; i++) {
                    Soma += parseInt(strCPF.charAt(i - 1)) * (12 - i);
                }
                Resto = (Soma * 10) % 11;
                if (Resto === 10 || Resto === 11) Resto = 0;

                return Resto === parseInt(strCPF.charAt(10));
            }

            document.addEventListener('DOMContentLoaded', function () {
                const form = document.getElementById('paciente-form');
                const cpfInput = document.getElementById('cpf_paci');

                form.addEventListener('submit', function (event) {
                    const cpfValue = cpfInput.value.replace(/\D/g, '');
                    if (!TestaCPF(cpfValue)) {
                        event.preventDefault();
                        document.getElementById('cpf-error').textContent = 'CPF inválido!';
                    } else {
                        document.getElementById('cpf-error').textContent = '';
                    }
                });

                cpfInput.addEventListener('input', function () {
                    const cpfValue = cpfInput.value.replace(/\D/g, '');
                    if (cpfValue.length < 11) {
                        document.getElementById('cpf-error').textContent = '';
                        return;
                    }
                    if (!TestaCPF(cpfValue)) {
                        document.getElementById('cpf-error').textContent = 'CPF inválido!';
                    } else {
                        document.getElementById('cpf-error').textContent = '';
                    }
                });
            });

            document.addEventListener('DOMContentLoaded', function () {
    const cpfResponsavelInput = document.getElementById('cpf_responsavel_paci');

    // Validação ao digitar no CPF do responsável
    cpfResponsavelInput.addEventListener('input', function () {
        const cpfValue = cpfResponsavelInput.value.replace(/\D/g, '');
        if (cpfValue.length < 11) {
            document.getElementById('cpf-error-responsavel').textContent = '';
            return;
        }
        if (!TestaCPF(cpfValue)) {
            document.getElementById('cpf-error-responsavel').textContent = 'CPF inválido!';
        } else {
            document.getElementById('cpf-error-responsavel').textContent = '';
        }
    });
});
            // Função para alternar campos de responsável com base na idade
            document.addEventListener('DOMContentLoaded', function () {
                const dataNasciInput = document.getElementById('data_nasci_paci');
                const responsavelFields = document.getElementById('responsavel-fields');

                function toggleResponsavelFields() {
                    const birthDate = new Date(dataNasciInput.value);
                    const age = new Date().getFullYear() - birthDate.getFullYear();
                    if (age < 18) {
                        responsavelFields.style.display = 'block';
                        document.getElementById('cpf_responsavel_paci').setAttribute('required', true);
                        document.getElementById('responsavel_paci').setAttribute('required', true);
                    } else {
                        responsavelFields.style.display = 'none';
                        document.getElementById('cpf_responsavel_paci').removeAttribute('required');
                        document.getElementById('responsavel_paci').removeAttribute('required');
                    }
                }

                dataNasciInput.addEventListener('input', toggleResponsavelFields);
                toggleResponsavelFields(); // Check on page load
            });

            // Função para carregar convênios
            document.addEventListener('DOMContentLoaded', function () {
                fetch('/convenio')
                    .then(response => response.json())
                    .then(data => {
                        const select = document.getElementById('fk_convenio_paci');
                        data.forEach(convenio => {
                            const option = document.createElement('option');
                            option.value = convenio.pk_id_conv;
                            option.text = convenio.nome_conv;
                            select.add(option);
                        });
                    })
                    .catch(error => console.error('Erro ao carregar convênios:', error));
            });

            // Função para alternar campo da Carteira do Convênio
            document.addEventListener('DOMContentLoaded', function () {
                const convenioSelect = document.getElementById('fk_convenio_paci');
                const carteiraConvenioField = document.getElementById('carteira-convenio-field');
                const carteiraConvenioInput = document.getElementById('carteira_convenio_paci');

                convenioSelect.addEventListener('change', function () {
                    if (this.value === '1') { // Altere o valor conforme necessário
                        carteiraConvenioField.style.display = 'none';
                        carteiraConvenioInput.removeAttribute('required');
                    } else {
                        carteiraConvenioField.style.display = 'block';
                        carteiraConvenioInput.setAttribute('required', true);
                    }
                });
            });

            // Função para aplicar máscara de telefone
            function aplicarMascaraTelefone(input) {
                let telefone = input.value.replace(/\D/g, '');
                telefone = telefone.replace(/(\d{2})(\d)/, '($1) $2');
                telefone = telefone.replace(/(\d{4})(\d)/, '$1-$2');
                input.value = telefone;
            }

            document.addEventListener('DOMContentLoaded', function () {
                const telefoneInput = document.getElementById('telefone_paci');
                telefoneInput.addEventListener('input', function () {
                    aplicarMascaraTelefone(telefoneInput);
                });
            });
