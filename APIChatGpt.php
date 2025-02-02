<?php
// Receber post tipos prompts
$tipo_prompt = $_POST['tipo_prompt'];


// Captura os dados do formulário
$temperatura = floatval($_POST['temperatura']);
$nome = $_POST['nome'] ?? ''; // OK
$genero = $_POST['genero'] ?? ''; // OK
$idade = $_POST['idade'] ?? ''; // OK
$tempo_treino = $_POST['tempo_treino'] ?? ''; //OK
$altura = $_POST['altura'] ?? ''; // OK
$peso = $_POST['peso'] ?? ''; // OK
$lesao_cirurgia = $_POST['lesao_cirurgia'] ?? ''; 
$detalhe_lesao = $_POST['detalhe_lesao'] ?? '';
$gordura_corporal = $_POST['gordura_corporal'] ?? '';
$objetivo = $_POST['objetivo'] ?? '';
$lesao = $lesao_cirurgia;

if ($lesao === 'Sim'){
    $lesao = "$lesao_cirurgia, $detalhe_lesao";
}
$variaveis = "
- Gênero: $genero
- Idade: $idade
- Experiência de treino: $tempo_treino
- Altura: $altura cm
- Peso: $peso Kg
- Possui lesão? $lesao
- Percentual de Gordura Corporal: $gordura_corporal %
- Objetivo: $objetivo";
$pedido = "Crie um plano de treino detalhado para academia considerando as seguintes informações de um aluno:";
$persona = "Você é um profissional de educação fisica experiente que atua como Personal Trainer prescrevendo treinos de academia";
$cot = "Por favor, explique seu raciocínio passo a passo e depois apresente um plano de treino de academia completo.";

// Formata a pergunta para o ChatGPT
$pergunta = "$pedido\n
- Gênero: $genero\n
- Idade: $idade\n
- Experiência de treino: $tempo_treino\n
- Altura: $altura cm\n
- Peso: $peso Kg\n
- Possui lesão? $lesao\n
- Percentual de Gordura Corporal: $gordura_corporal %\n
- Objetivo: $objetivo\n
";

$pergunta1 = "$pedido\n
- Gênero: Masculino\n
- Idade: 28\n
- Experiência de treino: Avançado\n
- Altura: 180 cm\n
- Peso: 105 Kg\n
- Possui lesão? Não\n
- Percentual de Gordura Corporal: 18 %\n
- Objetivo: Hipertrofia\n
";

$pergunta2 = "$pedido\n
- Gênero: Masculino\n
- Idade: 29\n
- Experiência de treino: Avançado\n
- Altura: 170 cm\n
- Peso: 100 Kg\n
- Possui lesão? Não\n
- Percentual de Gordura Corporal: 15 %\n
- Objetivo: Hipertrofia\n
";

$pergunta3 = "$pedido\n
- Gênero: Feminino\n
- Idade: 45\n
- Experiência de treino: Iniciante\n
- Altura: 175 cm\n
- Peso: 77 Kg\n
- Possui lesão? Não\n
- Percentual de Gordura Corporal: 20 %\n
- Objetivo: Resistência\n
";

