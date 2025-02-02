<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recomendação de Treino</title>
    <link href="models/style.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Recomendação de Treino</h1>
        <div id="conteudo-container" class="mt-4 p-3 border rounded bg-light">
            <?php
            // Resposta do ChatGPT
            $conteudo = isset($_GET['conteudo']) ? $_GET['conteudo'] : 'Nenhuma resposta foi gerada.';
            $nomeAluno = isset($_GET['nome']) ? $_GET['nome'] : 'Aluno não identificado';
            $temperatura = isset($_GET['temperatura']) ? $_GET['temperatura'] : 'Temperatura não informada';
            $prompt = isset($_GET['tipo_prompt']) ? $_GET['tipo_prompt'] : 'Prompt não informado';
            $variaveis = isset($_GET['variaveis']) ? $_GET['variaveis'] : 'Variavel não informado';
            ?>
            <textarea style="display:none;" id="variaveis" rows="9" cols="150" style="resize: none;"><?php echo htmlspecialchars($variaveis); ?></textarea>
            <textarea id="conteudo" rows="30" cols="150" style="resize: none;"><?php echo htmlspecialchars($conteudo); ?></textarea>
        </div>
        <div class="text-center mt-4">
            <button class="btn btn-primary" id="btnSalvarPDF">Salvar em PDF</button>
            <a href="index.php?nocache=<?php echo time(); ?>" class="btn btn-secondary">Gerar novo Treino</a>
        </div>
    </div>

    <script>
        // Função para salvar o conteúdo do textarea em PDF
        document.getElementById('btnSalvarPDF').addEventListener('click', function () {
            // Certifique-se de que o jsPDF está carregado corretamente
            const { jsPDF } = window.jspdf;

            // Verifique se o jsPDF foi carregado
            if (!jsPDF) {
                alert("Erro: jsPDF não está disponível.");
                return;
            }

            const doc = new jsPDF();

            // Define as margens
            const margemX = 10;
            const margemY = 10;
            const alturaMaxima = doc.internal.pageSize.height - margemY * 2; // Altura útil da página

            const nomeAluno = "<?php echo $nomeAluno; ?>";
            const temperatura = "<?php echo $temperatura; ?>";
            const prompt = "<?php echo $prompt; ?>";

            doc.setFont('Helvetica', 'bold'); // Fonte Helvetica em negrito
            doc.setFontSize(18); // Tamanho da fonte
            doc.text('Treino do aluno: ' + nomeAluno, margemX, margemY); // Texto do cabeçalho

            doc.setDrawColor(0); // Preto
            doc.setLineWidth(0.5);
            doc.line(margemX, margemY + 5, doc.internal.pageSize.width - margemX, margemY + 5);
            
            const variaveis = document.getElementById('variaveis').value;
            doc.setFont('Helvetica'); // Fonte Helvetica em negrito
            doc.setFontSize(12); // Tamanho da fonte
            doc.text(variaveis, margemX, margemY + 15); // Texto do cabeçalho
            
            doc.setDrawColor(0); // Preto
            doc.setLineWidth(0.5);
            doc.line(margemX, margemY + 55, doc.internal.pageSize.width - margemX, margemY + 55);

            let posY = margemY + 65; // Posição inicial do conteúdo
            // Pega o conteúdo do textarea
            const conteudo = document.getElementById('conteudo').value;
            const linhasConteudo = doc.splitTextToSize(conteudo, doc.internal.pageSize.width - 2 * margemX);

            // Configurações da fonte para o conteúdo
            doc.setFont('Times', 'normal'); // Fonte Times New Roman normal
            doc.setFontSize(12); // Tamanho da fonte padrão

            // Adiciona o conteúdo ao PDF, lidando com múltiplas páginas
            for (let i = 0; i < linhasConteudo.length; i++) {
                if (posY + 7 > alturaMaxima) { // Se ultrapassar o limite da página
                    doc.addPage();
                    posY = margemY; // Resetar a posição para o topo da nova página
                }
                doc.text(linhasConteudo[i], margemX, posY);
                posY += 7; // Incremento da posição para próxima linha
            }
            // Salva o PDF com o nome desejado
            doc.save(nomeAluno + '_T ' + temperatura + '_Prompt ' + prompt + '.pdf');
        });
    </script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
