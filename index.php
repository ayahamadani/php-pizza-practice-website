<?php

    include('connection/test_conn.php');

    // write queries for all pizzas
    // assigning a variable for the action
    $sql = 'SELECT title, ingredients, id FROM pizzas';

    // make query and get the result
    $result = mysqli_query($conn, $sql);

    // fetch the results as arrays
    $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // good practice to free from memory
    mysqli_free_result($result);

    // close connection
    mysqli_close($conn);


?>


<!DOCTYPE html>
<html>
    <?php include('header.php'); ?>

    <h4 class="center grey-text">Pizzas!</h4>

    <div class="container">
        <div class="row">
        <?php foreach($pizzas as $pizza) : ?>
            <div class="col s6 md3">
                <div class="card z-depth-0">
                    <img src="img/pizza.svg" class="pizza">
                    <div class="card-content center">
                        <h6>  <?php echo htmlspecialchars($pizza['title']) ?></h6>
                        <ul>
                        <?php foreach(explode(',', $pizza['ingredients']) as $ing): ?>
                           <li><?php echo htmlspecialchars($ing) ?></li>
                        <?php endforeach;?>
                        </ul>
                        <div class="card-action right-align">
                            <a href="details.php?id=<?php echo $pizza['id'] ?>" class="brand-text">more info</a>
                        </div>
                    </div>
                </div> 
            </div>
            <?php endforeach; ?>

        </div>
    </div>

    <?php include('footer.php'); ?>
    
</html>