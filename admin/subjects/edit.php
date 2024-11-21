<?php 
include '../partials/header.php';
include '../partials/side-bar.php';
include '../../functions.php';  // Ensure this file contains your functions

// Get the subject_id from the URL parameter
if (isset($_GET['subject_id'])) {
    $subjectId = $_GET['subject_id'];
    
    // Fetch the subject data using the subject_id
    $subject = getSubjectById($subjectId);
}

// Handle form submission for updating the subject name only
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subjectId = $_POST['subject_id'];  // Get the subject ID
    $subjectName = $_POST['subject_name'];  // Get the new subject name

    // Update the subject name in the database
    if (updateSubjectName($subjectId, $subjectName)) {
        // Stay on the same page and show updated data
        header("Location: add.php?subject_id=" . $subjectId);
        exit;
    } else {
        echo "Error updating subject name!";
    }
}

?>
<html>
<head>
    <title>Edit Subject</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .breadcrumb {
            font-size: 14px;
            margin-bottom: 20px;
        }
        .breadcrumb a {
            color: #007bff;
            text-decoration: none;
        }
        .breadcrumb a:hover {
            text-decoration: underline;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Subject</h1>
        <div class="breadcrumb">
            <a href="#">Dashboard</a> / <a href="#">Add Subject</a> / Edit Subject
        </div>
        
        <?php if ($subject): ?>
        <form method="POST">
            <div class="form-group">
                <label for="subject-code">Subject Code</label>
                <input type="text" id="subject-code" name="subject_code" value="<?= $subject['subject_code'] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="subject-name">Subject Name</label>
                <input type="text" id="subject-name" name="subject_name" value="<?= $subject['subject_name'] ?>" required>
            </div>
            <input type="hidden" name="subject_id" value="<?= $subject['id'] ?>">
            <button type="submit" class="btn">Update Subject Name</button>
        </form>
        <?php else: ?>
            <p>Subject not found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
