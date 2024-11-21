<?php
session_start();

function openCon() {
    $conn = new mysqli("localhost", "root", "", "dct-ccs-finals");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function closeCon($conn) {
    $conn->close();
}

function debugLog($message) {
    error_log("[DEBUG] " . $message);
}

function loginUser($username, $password) {
    $conn = openCon();

    // Query to fetch user data by email
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password using password_verify() with the hash stored in the database
        if (password_verify($password, $user['password'])) {
            // Set session variables for logged-in user
            $_SESSION['email'] = $user['email'];
            $_SESSION['user_id'] = $user['id'];

            $stmt->close();
            closeCon($conn);
            return true;
        }
    }

    $stmt->close();
    closeCon($conn);
    return false;
}

function isLoggedIn() {
    return isset($_SESSION['email']);
}

function addUser($email, $password, $name) {
    $conn = openCon();

    if ($conn) {
        // Hash the password before storing it
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert the user into the database
        $sql = "INSERT INTO users (email, password, name) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $email, $hashedPassword, $name);

        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        closeCon($conn);
    } else {
        echo "Failed to connect to the database.";
    }
}
function addSubject($subjectCode, $subjectName) {
    $conn = openCon();

    // Prepare the SQL statement to insert the new subject
    $sql = "INSERT INTO subjects (subject_code, subject_name) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $subjectCode, $subjectName);

    if ($stmt->execute()) {
        // If successful, log the message and close the connection
        debugLog("Subject added successfully: $subjectCode - $subjectName");
    } else {
        debugLog("Error adding subject: " . $stmt->error);
    }

    $stmt->close();
    closeCon($conn);
}

function getSubjects() {
    $conn = openCon();
    
    // SQL query to get all subjects
    $sql = "SELECT * FROM subjects";
    $result = $conn->query($sql);
    
    // Fetch all subjects as an associative array
    $subjects = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $subjects[] = $row;
        }
    }
    
    closeCon($conn);
    return $subjects;
}
function deleteSubject($subjectId) {
    $conn = openCon();

    // Prepare the SQL statement to delete the subject by ID
    $sql = "DELETE FROM subjects WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $subjectId);

    if ($stmt->execute()) {
        debugLog("Subject with ID $subjectId deleted successfully.");
    } else {
        debugLog("Error deleting subject: " . $stmt->error);
    }

    $stmt->close();
    closeCon($conn);
}
?>
