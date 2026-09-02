<?php
/**
 * dashboard.php
 * Área restrita do sistema.
 * Funcionalidade escolhida: Lista de Tarefas (To-Do List).
 * Os dados das tarefas ficam guardados em $_SESSION['tarefas'].
 */

session_start();

// --- PROTEÇÃO DE ACESSO ---
// Se o usuário não estiver logado, volta para a tela de login
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit();
}

// Inicializa o array de tarefas na sessão, caso ainda não exista
if (!isset($_SESSION["tarefas"])) {
    $_SESSION["tarefas"] = [];
}

// --- PROCESSAMENTO DO FORMULÁRIO (ADICIONAR TAREFA) ---
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["acao"]) && $_POST["acao"] === "adicionar") {

    $novaTarefa = trim($_POST["tarefa"]);

    // Só adiciona se o campo não estiver vazio
    if (!empty($novaTarefa)) {
        // Cada tarefa é um array associativo com texto e status de concluída
        $_SESSION["tarefas"][] = [
            "texto"     => $novaTarefa,
            "concluida" => false
        ];
    }
}

// --- MARCAR TAREFA COMO CONCLUÍDA / PENDENTE (via GET) ---
if (isset($_GET["concluir"])) {
    $indice = (int) $_GET["concluir"];

    if (isset($_SESSION["tarefas"][$indice])) {
        // Alterna entre concluída e pendente
        $_SESSION["tarefas"][$indice]["concluida"] = !$_SESSION["tarefas"][$indice]["concluida"];
    }
}

// --- REMOVER TAREFA (via GET) ---
if (isset($_GET["remover"])) {
    $indice = (int) $_GET["remover"];

    if (isset($_SESSION["tarefas"][$indice])) {
        unset($_SESSION["tarefas"][$indice]);
        $_SESSION["tarefas"] = array_values($_SESSION["tarefas"]); // Reindexa o array
    }
}

// Contagem de tarefas para exibir estatísticas no painel
$totalTarefas = count($_SESSION["tarefas"]);
$totalConcluidas = 0;

foreach ($_SESSION["tarefas"] as $tarefa) {
    if ($tarefa["concluida"]) {
        $totalConcluidas++;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Lista de Tarefas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="dashboard-body">

    <header class="dashboard-header">
        <div class="dashboard-header-info">
            <h1>Minha Lista de Tarefas</h1>
            <p>Bem-vindo(a), <strong><?php echo htmlspecialchars($_SESSION["usuario"]); ?></strong>!</p>
        </div>
        <a href="logout.php" class="btn-logout">Sair</a>
    </header>

    <main class="dashboard-container">

        <section class="resumo-tarefas">
            <div class="card-resumo">
                <span class="numero"><?php echo $totalTarefas; ?></span>
                <span class="rotulo">Total</span>
            </div>
            <div class="card-resumo">
                <span class="numero"><?php echo $totalConcluidas; ?></span>
                <span class="rotulo">Concluídas</span>
            </div>
            <div class="card-resumo">
                <span class="numero"><?php echo $totalTarefas - $totalConcluidas; ?></span>
                <span class="rotulo">Pendentes</span>
            </div>
        </section>

        <form class="form-tarefa" method="POST" action="dashboard.php">
            <input type="hidden" name="acao" value="adicionar">
            <input type="text" name="tarefa" placeholder="Digite uma nova tarefa..." required>
            <button type="submit" class="btn-adicionar">Adicionar</button>
        </form>

        <section class="lista-tarefas">
            <?php if ($totalTarefas === 0): ?>

                <p class="lista-vazia">Nenhuma tarefa cadastrada ainda. Adicione a primeira acima!</p>

            <?php else: ?>

                <ul>
                    <?php foreach ($_SESSION["tarefas"] as $indice => $tarefa): ?>
                        <li class="item-tarefa <?php echo $tarefa["concluida"] ? "concluida" : ""; ?>">

                            <span class="texto-tarefa">
                                <?php echo htmlspecialchars($tarefa["texto"]); ?>
                            </span>

                            <div class="acoes-tarefa">
                                <a href="dashboard.php?concluir=<?php echo $indice; ?>" class="btn-concluir">
                                    <?php echo $tarefa["concluida"] ? "Reabrir" : "Concluir"; ?>
                                </a>
                                <a href="dashboard.php?remover=<?php echo $indice; ?>" class="btn-remover">
                                    Remover
                                </a>
                            </div>

                        </li>
                    <?php endforeach; ?>
                </ul>

            <?php endif; ?>
        </section>

    </main>

</body>
</html>
