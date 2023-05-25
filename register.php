<!DOCTYPE html>
<html>

<head>
    <title>Registration Form</title>
</head>

<body>

    <?php

    // define variables and set to empty values
    $emailErr = $passwordErr = $rollNumberErr = "";
    $email = $password = $rollNumber = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
            // check if email address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }

        if (empty($_POST["password"])) {
            $passwordErr = "Password is required";
        } else {
            $password = test_input($_POST["password"]);
            // check if password is strong enough
            if (strlen($password) < 8) {
                $passwordErr = "Password must be at least 8 characters long";
            }
        }

        if (empty($_POST["rollNumber"])) {
            $rollNumberErr = "Roll number is required";
        } else {
            $rollNumber = test_input($_POST["rollNumber"]);
            // check if roll number is numeric
            if (!is_numeric($rollNumber)) {
                $rollNumberErr = "Roll number must be a number";
            }
        }

        // if all input fields are valid, insert the data into the database
        if ($emailErr == "" && $passwordErr == "" && $rollNumberErr == "") {
            $servername = "localhost";
            $username = "surendra";
            $password = "Surendrababu@123";
            $dbname = "mydb";

            // create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // prepare and bind SQL statement
            $stmt = $conn->prepare("INSERT INTO users (email, password, roll_number) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $email, $password, $rollNumber);

            // execute SQL statement and check for errors
            if ($stmt->execute() === TRUE) {
                echo "Registration successful!";
            } else {
                echo "Error: " . $stmt->error;
            }

            // close connection
            $stmt->close();
            $conn->close();
        }
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    ?>

    <h2>Registration Form</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        Email: <input type="text" name="email" value="<?php echo $email; ?>">
        <span class="error">*
            <?php echo $emailErr; ?>
        </span>