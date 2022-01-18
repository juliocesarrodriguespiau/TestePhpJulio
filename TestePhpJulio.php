<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste PHP Júlio</title>
</head>
    <body>
        <h1>Teste PHP HTML PDO MySQL</h1>
        <br>
        <?php
            // "1. Escreva um trecho de código para fazer a conexão com um banco de dados MYSQL."
            echo "<h3>DEFININDO CONEXÃO COM BANCO DE DADOS MYSQL</h3>";
            try {
                // data source name
                $dsn = "mysql:host=localhost;dbname=sg";
                //PHP data object
                $conexao = new PDO($dsn, "root", "root");
                $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                echo "Conexão MySQL feita com Sucesso!";
                echo "<hr>";
            } catch (Exception $e) {
                echo "Erro de conexão MySQL: " . $e->getMessage();
                echo "<hr>";
            }

            // 2. Crie as variáveis: nome, e-mail, telefone e atribua valores a elas de forma que não seja possível inserir 
            // caracteres especiais (Exemplo: “!&).  Atenção! É necessário aceitar o @ no campo e-mail.
            
            echo "<h3>DEFININDO E VALIDANDO VARIÁVEIS</h3>";
            function validaEmail($email) {
                $conta = "^[a-zA-Z0-9\._-]+@";
                $dominio = "[a-zA-Z0-9\._-]+.";
                $extensao = "([a-zA-Z]{2,4})$";
                $pattern = $conta.$dominio.$extensao;
                if(mb_ereg($pattern, $email)) {
                    return true;
                } else {
                    return false;
                }
            }
            function validaTelefone($telefone) {
                $rgx = "^[0-9]{8,16}$";
                //$pattern = $rgx;
                if(mb_ereg($rgx, $telefone)) {
                    return true;
                } else {
                    return false;
                }
            }
            function validaNome($nome) {
                $input = "^[A-Za-z]* [A-Za-z]* [A-Za-z]* [A-Za-z]*$";
                $pattern = $input;
                if(mb_ereg($pattern, $nome)) {
                    return true;
                } else {
                    return false;
                }
            }

            // inputs
            $nome = "Steph Cury";
            $email = "cury@hotmail.com";
            $telefone = "17981357785";
            
            // Questão 3.           
            $codigoCliente = random_int(1000, 9999); 
            
            // Questão 4.
            $codigoCliente = md5($codigoCliente); 

            if (validaNome($nome)) {
                echo "Nome: " .$nome. " - válido!" . "<br>";
            } else {
                echo "Nome: " .$nome. " - inválido - não inserir caracteres especiais!" . "<br>";
            }
   
            if (validaEmail($email)) {
                echo "Email: " .$email. " - válido!" . "<br>";
            } else {
                echo "Email: " .$email. " - inválido!" . "<br>";
            }
  
            if (validaTelefone($telefone)) {
                echo "Telefone: " .$telefone. " - válido!" . "<br>";
            } else {
                echo "Telefone: " .$telefone. " - inválido - insira somente números e sem espaços!" . "<br>";
            }
            echo "codigoCliente: " . $codigoCliente;
            echo "<br>";
            echo "<hr>";

            // 5. Desenvolva um trecho de código para INSERIR (INSERT) essas 4 variáveis em uma base de dados MYSQL.
            echo "<h3>INSERT BANCO DADOS</h3>";
            try {
                $query = "INSERT INTO cadCliente (nome, email, telefone, codCliente) VALUES ('$nome', '$email', '$telefone','$codigoCliente')";
                echo "<br>";
                print_r("Query: " . $query);
                $stmt = $conexao->prepare($query);
                $stmt->execute();
                echo $query;
                echo "<br>";
                echo "<hr>";
            } catch (Exception $e) {
                echo "Erro de conexão MySQL: " . $e->getMessage();
                echo "<br>";
                echo "<hr>";
            }

            // 6. Desenvolva um trecho de código para fazer a seleção (SELECT) dos registros onde o campo nome seja igual a João ou Maria.
            echo "<h3>SELECT BANCOD DADOS</h3>";
            try {
                $query = "SELECT nome, email, telefone, codCliente FROM cadCliente";
                $stmt = $conexao->prepare($query);
                $stmt->execute();
                $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

                echo $query;
                echo "<br>";
                echo "<br>";
            } catch (Exception $e) {
                echo "Erro de conexão MySQL: " . $e->getMessage();
                echo "<br>";
            }

            foreach($dados as $dado){
                echo "NOME: ".$dado['nome']." + "."E-MAIL: ".$dado['email']." + "."TELEFONE: ".$dado['telefone']." + "."CODCLIENTE: ".$dado['codCliente']."<hr>"."<br>";
            };

            // 7.Desenvolva um trecho de código para fazer a edição (UPDATE) dos campos: nome, e-mail e telefone 
            // de um registro específico dentro do banco de dados
            echo "<h3>UPDATE BANCO DE DADOS</h3>";
            try {
                $query = "UPDATE cadCliente SET nome = 'Ronaldo', email = 'ronaldo@hotmail.com', telefone = '012365547898' WHERE id = 1";
                $stmt = $conexao->prepare($query);
                $stmt->execute();
                
                echo $query;
                echo "<br>";
                echo "<hr>";
            } catch (Exception $e) {
                echo "Erro de conexão MySQL: " . $e->getMessage();
                echo "<br>";
                echo "<hr>";
            }

            // 8. Desenvolva um trecho de código para deletar (DELETE) do banco de dados um registro específico. 
            echo "<h3>DELETE BANCO DE DADOS</h3>";
            try {
                $query = "DELETE FROM cadCliente WHERE id = 31";
                $stmt = $conexao->prepare($query);
                $stmt->execute();
        
                echo $query;
                echo "<br>";
                echo "<hr>";
            } catch (Exception $e) {
                echo "Erro de conexão MySQL: " . $e->getMessage();
                echo "<br>";
                echo "<hr>";
            }

            //9.Desenvolva um trecho de código para exibir uma variável que receba um número randômico de 4 algarismos 
            // e crie uma condicional que se o valor for um número ímpar escreva na tela “número ímpar” se não, escreva “número par”.
            echo "<h3>VALIDAÇÃO PAR/ÍMPAR DA VARIÁVEL RANDOMICA</h3>";
            $randonNumber = random_int(0000, 9999);
            echo "Randon Number: " . $randonNumber;
            echo "<br>";

            if ($randonNumber % 2 == 0) {
                echo "O número " .$randonNumber . " é par!";
            } else {
                echo "O número " .$randonNumber . " é ímpar!";
            }
            echo "<hr>";

            // 10.Desenvolva um trecho de código para fazer um laço de repetição que exiba uma lista numérica de 0 a 100 
            // exibindo somente os números que sejam múltiplos de 3.
            echo "<h3>LAÇO REPETIÇÃO MÚLTIPLOS 3</h3>";
   
            for ( $i=0; $i <= 100; $i++ ) {
                if($i % 3 == 0){
                    echo $i."<br>";
                }
            }
            echo "<hr>";

            // 11.	Desenvolva um trecho de código para exibir a data atual.
            echo "<h3>EXIBE DATA ATUAL</h3>";

            $dataAtual = new DateTime();
            echo $dataAtual->format('d/m/Y');
            
            // 12.Desenvolva um trecho de código para exibir o nome dos 12 meses do ano. 
            // Quando exibir o mês atual o nome desse mês deve estar em negrito.
            echo "<br>";
            echo "<h3>MESES DO ANO- EXIBE MÊS ATUAL EM NEGRITO</h3>";

            $meses = [
                '01' => 'Janeiro',
                '02' => 'Fevereiro',
                '03' => 'Março',
                '04' => 'Abril',
                '05' => 'Maio',
                '06' => 'Junho',
                '07' => 'Julho',
                '08' => 'Agosto',
                '09' => 'Setembro',
                '10' => 'Outubro',
                '11' => 'Novembro',
                '12' => 'Dezembro',
            ];
            $mesAtual = new DateTime();
            
            // echo "Mês Atual: " . $mesAtual->format('m');
            echo "<br>";

            foreach($meses as $indice => $mes){
                if($indice == $mesAtual->format('m')){
                    //$mes = $mesAtual->format('m');
                    echo "<b>".$mes."</b>" . "<br>";
                }else {
                    echo $mes . "<br>";
                }
                
            };
        ?>
</html>
