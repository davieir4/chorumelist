    <?php

        require_once 'task.php';
        require_once 'front.php';

        function userOptions(){
           
            $task = Task::getInstance();

            try{

                switch($_POST['action']??null):

                case 'insert':
                    if(empty($_POST['description'])){
                       throw new Exception('<br> ATENÇÃO: A descrição de sua tarefa não pode ser vazia.');
                    }
                    $task->insert($_POST['description']);
                    echo "<div style='color: green;'>Task adicionada com sucesso!</div>";
                    echo "<script>
                    const audio = new Audio('sounds/ai.mp3');
                    audio.play();
                    </script>";
                    exit;

                case 'list':
                    foreach ($task->list() as $taskItem) {
                        $status = $taskItem['is_done'] ? "✅" : "❌";
                        echo "<li>
                                {$status} <strong>ID:</strong> {$taskItem['id']} - {$taskItem['descricao']} 
                            </li>";
                    }
                    exit;

                case 'delete':
                    if(!is_numeric($_POST['id']) ||empty($_POST['id']) ||  $task->delete($_POST['id']) == 0 ){
                        throw new Exception('<br> ATENÇÃO: Indique o número da tarefa CORRETAMENTE. <br> Não sabe ainda? clique em VER TAREFAS.');
                    }
                    $task->delete($_POST['id']);
                 
                    exit;

                case 'deleteAll':
                    $task->deleteAll();
                  
                    exit;

                case 'update':
                    if(!is_numeric($_POST['id_up'])){
                        throw new Exception('<br> ATENÇÃO: Indique o número da tarefa CORRETAMENTE. <br> Não sabe ainda? clique em VER TAREFAS.');    
                    }
                    if(empty($_POST['id_up']) || empty($_POST['new_description']) ){
                        throw new Exception('<br> ATENÇÃO: Os dois campos devem ser obrigatoriamente preenchidos, caso deseje apagar selecione as opções de remoção.');
                    }
                    $task->update($_POST['new_description'], $_POST['id_up']);
                    exit;

                case 'is_done':
                    if(empty($_POST['id_att']) || !is_numeric($_POST['id_att'])){
                        throw new Exception('<br> ATENÇÃO: Indique o número da tarefa CORRETAMENTE. <br> Não sabe ainda? clique em VER TAREFAS.');    
                    }
                    $task->upStatus(1, $_POST['id_att']);
                 
                    exit;
                    
                endswitch;
            }catch(Exception $e){
                echo "<script>
                const audio = new Audio('sounds/xii.mp3');
                audio.play();
                </script>";
                echo $e->getMessage();
                
                die();
            }
        }      

    ?>



