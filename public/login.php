<?php

session_start();

if (isset($_POST["email"]) && isset($_POST["password"])) {

    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (!empty($email) && !empty($password)) {

        $_SESSION["logged_in"] = true;
        $_SESSION["email"] = $email;

        header("Location: dashboard.php");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Student Expense Tracker</title>

    <link rel="stylesheet" href="css/style.css">
```html

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f5ff;
            margin: 0;
            color: #292044;
        }

        .navbar {
            background: linear-gradient(120deg, #6541d9, #9270f5);
            color: white;
            padding: 20px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            box-shadow: 0 4px 18px #6541d922;
        }

        .logo {
            font-size: 23px;
            font-weight: bold;
        }

        .nav-links {
            display: flex;
            gap: 22px;
            flex-wrap: wrap;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            transition: opacity 0.2s;
        }

        .nav-links a:hover {
            opacity: 0.75;
        }

        .table-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .welcome-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 28px;
        }

        .small-title {
            color: #7654df;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .welcome-section h1 {
            margin: 8px 0;
            color: #302052;
            font-size: 30px;
        }

        .welcome-section p:not(.small-title) {
            color: #817791;
            font-size: 14px;
        }

        .table-wrapper {
            background: white;
            padding: 24px;
            border: 1px solid #eee8ff;
            border-radius: 18px;
            box-shadow: 0 8px 30px #4d318a0c;
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 750px;
            border-collapse: collapse;
        }

        th, td {
            padding: 16px 14px;
            text-align: left;
            border-bottom: 1px solid #f0ecf8;
        }

        th {
            background: #f2edff;
            color: #6744c8;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            color: #514663;
            font-size: 13px;
        }

        tbody tr {
            transition: background 0.2s;
        }

        tbody tr:hover {
            background: #faf8ff;
        }

        .primary-btn,
        .edit-btn,
        .delete-btn {
            display: inline-block;
            padding: 10px 14px;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 12px;
            font-weight: bold;
            transition: 0.2s;
        }

        .primary-btn {
            background: #7553df;
            color: white;
            box-shadow: 0 5px 14px #7553df25;
        }

        .primary-btn:hover {
            background: #5c3ac4;
            transform: translateY(-1px);
        }

        .edit-btn {
            background: #eee8ff;
            color: #6945d0;
        }

        .edit-btn:hover {
            background: #dfd4ff;
        }

        .delete-btn {
            background: #fff0f2;
            color: #c43d5b;
        }

        .delete-btn:hover {
            background: #ffdde4;
        }

        .type-badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
        }

        .income {
            color: #16845c;
            background: #e5f8ee;
        }

        .expense {
            color: #c43d5b;
            background: #fff0f2;
        }

        .amount {
            font-weight: bold;
            color: #3b2b60;
        }

        .no-data {
            text-align: center;
            padding: 35px;
            color: #817791;
        }

        .actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .actions form {
            margin: 0;
        }

        @media (max-width: 600px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .welcome-section h1 {
                font-size: 24px;
            }

            .table-wrapper {
                padding: 12px;
            }
        }
    </style>
</head>

<body class="login-body">

<div class="login-container">

    <div class="login-box">

        <div class="login-icon">₹</div>

        <h1>Welcome Back</h1>

        <p class="login-subtitle">
            Login to manage your expenses
        </p>

        <form method="POST" action="login.php">

            <label>Email Address</label>

            <input
                type="email"
                name="email"
                placeholder="Enter your email"
                required
            >

            <label>Password</label>

            <input
                type="password"
                name="password"
                placeholder="Enter your password"
                required
            >

            <button type="submit" class="primary-btn login-btn">
                Login →
            </button>

        </form>

        <a href="index.php" class="back-home">
            ← Back to Home
        </a>

    </div>

</div>

</body>
</html>