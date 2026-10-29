<?php
// Define o cabeçalho da resposta como JSON
header("Content-Type: application/json");

// Inclui o arquivo de conexão com o banco de dados
require "conexao.php";

// Analisa qual método vai chegar na API
$metodo = $_SERVER["REQUEST_METHOD"];

// Verifica se o método é POST
if($metodo == "POST"){
    // Recebe os dados enviados pelo cliente em formato JSON
    $json = file_get_contents("php://input");
    $dados = json_decode($json,true);

    if (
    empty($dados["nome"]) ||
    empty($dados["categoria"]) ||
    empty($dados["fornecedor"]) ||
    empty($dados["quantidade"]) ||
    empty($dados["preco_unitario"])
    ) {
    echo json_encode([
        "mensagem" => "Todos os campos são obrigatórios"
    ]);
    exit;
    }

$categoriasValidas = ["eletrica", "mecanica", "hidraulica"];
if (in_array($dados["categoria"], $categoriasValidas) && $dados["quantidade"] > 0 && $dados["preco_unitario"] > 0) {
        // Prepara a consulta SQL para inserir os dados na tabela produtos
        $sql = "INSERT INTO pecas (nome,categoria,fornecedor,quantidade,preco_unitario) VALUES (?,?,?,?,?)";
        // Prepara a consulta SQL usando o objeto PDO
        $comando = $pdo -> prepare($sql);
        // Executa a consulta SQL com os dados recebidos
    $comando -> execute([
        $dados["nome"],
        $dados["categoria"],
        $dados["fornecedor"],
        $dados["quantidade"],
        $dados["preco_unitario"]
    ]);

    // Retorna uma resposta JSON indicando que o produto foi cadastrado com sucesso
    echo json_encode([
        "mensagem" => "Produto cadastrado com sucesso"
    ]);
    }
};

if($metodo == "GET"){
    // Prepara a consulta SQL para selecionar todos os produtos da tabela produtos
    $sql = "SELECT * FROM pecas ORDER BY id";

    // Prepara a consulta SQL usando o objeto PDO
    $comando = $pdo-> query($sql);

    $pecas = $comando-> fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($pecas);
};


if($metodo == "PUT") {
    // Recebe os dados enviados pelo cliente em formato JSON
    $json = file_get_contents("php://input");
    $dados = json_decode($json,true);

    $categoriasValidas = ["eletrica", "mecanica", "hidraulica"];
    if (in_array($dados["categoria"], $categoriasValidas) && $dados["quantidade"] > 0 && $dados["preco_unitario"] > 0) {

        $sql = "UPDATE pecas SET nome = ?, categoria = ?, fornecedor = ?, quantidade = ?, preco_unitario = ? WHERE id = ?";

        $comando = $pdo -> prepare($sql);
        $comando -> execute([
        $dados["nome"],
        $dados["categoria"],
        $dados["fornecedor"],
        $dados["quantidade"],
        $dados["preco_unitario"],
        $dados["id"]
    ]);

    echo json_encode([
        "mensagem" => "Produto atualizado com sucesso"
    ]);
    }
};


if($metodo == "DELETE") {
    $json = file_get_contents("php://input");
    $dados = json_decode($json,true);

    $sql = "DELETE FROM pecas WHERE id=?";

    $comando = $pdo -> prepare($sql);

    $comando->execute([
        $dados["id"]
    ]);

    echo json_encode(["Mensagem" => "Produto excluído com sucesso"]);
}
?>