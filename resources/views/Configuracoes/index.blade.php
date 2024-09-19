@extends('Layout/configuracoes')

@section('nav-gerais')
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="gerais">Gerais</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" aria-current="page" href="procedimentos">Procedimentos</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" aria-current="page" href="convenios">Convênios</a>
  </li>
@endsection

@section('main-configuracoes')

        <div>
            <h1>Dados da Clínica</h1>
            <form class="row g-3" method="POST" action="{{ route('configuracoes.store') }}">
              @csrf
              <div class="col-md-6">
                <label for="inputNome" class="form-label">NOME</label>
                <input type="text" class="form-control" id="nome_clin" name="nome_clin" value="{{ old('nome_clin', $clinica?->nome_clin) }}" required>
              </div>
              <div class="col-md-6">
                <label for="inputCNPJ" class="form-label">CNPJ</label>
                <input type="number" class="form-control" id="cnpj_clin" name="cnpj_clin" value="{{ old('cnpj_clin', $clinica?->cnpj_clin) }}" required>
              </div>
              <div class="mb-3">
                <label for="FormControlDescricao" class="form-label">DESCRIÇÃO</label>
                <textarea class="form-control" id="descricao_clin" name="descricao_clin" rows="3" value="{{ old('descricao_clin', $clinica?->descricao_clin) }}" required></textarea>
              </div>
              <div class="col-md-4">
                <label for="inputTelRecepcao" class="form-label">TELEFONE DA RECEPÇÃO</label>
                <input type="number" class="form-control" id="telefone_clin" name="telefone_clin" value="{{ old('telefone_clin', $clinica?->telefone_clin) }}" required>
              </div>
              <div class="col-md-4">
                <label for="inputEmailAtendimentoClinica" class="form-label">E-MAIL DE ATENDIMENTO DA CLÍNICA</label>
                <input type="email" class="form-control" id="email_aten_clin" name="email_aten_clin" value="{{ old('email_aten_clin', $clinica?->email_aten_clin) }}" required>
              </div>
              <div class="col-md-4">
                <label for="inputEmailResponsavelClinica" class="form-label">E-MAIL RESPONSÁVEL P ELA CLÍNICA</label>
                <input type="email" class="form-control" id="email_resp_clin" name="email_resp_clin" value="{{ old('email_resp_clin', $clinica?->email_resp_clin) }}" required>
              </div>

              <h1>Endereço</h1>
              <div>
                <div class="col-md-3">
                  <label for="inputCEP" class="form-label">CEP</label>
                  <input type="text" class="form-control" id="cep_clin" name="cep_clin" value="{{ old('cep_clin', $clinica?->cep_clin) }}" size="10" maxlength="9" onblur="pesquisacep(this.value);">
                </div>
                <h5>*INFORME O CEP PARA O PREENCHIMENTO AUTOMÁTICO DOS DADOS</h5>
              </div>
              <div class="col-md-6">
                <label for="inputLogradouro" class="form-label">LOGRADOURO</label>
                <input type="text" class="form-control" id="rua_clin" name="rua_clin" value="{{ old('rua_clin', $clinica?->rua_clin) }}">
                </div>
                <div class="col-md-2">
                  <label for="inputNumeroEstabelecimento" class="form-label">NÚMERO</label>
                  <input type="number" class="form-control" id="numero_clin" name="numero_clin" value="{{ old('numero_clin', $clinica?->numero_clin) }}" size="10">
                </div>
                <div class="col-md-4">
                    <label for="inputCBairro" class="form-label">BAIRRO</label>
                    <input type="text" class="form-control" id="bairro_clin" name="bairro_clin" value="{{ old('bairro_clin', $clinica?->bairro_clin) }}" size="40">
                </div>
                <div class="col-md-4">
                    <label for="inputComplemento" class="form-label">COMPLEMENTO</label>
                    <input type="text" class="form-control" id="complemento_clin" name="complemento_clin" value="{{ old('complemento_clin', $clinica?->complemento_clin) }}" size="60">
                </div>
                <div class="col-md-4">
                    <label for="inputCidade" class="form-label">CIDADE</label>
                    <input type="text" class="form-control" id="cidade_clin" name="cidade_clin" value="{{ old('cidade_clin', $clinica?->cidade_clin) }}" size="40">
                </div>
                <div class="col-md-2">
                    <label for="inputUF" class="form-label">UF (ESTADO)</label>
                    <input type="text" class="form-control" id="uf_clin" name="uf_clin" value="{{ old('uf_clin', $clinica?->uf_clin) }}" size="2">
                </div>
                <div class="col-md-2">
                    <label for="inputCodIBGE" class="form-label">CÓD. IBGE</label>
                    <input type="text" class="form-control" id="cod_ibge_clin" name="cod_ibge_clin" value="{{ old('cod_ibge_clin', $clinica?->cod_ibge_clin) }}" size="8">
                </div>
              <div class="col-12">
                <button type="submit" class="btn btn-primary">Salvar</button>
              </div>
            </form>
    </div> {{-- fim da container --}}
@endsection