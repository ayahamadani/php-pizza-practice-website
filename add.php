<?php

    include('connection/test_conn.php');

    $email = $title = $ingredients = '';
    $errors = array('email' => '', 'title' => '', 'ingredients' => '');

    if(isset($_POST['submit'])){
        // to avoid possible malware
        
        // echo htmlspecialchars($_POST['email']);
        // echo htmlspecialchars($_POST['title']);
        // echo htmlspecialchars($_POST['ingredient']);

        // checking if the domains are left empty
        if(empty($_POST['email'])){
            echo'An email is required. </br>';
        } else {
            // assigning email variable
            $email = $_POST['email'];
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $errors['email'] = 'Email must be a valid email address </br>';

            }
        }
        if(empty($_POST['title'])){
            echo'A title is required. </br>';
        } else {
            // assigning title variable
                $title = $_POST['title'];
                // using regular expressions
                if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
                    $errors['title'] = 'Title must be letters and spaces only </br>';
            }
       }
        if(empty($_POST['ingredients'])){
            echo'Correct ingredients are required. </br>';
        } else {
            // assigning ingredients variable
            $ingredients = $_POST['ingredients'];
			if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
				$errors['ingredients'] = 'Ingredients must be a comma separated list </br>';
        }
    }

    if(array_filter($errors)){
        // echoing that there are errors
        echo 'there are errors in the form';
    } else {
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $title = mysqli_real_escape_string($conn, $_POST['title']);
      $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

      // create a new variable
      $sql = "INSERT INTO pizzas(title,email,ingredients) VALUES('$title', '$email', '$ingredients')";

      // save to db and check
      if(mysqli_query($conn, $sql)){
        // success
        header('Location: index.php');
      } else {
        echo 'query error: ' . mysqli_error($conn);
      }
    }
}


?>


<!DOCTYPE html>
<html>
    <?php include('header.php'); ?>

    <section class="container grey-text">
        <h4 class="center">Add a Pizza</h4>
        <form class="white" action="add.php" method="POST">
            <label>Your Email:</label>
            <input type="text" name="email" value=<?php echo $email ?>>
            <div class="red-text"><?php echo $errors['email']; ?></div>
            <label>Pizza Title:</label>
            <input type="text" name="title" value=<?php echo $title ?>>
            <div class="red-text"><?php echo $errors['title']; ?></div>
            <label>Ingredients (comma seperated):</label>
            <input type="text" name="ingredients" value=<?php echo $ingredients ?>>
            <div class="red-text"><?php echo $errors['ingredients']; ?></div>
            <div class="center">
                <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
            </div>
        </form>
    </section>

    <?php include('footer.php'); ?>
    
</html>