
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChorumeList</title>
    <style>
        @media (max-width: 600px) {
            .container {
                flex-direction: column;
                align-items: stretch;
            }
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            display: flex;
            gap: 20px;
            justify-content: center;
            align-items: flex-start;
            width: 100%;
            max-width: 1200px;
        }

        form {
            width: 100%;
            max-width: 400px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        input, button {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            background: #007BFF;
            color: #fff;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .task-list {
            flex: 1;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .task-list ul {
            list-style-type: none;
            padding: 0;
        }

        .task-list li {
            margin: 10px 0;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Formulário -->
        <form method="POST">
            <h1>ChorumeList</h1>    
            <h4>"Não deixe para desistir amanhã do que você pode desistir ainda hoje". - Steve Jobs</h4>
            
            <input name="description" placeholder="Insira sua task aqui..."> 
            <button name="action" value="insert">Adicionar</button>
            <button name="action" value="list">Ver Tasks</button>

            <h3>Atualizar tarefa</h3>
            <input name="id_up" placeholder="Digite o ID aqui...">
            <input name="new_description" placeholder="Nova descrição aqui...">
            <button name="action" value="update">Atualizar</button>

            <h3>Remover tarefa</h3>
            <input name="id" placeholder="O ID vem aqui...">
            <button name="action" value="delete">Apagar</button>
            <button name="action" value="deleteAll">Apagar Tudo</button>

            <h3>Marcar tarefa como feita</h3>
            <input name="id_att" placeholder="ID da tarefa">
            <button name="action" value="is_done">Feito</button>    
        </form>


        <!-- Tabela de tarefas -->
        <div class="task-list">
            <h2>Lista de Tarefas</h2>
            <ul>
                <?php

                require_once 'task.php';
                require_once 'index.php';

                userOptions();
        
                ?>
            </ul>
        </div>
    </div>

