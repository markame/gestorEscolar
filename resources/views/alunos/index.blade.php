<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de alunos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@include('miscellaneous.nav');
<div class="container">
    <h1>Registro de Alunos</h1>
    <table class="table table-striped table-hover">
        <thead class="table-dark">
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">CPF</th>
            <th scope="col">Disciplinas</th>
            <th scope="col">Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($alunos as $aluno)
            <tr>
                <td>{{ $aluno->nome }}</td>
                <td>{{ $aluno->cpf }}</td>
                <td>
                    <ul>
                        @foreach($aluno->disciplinas as $disciplina)
                            <li>{{ $disciplina->nome_disciplina }}</li>
                        @endforeach
                    </ul>

                <td>
                    <form action="{{ route('excluir_aluno', $aluno->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-dark btn-sm">Apagar</button>
                    </form>
                    <button class="btn btn-secondary btn-sm"
                            onclick="openEditModal('{{ $aluno->nome }}', '{{ $aluno->cpf }}')">Editar
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Aluno</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST" action="{{route('alterar_aluno',$aluno->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome">
                    </div>
                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" class="form-control" id="cpf" name="cpf">
                    </div>

                    <div class="mb-3">
                        <label for="disciplinas" class="form-label">Disciplinas</label>
                        <select class="form-select" id="disciplinas" name="disciplinas[]" multiple>
                            @foreach($disci as $disciplina)
                                <option value="{{ $disciplina->id }}"
                                    {{ $aluno->disciplinas->contains($disciplina) ? 'selected' : '' }}>
                                    {{ $disciplina->nome_disciplina }}
                                </option>
                            @endforeach
                        </select>
                    </div>



                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function openEditModal(nome, cpf) {
        $('#nome').val(nome);
        $('#cpf').val(cpf);
        var myModal = new bootstrap.Modal(document.getElementById('editModal'), {
            keyboard: false
        });
        myModal.show();
    }
</script>

</body>
</html>
