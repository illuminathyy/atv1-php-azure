<?php

$connectionInfo = array(
    "UID" => "nathiellylogon",
    "pwd" => "SUA_SENHA_AQUI", 
    "Database" => "nathielly-bd",
    "LoginTimeout" => 30,
    "Encrypt" => 1,
    "TrustServerCertificate" => 0
);

$serverName = "tcp:nathielly-server.database.windows.net,1433";

// --- Conexão e Tratamento de Erro ---
// Estabelece a conexão com o banco de dados
$conn = sqlsrv_connect($serverName, $connectionInfo);

$error_message = "";
$rows = array();

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true)); // Descomente para depuração detalhada
    $error_message = "Erro ao conectar ao banco de dados. Verifique as credenciais e a configuração do firewall no Azure.";
} else {
    // --- Execução da Consulta ---
    $sql = "SELECT Id_Cliente, Nome, Endereco, Cidade, Telefone FROM Clientes ORDER BY Nome ASC;";
    $stmt = sqlsrv_query($conn, $sql);

    if ($stmt === false) {
        // die(print_r(sqlsrv_errors(), true)); // Descomente para depuração detalhada
        $error_message = "Erro ao executar a consulta no banco de dados.";
    } else {
        // --- Coleta dos Resultados ---
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $rows[] = $row;
        }
        sqlsrv_free_stmt($stmt);
    }
    sqlsrv_close($conn);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        thead tr {
            background-color: #007bff;
            color: #ffffff;
        }
        /* Cores alternadas nas linhas */
        tbody tr:nth-child(even) {
            background-color: #f2f2f2; /* Cor mais escura */
        }
        tbody tr:nth-child(odd) {
            background-color: #ffffff; /* Cor mais clara */
        }
        .error {
            color: #D8000C;
            background-color: #FFBABA;
            border: 1px solid;
            margin: 10px 0px;
            padding: 15px;
            text-align: center;
        }
    </style>
</head>
<body>

    <h1>Lista de Clientes Cadastrados</h1>

    <?php if (!empty($error_message)): ?>
        <div class="error"><?php echo htmlspecialchars($error_message); ?></div>
    <?php elseif (empty($rows) && empty($error_message)): ?>
        <p>Conexão bem-sucedida, mas nenhum cliente foi encontrado na tabela.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Endereço</th>
                    <th>Cidade</th>
                    <th>Telefone</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $cliente): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($cliente['Id_Cliente']); ?></td>
                        <td><?php echo htmlspecialchars($cliente['Nome']); ?></td>
                        <td><?php echo htmlspecialchars($cliente['Endereco']); ?></td>
                        <td><?php echo htmlspecialchars($cliente['Cidade']); ?></td>
                        <td><?php echo htmlspecialchars($cliente['Telefone']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</body>
</html>