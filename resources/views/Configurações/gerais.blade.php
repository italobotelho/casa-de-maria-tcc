@extends('Layout/layout')

@section('main')


    <h1>Configurações</h1>


    <div class="container border">
        <ul class="nav nav-underline nav-fill justify-content-center">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="config-gerais">Gerais</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="config-procedimentos">Procedimentos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="config-convenios">Convênios</a>
            </li>
        </ul>

        <div>
            <h1>Dados da Clínica</h1>
            <form class="row g-3">
              <div class="col-md-6">
                <label for="inputNome" class="form-label">NOME</label>
                <input type="text" class="form-control" id="inputNome">
              </div>
              <div class="col-md-6">
                <label for="inputCNPJ" class="form-label">CNPJ</label>
                <input type="number" class="form-control" id="inputCNPJ">
              </div>
              <div class="mb-3">
                <label for="FormControlDescricao" class="form-label">DESCRIÇÃO</label>
                <textarea class="form-control" id="FormControlDescricao" rows="3"></textarea>
              </div>
              <div class="col-md-4">
                <label for="inputTelRecepcao" class="form-label">TELEFONE DA RECEPÇÃO</label>
                <input type="tel" class="form-control" id="inputTelRecepcao">
              </div>
              <div class="col-md-4">
                <label for="inputEmailAtendimentoClinica" class="form-label">E-MAIL DE ATENDIMENTO DA CLÍNICA</label>
                <input type="email" class="form-control" id="inputEmailAtendimentoClinica">
              </div>
              <div class="col-md-4">
                <label for="inputEmailResponsavelClinica" class="form-label">E-MAIL RESPONSÁVEL PELA CLÍNICA</label>
                <input type="email" class="form-control" id="inputEmailResponsavelClinica">
              </div>

              <h1>Endereço</h1>
              <div>
                <div class="col-md-3">
                  <label for="inputCEP" class="form-label">CEP</label>
                  <input type="number" class="form-control" id="inputCEP">
                </div>
                <h5>*INFORME O CEP PARA O PREENCHIMENTO AUTOMÁTICO DOS DADOS</h5>
              </div>
              <div class="col-md-6">
                <label for="inputLogradouro" class="form-label">LOGRADOURO</label>
                <input type="text" class="form-control" id="inputLogradouro">
              </div>
              <div class="col-md-2">
                <label for="inputNumeroEstabelecimento" class="form-label">NÚMERO</label>
                <input type="number" class="form-control" id="inputNumeroEstabelecimento">
              </div>
              <div class="col-md-4">
                <label for="inputCBairro" class="form-label">BAIRRO</label>
                <input type="text" class="form-control" id="inputCBairro">
              </div>
              <div class="col-md-4">
                <label for="inputComplemento" class="form-label">COMPLEMENTO</label>
                <input type="text" class="form-control" id="inputComplemento">
              </div>
              <div class="col-md-4">
                <label for="inputCidade" class="form-label">CIDADE</label>
                <input type="text" class="form-control" id="inputCidade">
              </div>
              <div class="col-md-2">
                <label for="inputUF" class="form-label">UF (ESTADO)</label>
                <input type="text" class="form-control" id="inputUF">
              </div>
              <div class="col-md-2">
                <label for="inputCodIBGE" class="form-label">CÓD. IBGE</label>
                <input type="number" class="form-control" id="inputCodIBGE">
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-primary">Salvar</button>
              </div>
            </form>
    </div> {{-- fim da container --}}
@endsection