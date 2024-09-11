@extends('Layout/configuracoes')

@section('nav-gerais')
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="config-gerais">Gerais</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" aria-current="page" href="config-procedimentos">Procedimentos</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" aria-current="page" href="config-convenios">Convênios</a>
  </li>
@endsection

@section('main-configuracoes')

        <div>
            <h1>Dados da Clínica</h1>
            <form class="row g-3">
              @csrf
              <div class="col-md-6">
                <label for="inputNome" class="form-label">NOME</label>
                <input type="text" class="form-control" id="inputNome" required>
              </div>
              <div class="col-md-6">
                <label for="inputCNPJ" class="form-label">CNPJ</label>
                <input type="number" class="form-control" id="inputCNPJ" required>
              </div>
              <div class="mb-3">
                <label for="FormControlDescricao" class="form-label">DESCRIÇÃO</label>
                <textarea class="form-control" id="FormControlDescricao" rows="3" required></textarea>
              </div>
              <div class="col-md-4">
                <label for="inputTelRecepcao" class="form-label">TELEFONE DA RECEPÇÃO</label>
                <input type="tel" class="form-control" id="inputTelRecepcao" required>
              </div>
              <div class="col-md-4">
                <label for="inputEmailAtendimentoClinica" class="form-label">E-MAIL DE ATENDIMENTO DA CLÍNICA</label>
                <input type="email" class="form-control" id="inputEmailAtendimentoClinica" required>
              </div>
              <div class="col-md-4">
                <label for="inputEmailResponsavelClinica" class="form-label">E-MAIL RESPONSÁVEL PELA CLÍNICA</label>
                <input type="email" class="form-control" id="inputEmailResponsavelClinica" required>
              </div>

              <h1>Endereço</h1>
              <div>
                <div class="col-md-3">
                  <label for="inputCEP" class="form-label">CEP</label>
                  <input type="number" class="form-control" id="inputCEP" required>
                </div>
                <h5>*INFORME O CEP PARA O PREENCHIMENTO AUTOMÁTICO DOS DADOS</h5>
              </div>
              <div class="col-md-6">
                <label for="inputLogradouro" class="form-label">LOGRADOURO</label>
                <input type="text" class="form-control" id="inputLogradouro" required>
              </div>
              <div class="col-md-2">
                <label for="inputNumeroEstabelecimento" class="form-label">NÚMERO</label>
                <input type="number" class="form-control" id="inputNumeroEstabelecimento" required>
              </div>
              <div class="col-md-4">
                <label for="inputCBairro" class="form-label">BAIRRO</label>
                <input type="text" class="form-control" id="inputCBairro" required>
              </div>
              <div class="col-md-4">
                <label for="inputComplemento" class="form-label">COMPLEMENTO</label>
                <input type="text" class="form-control" id="inputComplemento" required>
              </div>
              <div class="col-md-4">
                <label for="inputCidade" class="form-label">CIDADE</label>
                <input type="text" class="form-control" id="inputCidade" required>
              </div>
              <div class="col-md-2">
                <label for="inputUF" class="form-label">UF (ESTADO)</label>
                <input type="text" class="form-control" id="inputUF" required>
              </div>
              <div class="col-md-2">
                <label for="inputCodIBGE" class="form-label">CÓD. IBGE</label>
                <input type="number" class="form-control" id="inputCodIBGE" required>
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-primary">Salvar</button>
              </div>
            </form>
    </div> {{-- fim da container --}}
@endsection