$exemplo1 = "PLANO DE TREINO\n
Treino A\n
Exercícios: Rosca Martelo (Halter) 4x, Rosca Direta (Cross) 4x, Rosca Scott (Máquina ou Barra) 4x,\n
Rosca Testa Supinada (Barra) 4x, Tríceps Pulley (Pronado) 4x, Rosca Testa Neutra (Halteres) 4x,\n
Descanso de 1 a 2 minutos entre as séries. Repetições de 8 a 12 em todos os exercícios.\n
Treino B\n
Exercícios: Desenvolvimento (Máquina) 4x, Elevação Lateral (Halter) 4x, Crucifixo Inverso (Cross) 4x, Elevação Frontal (Halter – Pegada Neutra) 4x,\n
Infra 4x, Oblíquos 1x, Prancha 2x\n
Descanso de 1 a 2 minutos entre as séries. Repetições de 8 a 12 em todos os exercícios.\n
Treino C\n
Exercícios: Mesa Flexora 4x, Agachamento (Hack ou Máquina) 4x, Cadeira Adutora 4x, Cadeira Extensora 4x, Elevação Pélvica (Barra ou Máquina) 3x,\n
Descanso de 2 a 3 minutos entre as séries. Repetições de 12 a 16 em todos os exercícios.\n
Treino D\n
Exercícios: Gêmeos Sentado (Máquina, Smith ou Livre) 5x, Gêmeos Leg Press 5x,\n
Encolhimento Unilateral (Cross) 4x, Remada Alta (Barra ou Smith) 4x, Remada Alta (Cross) 4x,\n
Supra 4x, Oblíquos 1x, Prancha 2x\n
Descanso de 1 a 2 minutos entre as séries. Repetições de 8 a 12 em todos os exercícios.\n
Treino E\n
Exercícios: Puxada Vertical (Pronada) 4x, Remada Máquina (Supinada ou Neutra) 4x, Puxada Vertical (Supinada) 4x, Remada Halter (Neutra) 4x, Extensão Lombar 2x,\n
Rosca Inversa (Barra ou Halter) 4x, Extensão de Punho (Barra ou Halter) 4x,\n
Descanso de 1 a 2 minutos entre as séries. Repetições de 8 a 12 em todos os exercícios.\n
Treino F\n
Exercícios: Cross Over (Polia Alta) 4x, Supino Reto (Barra ou Smith) 4x, Crucifixo Inclinado 4x, Supino Reto (Halteres) 4x,\n 
Oblíquos 1x, Supra 4x, Prancha 2x\n
Descanso de 1 a 2 minutos entre as séries. Repetições de 8 a 12 em todos os exercícios.\n 
\n
ORGANIZAÇÃO SEMANAL\n
Dia 1: Treino A, Dia 2: Treino B, Dia 3: Treino C, Dia 4: Treino D, Dia 5: Treino E, Dia 6: Treino F, Dia 7: Repouso.
";
$exemplo2 = "PLANO DE TREINO\n
Treino A\n
Exercícios: Remada curvada 4x,Puxada alta 3x, Remada cavalinho 4x, Puxada baixa fechada 3x, Remada convergente Unilateral 4x, Rosca concentrada 4x, Rosca direta 4x\n
Descanso de 1 a 2 minutos entre as séries. Repetições de 8 a 12 em todos os exercícios\n
Treino B\n
Exercícios: Agachamento livre 4x, Hack 4x, Leg Press unilateral – 3x, Stiff 4x, Mesa flexora 4x, Hack 5x, Cadeira extensora 5x\n
Descanso de 2 a 3 minutos entre as séries. Repetições de 10 a 15 em todos os exercícios\n
Treino C\n
Exercícios: Supino reto com barra 3x, Supino inclinado 4x, Voador 4x, Crossover 4x, Crucifixo com halter 4x, Tríceps pulley 4x, Tríceps corda 3x, Tríceps coice 3x\n
Descanso de 1 a 2 minutos entre as séries. Repetições de 8 a 12 em todos os exercícios\n
Treino D\n
Exercícios: Elevação lateral 3x, Elevação lateral no cabo 4x, Elevação lateral no banco 45 4x, Desenvolvimento 4x, Elevação frontal com halter 4x, Elevação frontal com barra 3x\n
Abdominal crush (normal) – 5x20\n
Descanso de 1 a 2 minutos entre as séries. Repetições de 8 a 12 em todos os exercícios\n
Treino E\n
Exercícios: Levantamento terra 3x15, Puxada alta fechada 3x, Pullover 4x, Rosca concentrada 3, Rosca direta 3x\n
Descanso de 1 a 2 minutos entre as séries. Repetições de 8 a 12 em todos os exercícios\n
Treino F\n
Exercícios: Apoio 5x, Supino inclinado 3x, Desenvolvimento 3x, Elevação lateral 3x, Tríceps pulley 4x, Tríceps coice 4x\n
Descanso de 1 a 2 minutos entre as séries. Repetições de 10 a 15 em todos os exercícios\n
\n
ORGANIZAÇÃO SEMANAL\n
Dia 1: Treino A, Dia 2: Treino B, Dia 3: Treino C, Dia 4: Treino D, Dia 5: Treino E, Dia 6: Treino F, Dia 7: Repouso.\n
";
$exemplo3 = "PLANO DE TREINO\n
Treino A\n
Exercícios: Mesa Flexora + Stiff 3x, Bulgaro 3x, Elevação Pelvica 4x, Coice na Polia + Abdutora Polia 3x, Cadeira Abdutora 3x, Remada Baixa Pronada 3x, Remada Cavalinho Neutra 3x, Serrote 3x, Voador Invertido 3x, Rosca Direta + Martelo 3x\n
Descanso de 1 a 2 minutos entre as séries, Repetições de 10 a 15 em todos os exercícios\n
Treino B\n
Exercícios: Cadeira Extensora 3x, Cluster 4x, Hack Squat 4x, Agachamento Barra Guiada 4x, Leg 90 4x, Cadeira Adutora 4x, Passada Até a Falha\n
Descanso de 1 a 2 minutos entre as séries, repetições de 15 a 20 em todos os exercícios\n
Treino C\n
Exercícios: Agachamento Sumo + Livre 4x, Leg Horizontal (pé Mais Alto) 4x, Cadeira Flexora 4x, Elevação Pélvica Uni Chão 3x, Panturrilha Sentado + Em Pé 4x, Supino Inclinado 3x, Voador 3x, Desenvolvimento Halter 3x, Remada Alta  (trapézio) 3x, Triceps Corda + Testa 3x\n
Descanso de 1 a 2 minutos entre as séries, repetições de 15 a 20 em todos os exercícios\n
\n
ORGANIZAÇÃO SEMANAL\n
Dia 1: Treino A, Dia 2: Repouso, Dia 3: Treino B, Dia 4: Repouso, Dia 5: Treino C, Dia 6: Repouso, Dia 7: Repouso.\n
";

