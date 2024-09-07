<?php

include ('connect.php');




try {
  

    // Verifica se o formulário foi submetido
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Pega os dados do formulário e valida os dados recebidos
        $nome = strtoupper(trim($_POST['nome'])); // Converte o nome para maiúsculas e remove espaços extras
        $idade = (int)$_POST['idade'];
        $genero = trim($_POST['genero']);
        $nivel_escolaridade = trim($_POST['nivel_escolaridade']);
        $renda_familiar = (float)$_POST['renda_familiar']; // Converte renda para número
        $emprego_pais = trim($_POST['emprego_pais']);
        $diagnostico_tea = (int)$_POST['diagnostico_tea']; // Certifique-se de que é um inteiro
        $diagnostico_apraxia = (int)$_POST['diagnostico_apraxia']; // Certifique-se de que é um inteiro
        $acesso_tratamento = trim($_POST['acesso_tratamento']);
        $tipos_terapia = isset($_POST['tipo_terapia']) ? implode(', ', $_POST['tipo_terapia']) : ''; // Converte array para string
        $bairro = trim($_POST['bairro']);

        // SQL para inserir os dados
        $sql = "INSERT INTO dados (nome, idade, genero, nivel_escolaridade, renda_familiar, emprego_pais, diagnostico_tea, diagnostico_apraxia, acesso_tratamento, tipo_terapia, municipio, data_registro)
                VALUES (:nome, :idade, :genero, :nivel_escolaridade, :renda_familiar, :emprego_pais, :diagnostico_tea, :diagnostico_apraxia, :acesso_tratamento, :tipo_terapia, :bairro, CURDATE())";

        // Prepara a consulta
        $stmt = $pdor->prepare($sql);

        // Vincula os parâmetros
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':idade', $idade);
        $stmt->bindParam(':genero', $genero);
        $stmt->bindParam(':nivel_escolaridade', $nivel_escolaridade);
        $stmt->bindParam(':renda_familiar', $renda_familiar);
        $stmt->bindParam(':emprego_pais', $emprego_pais);
        $stmt->bindParam(':diagnostico_tea', $diagnostico_tea);
        $stmt->bindParam(':diagnostico_apraxia', $diagnostico_apraxia);
        $stmt->bindParam(':acesso_tratamento', $acesso_tratamento);
        $stmt->bindParam(':tipo_terapia', $tipos_terapia);
        $stmt->bindParam(':bairro', $bairro);

        // Executa a consulta
        if ($stmt->execute()) {
            // Exibe mensagem de sucesso e redireciona
            echo "<script>alert('Dados inseridos com sucesso!'); window.location.href='https://pesquisa.supportassociation.org';</script>";
            exit();
        } else {
            echo "<script>alert('Erro ao inserir os dados.'); window.location.href='https://pesquisa.supportassociation.org';</script>";
        }
    }
} catch (PDOException $e) {
    // Exibe o erro com mais detalhes
    echo "Erro de conexão ou SQL: " . $e->getMessage();
}
?>
