<?php

    $conn = new mysqli("localhost", "root", "", "crud") OR die("Error: " . mysqli_error($conn));

    session_start();

    //code to save user's data
    if(isset($_POST['save'])) {
        if(!empty($_POST['username']) && !empty($_POST['lastname'])) {
            $username = $_POST['username'];
            $lastname = $_POST['lastname'];

            $iQUERY = "INSERT INTO user(username, lastname) value(?, ?)";

            $stmt = $conn->prepare($iQUERY);
            $stmt->bind_param("ss", $username, $lastname);
            if($stmt->execute()) {
                $_SESSION['msg'] = "New user added.";
                $_SESSION['alert'] = "alert alert-success";
            }
            $stmt->close();
            $conn->close();
        } else {
            $_SESSION['msg'] = "Username and lastname can not be empty.";
            $_SESSION['alert'] = "alert alert-warning";
        }
        header("location: index.php");
    }

    //delete data
    if(isset($_POST['delete'])) {
        $id = $_POST['delete'];

        $dQuery = "DELETE FROM user WHERE id = ?";
        $stmt = $conn->prepare($dQuery);
        $stmt->bind_param('i', $id);
        if($stmt->execute()) {
            $_SESSION['msg'] = "Selected user deleted.";
            $_SESSION['alert'] = "alert alert-danger";
        }
        $stmt->close();
        $conn->close();
        header("location: index.php");
    }

    //update user's data
    if(isset($_POST['edit'])) {
        if(!empty($_POST['username']) && !empty($_POST['lastname'])) {
            $username = $_POST['username'];
            $lastname = $_POST['lastname'];
            $id = $_POST['edit'];

            $uQUERY = "UPDATE user SET username = ?, lastname = ? WHERE id = ?";

            $stmt = $conn->prepare($uQUERY);
            $stmt->bind_param("ssi", $username, $lastname, $id);
            if($stmt->execute()) {
                $_SESSION['msg'] = "Selected user updated.";
                $_SESSION['alert'] = "alert alert-success";
            }
            $stmt->close();
            $conn->close();
        } else {
            $_SESSION['msg'] = "Username and lastname can not be empty.";
            $_SESSION['alert'] = "alert alert-warning";
        }
        header("location: index.php");
    }
?>