// Configurações para a API da OpenAI
$api_key = 'Coloque aqui a Key do chatGPT';
$url = 'https://api.openai.com/v1/chat/completions';

switch ($tipo_prompt) {

    case 'zero_shot':
        $data = [
            "model" => "gpt-3.5-turbo",
            "messages" => [
                ["role" => "system", "content" => $persona],
                ["role" => "user", "content" => $pergunta]
            ],
            "temperature" => $temperatura
        ];
        break;

    case 'one_shot':
        $data = [
            "model" => "gpt-3.5-turbo",
            "messages" => [
                ["role" => "system", "content" => $persona],
                ["role" => "user", "content" => $pergunta1],
                ["role" => "assistant", "content" => $exemplo1],
                ["role" => "user", "content" => $pergunta]
            ],
            "temperature" => $temperatura
        ];
        break;

    case 'few_shot':
        $data = [
            "model" => "gpt-3.5-turbo",
            "messages" => [
                ["role" => "system", "content" => $persona],
                ["role" => "user", "content" => $pergunta1],
                ["role" => "assistant", "content" => $exemplo1],
                ["role" => "user", "content" => $pergunta2],
                ["role" => "assistant", "content" => $exemplo2],
                ["role" => "user", "content" => $pergunta3],
                ["role" => "assistant", "content" => $exemplo3],
                ["role" => "user", "content" => $pergunta]
            ],
            "temperature" => $temperatura
        ];
        break;

    case 'chain_of_thought':
        $data = [
            "model" => "gpt-3.5-turbo",
            "messages" => [
                ["role" => "system", "content" => "$persona. $cot"],
                ["role" => "user", "content" => $pergunta . "Vamos pensar passo a passo"]
            ],
            "temperature" => $temperatura
        ];
        break;
        
    case 'chain_of_thought_one_shot':
        $data = [
            "model" => "gpt-3.5-turbo",
            "messages" => [ 
                ["role" => "system", "content" => "$persona. $cot"],
                ["role" => "user", "content" => $pergunta1],
                ["role" => "assistant", "content" => $exemplo1],
                ["role" => "user", "content" => $pergunta . "Vamos pensar passo a passo"]
            ],
            "temperature" => $temperatura
        ];
        break;

    default:
        $data = null;
        echo "<p>O valor de <strong>tipo_prompt</strong> não é válido. Por favor, tente novamente.</p>";
        break;
    }
 

// Inicializa o cURL
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer $api_key",
    "Cache-Control: no-cache, no-store, must-revalidate",
    "Pragma: no-cache"
]);

// Força a expiração de cache do cURL
curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
curl_setopt($ch, CURLOPT_FORBID_REUSE, true);

curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

// Executa a requisição e captura a resposta
$response = curl_exec($ch);
curl_close($ch);

// Limpa buffers de saída para evitar cache
if (function_exists('opcache_reset')) {
    opcache_reset();
}

clearstatcache();
// Decodifica a resposta
$resposta = json_decode($response, true);
$conteudo = $resposta['choices'][0]['message']['content'] ?? 'Erro ao gerar a resposta.';

// Desabilita cache no redirecionamento
header("Expires: 0");
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");

// Redireciona para a nova página
header("Location: treino_aluno.php?conteudo=" . urlencode($conteudo) . "&nome=" . urlencode($nome). "&temperatura=" . urlencode($temperatura). "&tipo_prompt=" . urlencode($tipo_prompt). "&variaveis=" . urlencode($variaveis));
exit;
?>


