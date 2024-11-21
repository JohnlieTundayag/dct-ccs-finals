<?php 
include '../partials/header.php';
include '../partials/side-bar.php';
?>
<html>
<head>
    <title>Delete Subject</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .container {
            width: 80%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
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
        .breadcrumb span {
            color: #6c757d;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .confirmation {
            font-size: 16px;
            margin-bottom: 20px;
        }
        .confirmation ul {
            list-style-type: none;
            padding: 0;
        }
        .confirmation ul li {
            margin-bottom: 10px;
        }
        .confirmation ul li::before {
            content: "\2022";
            color: #000;
            font-weight: bold;
            display: inline-block;
            width: 1em;
            margin-left: -1em;
        }
        .buttons {
            display: flex;
            gap: 10px;
        }
        .buttons button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .buttons .cancel {
            background-color: #6c757d;
            color: #fff;
        }
        .buttons .delete {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>
<body>
<h1>Delete Subject</h1>
<div class="breadcrumb">
            <a href="#">Dashboard</a> / <a href="#">Add Subject</a> / <span>Delete Subject</span>
        </div>
    <div class="container">
        
        
        <div class="confirmation">
            <p>Are you sure you want to delete the following subject record?</p>
            <ul>
                <li>Subject Code: 1001</li>
                <li>Subject Name: English</li>
            </ul>
        </div>
        <div class="buttons">
            <button class="cancel">Cancel</button>
            <button class="delete">Delete Subject Record</button>
        </div>
    </div>
</body>
</html>