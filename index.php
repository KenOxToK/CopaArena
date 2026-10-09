<?php
include 'conexao.php';

$msg = "";
$status = ""; 

$nickname = $nome = $email = $telefone = $discord = $cidade = $plataforma = $jogo = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nickname = trim($_POST['nickname']);
    $nome = trim($_POST['nome_completo']);
    $email = trim($_POST['email']);
    $telefone = trim($_POST['telefone']);
    $discord = trim($_POST['discord']);
    $cidade = trim($_POST['cidade']);
    $plataforma = isset($_POST['plataforma']) ? trim($_POST['plataforma']) : "";
    $jogo = isset($_POST['jogo']) ? trim($_POST['jogo']) : "";

    if (empty($nickname) || empty($nome) || empty($email) || empty($telefone) || empty($discord) || empty($cidade) || empty($plataforma) || empty($jogo)) {
        $msg = "Por favor, preencha todos os campos do formulário!";
        $status = "erro";
    } else {
        $stmt = $conn->prepare("INSERT INTO jogadores (nickname, nome_completo, email, telefone, discord, cidade, plataforma, jogo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $nickname, $nome, $email, $telefone, $discord, $cidade, $plataforma, $jogo);

        if ($stmt->execute()) {
            $msg = "Inscrição realizada com sucesso para a Copa Arena!";
            $status = "sucesso";
            $nickname = $nome = $email = $telefone = $discord = $cidade = $plataforma = $jogo = "";
        } else {
            $msg = "Erro ao salvar a inscrição. Tente novamente.";
            $status = "erro";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Copa Arena - Inscrição</title>
    <style>
        @keyframes neonPulse {
            0% { box-shadow: 0 0 10px #ff0000, 0 0 20px #ff0000, inset 0 0 5px #ff0000; }
            50% { box-shadow: 0 0 20px #ff0000, 0 0 35px #ff0000, inset 0 0 10px #ff0000; }
            100% { box-shadow: 0 0 10px #ff0000, 0 0 20px #ff0000, inset 0 0 5px #ff0000; }
        }
        @keyframes textGlow {
            0% { text-shadow: 0 0 5px #ff0000, 0 0 10px #ff0000; }
            50% { text-shadow: 0 0 10px #ff0000, 0 0 20px #ff0000; }
            100% { text-shadow: 0 0 5px #ff0000, 0 0 10px #ff0000; }
        }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #0a0a0c; color: #e0e0e0; margin: 0; padding: 4px; display: flex; flex-direction: column; align-items: center; min-height: 100vh; box-sizing: border-box; }
        .container { background-color: #121216; padding: 30px; border-radius: 12px; width: 100%; max-width: 500px; border: 2px solid #ff0000; animation: neonPulse 3s infinite ease-in-out; box-sizing: border-box; margin: 20px 0; }
        h1 { color: #ff0000; text-align: center; font-size: 32px; margin-top: 0; margin-bottom: 25px; text-transform: uppercase; letter-spacing: 3px; font-weight: 900; animation: textGlow 3s infinite ease-in-out; }
        .alert { padding: 12px; margin-bottom: 20px; border-radius: 6px; font-weight: bold; text-align: center; text-transform: uppercase; font-size: 14px; letter-spacing: 1px; }
        .erro { background-color: rgba(255, 0, 0, 0.2); color: #ff3333; border: 1px solid #ff0000; box-shadow: 0 0 10px rgba(255, 0, 0, 0.3); }
        .sucesso { background-color: rgba(0, 255, 0, 0.15); color: #33ff33; border: 1px solid #00ff00; box-shadow: 0 0 10px rgba(0, 255, 0, 0.3); }
        label { display: block; margin-bottom: 6px; font-weight: 600; color: #8a8a93; text-transform: uppercase; font-size: 12px; letter-spacing: 1px; }
        input[type="text"], input[type="email"], select { width: 100%; padding: 12px; margin-bottom: 20px; border: 1px solid #25252d; border-radius: 6px; background-color: #1a1a22; color: #fff; box-sizing: border-box; font-size: 14px; transition: all 0.3s ease; }
        input:focus, select:focus { border-color: #ff0000; box-shadow: 0 0 10px rgba(255, 0, 0, 0.5); outline: none; background-color: #1f1f29; }
        button { width: 100%; padding: 14px; background-color: #ff0000; border: none; color: white; font-size: 16px; font-weight: bold; border-radius: 6px; cursor: pointer; text-transform: uppercase; letter-spacing: 2px; transition: all 0.4s ease; box-shadow: 0 0 10px rgba(255, 0, 0, 0.4); }
        button:hover { background-color: #b30000; box-shadow: 0 0 20px #ff0000; transform: translateY(-2px); }
        button:active { transform: translateY(0); }
        .nav-link { margin-top: 20px; text-align: center; display: block; color: #ff3333; text-decoration: none; font-weight: bold; text-transform: uppercase; font-size: 13px; letter-spacing: 1px; transition: all 0.3s ease; }
        .nav-link:hover { color: #ff0000; text-shadow: 0 0 8px #ff0000; }
    </style>
</head>
<body>

    <div class="container">
        <h1>Copa Arena</h1>
        
        <?php if (!empty($msg)): ?>
            <div class="alert <?php echo $status; ?>"><?php echo $msg; ?></div>
        <?php endif; ?>

        <form action="index.php" method="POST">
            <label for="nickname">Nickname:</label>
            <input type="text" id="nickname" name="nickname" value="<?php echo htmlspecialchars($nickname); ?>">

            <label for="nome_completo">Nome Completo:</label>
            <input type="text" id="nome_completo" name="nome_completo" value="<?php echo htmlspecialchars($nome); ?>">

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">

            <label for="telefone">Telefone / WhatsApp:</label>
            <input type="text" id="telefone" name="telefone" value="<?php echo htmlspecialchars($telefone); ?>">

            <label for="discord">Usuário do Discord:</label>
            <input type="text" id="discord" name="discord" value="<?php echo htmlspecialchars($discord); ?>">

            <label for="cidade">Cidade:</label>
            <input type="text" id="cidade" name="cidade" value="<?php echo htmlspecialchars($cidade); ?>">

            <label for="plataforma">Plataforma:</label>
            <select id="plataforma" name="plataforma">
                <option value="">Selecione...</option>
                <option value="PC" <?php if($plataforma == "PC") echo "selected"; ?>>PC</option>
                <option value="Console" <?php if($plataforma == "Console") echo "selected"; ?>>Console</option>
                <option value="Celular" <?php if($plataforma == "Celular") echo "selected"; ?>>Celular</option>
            </select>

            <label for="jogo">Jogo:</label>
            <select id="jogo" name="jogo">
                <option value="">Selecione...</option>
                <option value="Valorant" <?php if($jogo == "Valorant") echo "selected"; ?>>Valorant</option>
                <option value="League of Legends" <?php if($jogo == "League of Legends") echo "selected"; ?>>League of Legends</option>
                <option value="EA FC" <?php if($jogo == "EA FC") echo "selected"; ?>>EA FC</option>
            </select>

            <button type="submit">Realizar Inscrição</button>
        </form>

        <a href="lista.php" class="nav-link">Ver Lista de Inscritos →</a>
    </div>

</body>
</html>
