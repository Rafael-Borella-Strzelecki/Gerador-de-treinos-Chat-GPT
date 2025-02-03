<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Aluno</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="models/style.css">
</head>
    <body>
        <div class="container mt-5">
            
            <h1 class="text-center mb-4">Dados do Aluno para Geração do Treino</h1>
            <form action="ApiChatGpt.php" method="POST" class="needs-validation" novalidate>
                <!-- Opções de prompts -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="tipo_prompt" class="form-label">Escolha o tipo de Prompt</label>
                            <select class="form-control" id="tipo_prompt" name="tipo_prompt" required>
                                <option value="">Selecione...</option>
                                <option value="zero_shot">Zero Shot</option>
                                <option value="one_shot">One Shot</option>
                                <option value="few_shot">Few Shot</option>
                                <option value="chain_of_thought">Chain of Thought</option>
                                <option value="chain_of_thought_one_shot">Chain of Thought + One Shot</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="temperatura" class="form-label">Escolha a temperatura</label>
                            <select class="form-control" id="temperatura" name="temperatura" required>
                                <option value="">Selecione...</option>
                                <option value="0.1">0.1</option>
                                <option value="0.2">0.2</option>
                                <option value="0.3">0.3</option>
                                <option value="0.4">0.4</option>
                                <option value="0.5">0.5</option>
                                <option value="0.6">0.6</option>
                                <option value="0.7">0.7</option>
                                <option value="0.8">0.8</option>
                                <option value="0.9">0.9</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                    <div class="invalid-feedback">Por favor, insira o nome do aluno.</div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="genero" class="form-label">Genero:</label>
                            <select class="form-control" id="genero" name="genero" required>
                                <option value="">Selecione...</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Feminino">Feminino</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="idade" class="form-label">Idade:</label>
                            <input type="number" class="form-control" id="idade" min="0" name="idade" required>
                            <div class="invalid-feedback">Por favor, insira a idade do aluno.</div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="tempo_treino" class="form-label">Experiencia de Treino:</label>
                    <select class="form-control" id="tempo_treino" name="tempo_treino" required>
                        <option value="">Selecione...</option>
                        <option value="Iniciante">Iniciante</option>
                        <option value="Intermedário">Intermedário</option>
                        <option value="Avançado">Avançado</option>
                    </select>
                    <div class="invalid-feedback">Por favor, escolha o tempo de treino.</div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="peso" class="form-label">Peso em Kg:</label>
                            <input type="number" class="form-control" id="peso" name="peso" min="0" required>
                            <div class="invalid-feedback">Por favor, insira o peso do aluno.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="altura" class="form-label">Altura em cm:</label>
                            <input type="number" class="form-control" id="altura" name="altura" min="0" required>
                            <div class="invalid-feedback">Por favor, insira a altura do aluno.</div>
                        </div>
                    </div>
                </div>        
                <div class="mb-3">
                    <label for="lesao_cirurgia" class="form-label">Possui lesão ou cirurgia?</label>
                    <select class="form-control" id="lesao_cirurgia" name="lesao_cirurgia" required onchange="toggleLesaoField(this)">
                        <option value="">Selecione...</option>
                        <option value="Não">Não</option>
                        <option value="Sim">Sim</option>
                    </select>
                    <div class="invalid-feedback">Por favor, informe se possui lesão ou cirurgia.</div>
                </div>
                <div class="mb-3 d-none" id="campo_lesao">
                    <label for="detalhe_lesao" class="form-label">Especifique a lesão ou cirurgia:</label>
                    <textarea class="form-control" id="detalhe_lesao" name="detalhe_lesao" rows="3"></textarea>
                    <div class="invalid-feedback">Por favor, detalhe a lesão ou cirurgia.</div>
                </div>
                <div class="mb-3">
                    <label for="gordura_corporal" class="form-label">Porcentagem de Gordura Corporal:</label>
                    <input type="number" class="form-control" id="gordura_corporal" name="gordura_corporal" step="0.1" min="0"required>
                    <div class="invalid-feedback">Por favor, insira a porcentagem de gordura corporal.</div>
                </div>
                <div class="mb-3">
                    <label for="objetivo" class="form-label">Selecione o objetivo do aluno:</label>
                    <select class="form-control" id="objetivo" name="objetivo" required>
                        <option value="">Selecione...</option>
                        <option value="Hipertrofia">Hipertrofia</option>
                        <option value="Resistencia">Resistencia</option>
                        <option value="Força">Força</option>
                    </select>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>
        </div>

        <script>
            function toggleLesaoField(select) {
                const lesaoField = document.getElementById('campo_lesao');
                if (select.value === 'Sim') {
                    lesaoField.classList.remove('d-none');
                    lesaoField.querySelector('textarea').setAttribute('required', 'required');
                } else {
                    lesaoField.classList.add('d-none');
                    lesaoField.querySelector('textarea').removeAttribute('required');
                }
            }
        </script>


        <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
