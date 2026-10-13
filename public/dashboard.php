<?php

session_start();

if (!isset($_SESSION["logged_in"])) {
    header("Location: login.php");
    exit;
}

require_once "config/db.php";

$total_income = 0;
$total_expense = 0;

$result = $conn->query(
    "SELECT type, SUM(amount) AS total
     FROM transactions
     GROUP BY type"
);

if ($result) {

    while ($row = $result->fetch_assoc()) {

        if ($row["type"] == "income") {
            $total_income = $row["total"];
        }

        if ($row["type"] == "expense") {
            $total_expense = $row["total"];
        }
    }
}

$balance = $total_income - $total_expense;

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Dashboard - Student Expense Tracker</title>

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

<body>

<nav class="navbar">

    <div class="logo">
        Student Expense Tracker
    </div>

    <div class="nav-links">

        <a href="dashboard.php">Dashboard</a>

        <a href="report.php">Report</a>

        <a href="login.php" class="logout">
            Logout
        </a>

    </div>

</nav>


<div class="dashboard-container">

    <div class="welcome-section">

        <div>

            <p class="small-title">
                STUDENT FINANCE
            </p>

            <h1>Dashboard</h1>

            <p>
                Welcome back! Here's your financial overview.
            </p>

        </div>

        <a href="add_transaction.php"
           class="primary-btn">
            + Add Transaction
        </a>

    </div>


    <div class="summary-cards">

        <div class="summary-card income-card">

            <div class="card-icon">₹</div>

            <p>Total Income</p>

            <h2>
                ₹<?php echo number_format($total_income, 2); ?>
            </h2>

        </div>


        <div class="summary-card expense-card">

            <div class="card-icon">−</div>

            <p>Total Expenses</p>

            <h2>
                ₹<?php echo number_format($total_expense, 2); ?>
            </h2>

        </div>


        <div class="summary-card balance-card">

            <div class="card-icon">✓</div>

            <p>Balance</p>

            <h2>
                ₹<?php echo number_format($balance, 2); ?>
            </h2>

        </div>

    </div>


    <div class="quick-actions">

        <h2>Quick Actions</h2>

        <div class="action-grid">

            <a href="add_transaction.php"
               class="action-card">

                <span>＋</span>

                <div>
                    <h3>Add Transaction</h3>
                    <p>Record your income or expense</p>
                </div>

            </a>


            <a href="report.php"
               class="action-card">

                <span>📊</span>

                <div>
                    <h3>View Transactions</h3>
                    <p>View all your transactions</p>
                </div>

            </a>


            <a href="report.php"
               class="action-card">

                <span>📈</span>

                <div>
                    <h3>Monthly Report</h3>
                    <p>Analyze your spending</p>
                </div>

            </a>

        </div>

    </div>

</div>

<script src="js/dashboard.js"></script>

</body>
</html>