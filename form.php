<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Função para limpar os dados
    function limparEntrada($data) {
        $data = trim($data); // Remove espaços em branco do início e do fim
        $data = stripslashes($data); // Remove barras invertidas
        $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8'); // Converte caracteres especiais em entidades HTML
        return $data;
    }

    // Coletando e limpando os dados do formulário
    $nome = limparEntrada($_POST['name']);
    $email = limparEntrada($_POST['email']);
    $mensagem = limparEntrada($_POST['message']);

    // Validando o email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Endereço de email inválido.";
        exit;
    }

    // Configurando o email
    $para = 'luizoctavios14@gmail.com';
    $assunto = 'Nova mensagem do site';
    $corpo = "Nome: $nome\nEmail: $email\n\nMensagem:\n$mensagem";
    $headers = "From: $email\r\nReply-To: $email\r\n";

    // Enviando o email
    if (mail($para, $assunto, $corpo, $headers)) {
        echo "Mensagem enviada com sucesso!";
    } else {
        echo "Houve um erro ao enviar sua mensagem. Tente novamente mais tarde.";
    }
} else {
    echo "Método de requisição inválido.";
}
?>
