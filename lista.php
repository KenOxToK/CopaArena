<?php
include 'conexao.php';

$sql = "SELECT nickname, nome_completo, jogo FROM jogadores ORDER BY id DESC";
$resultado = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Copa Arena - Lista de Inscritos</title>
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
        .container { background-color: #121216; padding: 30px; border-radius: 12px; width: 100%; max-width: 800px; border: 2px solid #ff0000; animation: neonPulse 3s infinite ease-in-out; box-sizing: border-box; margin: 20px 0; }
        h1 { color: #ff0000; text-align: center; font-size: 32px; margin-top: 0; margin-bottom: 25px; text-transform: uppercase; letter-spacing: 3px; font-weight: 900; animation: textGlow 3s infinite ease-in-out; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background-color: #16161e; border-radius: 8px; overflow: hidden; border: 1px solid #25252d; }
        th, td { padding: 14px; text-align: left; border-bottom: 1px solid #25252d; }
        th { background-color: #ff0000; color: #ffffff; text-transform: uppercase; font-size: 13px; letter-spacing: 2px; font-weight: bold; }
        tr:last-child td { border-bottom: none; }
        tr:hover { background-color: #1f1f29; }
        td strong { color: #ff3333; }
        .no-data { text-align: center; padding: 30px; color: #8a8a93; font-style: italic; }
        .nav-link { margin-top: 25px; text-align: center; display: block; color: #ff3333; text-decoration: none; font-weight: bold; text-transform: uppercase; font-size: 13px; letter-spacing: 1px; transition: all 0.3s ease; }
        .nav-link:hover { color: #ff0000; text-shadow: 0 0 8px #ff0000; }
    </style>
</head>
<body>

    <div class="container">
        <h1>Jogadores Inscritos</h1>

        <table>
            <thead>
                <tr>
                    <th>Nickname</th>
                    <th>Nome Completo</th>
                    <th>Jogo</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($resultado->num_rows > 0): ?>
                    <?php while($row = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($row['nickname']); ?></strong></td>
                            <td><?php echo htmlspecialchars($row['nome_completo']); ?></td>
                            <td><?php echo htmlspecialchars($row['jogo']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="no-data">Nenhum jogador inscrito até o momento.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <a href="index.php" class="nav-link">← Voltar para o Formulário</a>
    </div>

</body>
</html>
