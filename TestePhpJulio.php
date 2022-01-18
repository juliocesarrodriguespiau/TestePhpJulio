<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste PHP Júlio</title>
</head>
    <body>
        <h1>Teste Conexão PHP PDO MySQL</h1>
        <br>
        <?php
            // "1. Escreva um trecho de código para fazer a conexão com um banco de dados MYSQL."
            try {
                // data source name
                $dsn = "mysql:host=localhost;dbname=sg";
                //PHP data object
                $conexao = new PDO($dsn, "root", "root");
                $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //var_dump($conexao);
                echo "1.Escreva um trecho de código para fazer a conexão com um banco de dados MYSQL.";
                echo "<br>";
                echo "Conexão MySQL feita com Sucesso!";
                echo "<br>";
                echo "<hr>";
            } catch (Exception $e) {
                echo "Erro de conexão MySQL: " . $e->getMessage();
                echo "<br>";
                echo "<hr>";
            }

            // 2. Crie as variáveis: nome, e-mail, telefone e atribua valores a elas de forma que não seja possível inserir 
            // caracteres especiais (Exemplo: “!&).  Atenção! É necessário aceitar o @ no campo e-mail.

            $nome = "Steph&Cury!#";
        
            $sub = str_replace("&","_",$nome);
            $sub = str_replace("!","_",$sub);
            $sub = str_replace("#","_",$sub);
        

            $nome = $sub;
            $email = "cury@hotmail.com";
            $telefone = "511425321654";            
            $codigoCliente = random_int(1000, 9999); // Questão 3.
            $codigoCliente = md5($codigoCliente); // Questão 4.


            echo "Nome: " . $nome;
            echo "<br>";
            echo "Email: " . $email;
            echo "<br>";
            echo "Telefone: " . $telefone;
            echo "<br>";
            echo "codigoCliente: " . $codigoCliente;
            echo "<br>";
            echo "<br>";
            echo "<hr>";

            // 5. Desenvolva um trecho de código para INSERIR (INSERT) essas 4 variáveis em uma base de dados MYSQL.
            echo "<br>";
            echo "<h3>INSERT</h3>";
            try {
                $query = "INSERT INTO cadCliente (nome, email, telefone, codCliente) VALUES ('$nome', '$email', '$telefone','$codigoCliente')";
                echo "<br>";
                print_r("Query: " . $query);
                $stmt = $conexao->prepare($query);
                $stmt->execute();
                //echo $stmt;
                //$dados = $stmt->fetchAll();
                echo $query;
                echo "<br>";
                echo "<hr>";
            } catch (Exception $e) {
                echo "Erro de conexão MySQL: " . $e->getMessage();
                echo "<br>";
                echo "<hr>";
            }

            // 6. Desenvolva um trecho de código para fazer a seleção (SELECT) dos registros onde o campo nome seja igual a João ou Maria.
            echo "<br>";
            echo "<h3>SELECT</h3>";
            try {
                $query = "SELECT nome, email, telefone, codCliente FROM cadCliente";
                $stmt = $conexao->prepare($query);
                $stmt->execute();
                $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
                //print_r($dados);
                echo $query;
                echo "<br>";
                echo "<br>";
            } catch (Exception $e) {
                echo "Erro de conexão MySQL: " . $e->getMessage();
                echo "<br>";
                //echo "<hr>";
            }

            foreach($dados as $dado){
                echo "NOME: ".$dado['nome']." + "."E-MAIL: ".$dado['email']." + "."TELEFONE: ".$dado['telefone']." + "."CODCLIENTE: ".$dado['codCliente']."<hr>"."<br>";
                //echo "<br>";
            };

            // 7.Desenvolva um trecho de código para fazer a edição (UPDATE) dos campos: nome, e-mail e telefone 
            // de um registro específico dentro do banco de dados
            echo "<br>";
            echo "<h3>UPDATE</h3>";
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
            echo "<br>";
            echo "<h3>DELETE</h3>";
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
            echo "<br>";
            echo "<h3>RANDON</h3>";
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
            echo "<br>";
            echo "<h3>LAÇO REPETIÇÃO MÚLTIPLOS 3</h3>";
            // for ( $i=0; $i <= 100; $i++ ) {
            //     echo $i."<br>";
            // }
            for ( $i=0; $i <= 100; $i++ ) {
                if($i % 3 == 0){
                    echo $i."<br>";
                }
            }
            echo "<hr>";
            // 11.	Desenvolva um trecho de código para exibir a data atual.
            echo "<br>";
            echo "<h3>DATA ATUAL</h3>";

            $dataAtual = new DateTime();
            echo $dataAtual->format('d/m/Y');
            
            // 12.Desenvolva um trecho de código para exibir o nome dos 12 meses do ano. 
            // Quando exibir o mês atual o nome desse mês deve estar em negrito.
            echo "<br>";
            echo "<h3>MESES</h3>";

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
