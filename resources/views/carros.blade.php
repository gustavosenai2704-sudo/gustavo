<div>
    <!DOCTYPE html>
    <html lang="PT-BR">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro de Carros</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <div class="container mt-5">
        <h2>Cadastrar Carro</h2>

        <form action="" method="POST">
            @csrf

            <div class="mb-3">
                <label for="marca" class="form-label">Marca</label>
                <input type="text" name="marca" id="marca" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" name="modelo" id="modelo" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="ano" class="form-label">Ano</label>
                <input type="number" name="ano" id="ano" class="form-control">
            </div>

            <div class="mb-3">
                <label for="cor" class="form-label">Cor</label>
                <input type="text" name="cor" id="cor" class="form-control">
            </div>

            <div class="mb-3">
                <label for="preco" class="form-label">Preço</label>
                <input type="number" step="0.01" name="preco" id="preco" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>


</div>
