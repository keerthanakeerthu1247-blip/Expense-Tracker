
<?php
session_start();

if (!isset($_SESSION["logged_in"])) {
    header("Location: login.php");
    exit;
}

require_once "config/db.php";

$result = $conn->query(
    "SELECT *
     FROM transactions
     ORDER BY transaction_date DESC, id DESC"
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions - Student Expense Tracker</title>
    <link rel="stylesheet" href="css/style.css">

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
    <div class="logo">💰 Student Expense Tracker</div>

    <div class="nav-links">
        <a href="dashboard.php">Dashboard</a>
        <a href="report.php">Transactions</a>
        <a href="logout.php">Logout</a>
    </div>
</nav>

<div class="table-container">

    <div class="welcome-section">
        <div>
            <p class="small-title">FINANCIAL HISTORY</p>
            <h1>All Transactions</h1>
            <p>View and manage your income and expenses.</p>
        </div>

        <a href="add_transaction.php" class="primary-btn">
            + Add Transaction
        </a>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
            <?php if ($result && $result->num_rows > 0): ?>

                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <?= htmlspecialchars($row["transaction_date"] ?? "") ?>
                        </td>

                        <td>
                            <span class="type-badge <?= htmlspecialchars($row["type"] ?? "") ?>">
                                <?= htmlspecialchars(ucfirst($row["type"] ?? "")) ?>
                            </span>
                        </td>

                        <td>
                            <?= htmlspecialchars($row["category"] ?? "") ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($row["description"] ?? "") ?>
                        </td>

                        <td class="amount">
                            ₹<?= number_format((float)$row["amount"], 2) ?>
                        </td>

                        <td>
                            <div class="actions">
                                <a class="edit-btn"
                                   href="edit_transaction.php?id=<?= (int)$row["id"] ?>">
                                    Edit
                                </a>

                                <form method="POST"
                                      action="delete_transaction.php"
                                      onsubmit="return confirm('Are you sure you want to delete this transaction?');">

                                    <input type="hidden"
                                           name="id"
                                           value="<?= (int)$row["id"] ?>">

                                    <button type="submit" class="delete-btn">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>

            <?php else: ?>
                <tr>
                    <td colspan="6" class="no-data">
                        No transactions found. Add your first transaction!
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
