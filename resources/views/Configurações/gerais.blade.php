@extends('Layout/layout')

@section('main')


    <h1>Configurações</h1>


    <div class="container border">
        <ul class="nav nav-underline nav-fill justify-content-center">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="gerais">Gerais</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="procedimentos">Procedimentos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="convenios">Convênios</a>
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
                  <input type="text" class="form-control" id="inputCNPJ">
                </div>
                <div class="col-12">
                  <label for="inputAddress" class="form-label">Address</label>
                  <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                </div>
                <div class="col-12">
                  <label for="inputAddress2" class="form-label">Address 2</label>
                  <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                </div>
                <div class="col-md-6">
                  <label for="inputCity" class="form-label">City</label>
                  <input type="text" class="form-control" id="inputCity">
                </div>
                <div class="col-md-4">
                  <label for="inputState" class="form-label">State</label>
                  <select id="inputState" class="form-select">
                    <option selected>Choose...</option>
                    <option>...</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <label for="inputZip" class="form-label">Zip</label>
                  <input type="text" class="form-control" id="inputZip">
                </div>
                <div class="col-12">
                </div>
        </div>
        <div>
            <h1>Endereço</h1>
                <div class="col-12">
                  <label for="inputAddress" class="form-label">Address</label>
                  <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                </div>
                <div class="col-12">
                  <label for="inputAddress2" class="form-label">Address 2</label>
                  <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                </div>
                <div class="col-md-6">
                  <label for="inputCity" class="form-label">City</label>
                  <input type="text" class="form-control" id="inputCity">
                </div>
                <div class="col-md-4">
                  <label for="inputState" class="form-label">State</label>
                  <select id="inputState" class="form-select">
                    <option selected>Choose...</option>
                    <option>...</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <label for="inputZip" class="form-label">Zip</label>
                  <input type="text" class="form-control" id="inputZip">
                </div>
                <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                      Check me out
                    </label>
                  </div>
                </div>
                <div class="col-12">
                  <button type="submit" class="btn btn-primary">Sign in</button>
                </div>
              </form>
        </div>
    </div>
@endsection