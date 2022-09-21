<?php

require 'db_connect.php'


?><!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo List</title>
</head>
<body>
    
<header>
    <h1></h1>
</header>

<main>
    <section class="add-section">
         <form action="fonction/add.php" method="POST" autocomplete="off">
             <?php if(isset($_GET['mess']) && $_GET['mess'] =='error'){  ?>
                <input type="text" 
                    name="title"
                    style="border-color: #ff6666" 
                    placeholder="Tu n'as rien écris..">
            <button class="btn-add" type="submit">Add &nbsp; <span>&#43;</span></button>
                
            <?php }else{ ?>
            <input type="text" 
                    name="title" id="" 
                    placeholder="Ajouter une tâche">
            <button class="btn-add" type="submit">Add &nbsp; <span>&#43;</span></button>
            <?php } ?>
         </form>
         
    </section>


        <?php  
            $todos = $connect->query("SELECT * FROM todos ORDER BY id DESC");
        ?>


    <section class="todo-section">

        <?php if($todos->rowCount() <= 0){ ?>
            <div class="todo-item">
                <div class="empty">
                    <img src="img/raf.png" width="100%">
                </div>
            </div>
       <?php } ?>

        <?php while($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>

            <div class="todo-item">
                <span id="<?php echo $todo['id']; ?>"
                    class="remove-to-do">x</span>
                    <?php if($todo['checked']){ ?>
                <input type="checkbox"
                        class="check-box"
                        checked/>
                <h2 class=checked><?php echo $todo['title']; ?></h2>
                <?php }else { ?>
                    <input type="checkbox"
                        class="check-box" />
                <h2><?php echo $todo['title']; ?></h2>
                <?php } ?>
                <br>
            
                <small>Créé le: <?php echo $todo['date_time'] ?></small>
            </div>

        <?php } ?>

    </section>
</main>

<footer>

</footer>

<script src="js/jquery-3.2.1.min.js"></script>

<script>
        $(document).ready(function(){
            $('.remove-to-do').click(function(){
                const id = $(this).attr('id');
                
                $.post("fonction/remove.php", 
                      {
                          id: id
                      },
                      (data)  => {
                         if(data){
                             $(this).parent().hide(600);
                         }
                      }
                );
            });

            $(".check-box").click(function(e){
                const id = $(this).attr('data-todo-id');
                
                $.post('fonction/check.php', 
                      {
                          id: id
                      },
                      (data) => {
                          if(data != 'error'){
                              const h2 = $(this).next();
                              if(data === '1'){
                                  h2.removeClass('checked');
                              }else {
                                  h2.addClass('checked');
                              }
                          }
                      }
                );
            });
        });
    </script>
</body>
</html>