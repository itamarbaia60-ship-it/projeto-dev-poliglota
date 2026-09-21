<?php
$mensagem = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $curso = $_POST["curso"];
    try {
        $conexao = new PDO("mysql:host=localhost; dbname=sistema_poliglota;charset=utf8mb4", "root", "");
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO alunos (nome, curso) VALUES (:nome, :curso)";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([':nome' => $nome, ':curso' => $curso]);
        $mensagem = "Cadastrado no MySQL com sucesso via PDO! Aguardando o Java.";
    } catch (PDOException $e) {
        $mensagem = "Erro no cadastro:".$e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Sistema Poliglota - PHP</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>
    <body class="bg-gray-100 p-8">
        <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-4 text-blue-600">Sistema Poliglota (PHP + PDO)</h2>
            <form method="POST">
                <div class="mb-4">
                    <label class="block text-gray-700">Nome:</label>
                    <input type="text" name="nome" required class="w-full p-2 border rounded">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Curso:</label>
                    <input type="text" name="curso" required class="w-full p-2 border rounded">
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">Cadastrar</button>
            </form>
            <?php if ($mensagem): ?>    
            <p class='mt-4 text-green-600 text-sm'><?= $mensagem ?></p>            
            <?php endif; ?>            
        </div>            
    </body>
</html>