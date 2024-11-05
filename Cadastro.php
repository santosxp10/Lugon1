<html>
<body>
<?php
// Configuração do banco de dados
$host = 'localhost'; // ou o endereço do seu servidor de banco de dados
$dbname = 'cadastro_produtos'; // nome do banco de dados
$username = 'root'; // seu usuário do MySQL
$password = ''; // sua senha do MySQL

try {
    // Conectando ao banco de dados
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificando se o formulário foi submetido
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recebendo os dados do formulário
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $endereco = $_POST['endereco'];
        $telefone = $_POST['telefone'];
        $cep = $_POST['cep'];
        $descricao_produto = $_POST['descricao_produto'];

        // Preparando a consulta SQL para inserir os dados no banco
        $sql = "INSERT INTO produtos (nome, cpf, endereco, telefone, cep, descricao_produto) 
                VALUES (:nome, :cpf, :endereco, :telefone, :cep, :descricao_produto)";
        $stmt = $conn->prepare($sql);

        // Vinculando os parâmetros
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':endereco', $endereco);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':cep', $cep);
        $stmt->bindParam(':descricao_produto', $descricao_produto);

        // Executando a consulta
        $stmt->execute();

        // Exibindo uma mensagem de sucesso
        echo "Cadastro realizado com sucesso!";
    }
} catch (PDOException $e) {
    // Exibindo erro em caso de falha
    echo "Erro: " . $e->getMessage();
}

// Fechando a conexão com o banco de dados
$conn = null;
?>


</body>
</html>