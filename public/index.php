<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Expense Tracker</title>

    <link rel="stylesheet" href="css/style.css">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    min-height: 100vh;
    background: linear-gradient(135deg, #f5f0ff, #ffffff, #ede4ff);
    color: #241442;
}

.home-container {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 30px;
}

.home-container h1 {
    font-size: 48px;
    font-weight: 800;
    color: #6d28d9;
    margin-bottom: 18px;
}

.home-container p {
    color: #6b6280;
    font-size: 18px;
    line-height: 1.8;
    max-width: 600px;
    margin-bottom: 30px;
}

.home-container a,
.home-container button {
    display: inline-block;
    padding: 14px 32px;
    margin: 8px;
    border: none;
    border-radius: 12px;
    background: #6d28d9;
    color: white;
    font-size: 16px;
    font-weight: bold;
    text-decoration: none;
    cursor: pointer;
    transition: 0.3s;
}

.home-container a:hover,
.home-container button:hover {
    background: #4c1d95;
    transform: translateY(-3px);
    box-shadow: 0 8px 20px #6d28d933;
}

.home-container .secondary-btn {
    background: white;
    color: #6d28d9;
    border: 2px solid #6d28d9;
}
</style>

</head>

<body>

<div class="home-container">

    <nav class="navbar">
        <div class="logo">Student Expense Tracker</div>

        <a href="login.php" class="nav-login">Login</a>
    </nav>

    <section class="hero">

        <div class="hero-text">

            <p class="small-title">SMART MONEY MANAGEMENT</p>

            <h1>
                Student Expense
                <span>Tracker</span>
            </h1>

            <p>
                Manage your income and expenses easily.
                Keep track of your spending and understand
                where your money goes.
            </p>

            <a href="login.php" class="primary-btn">
                Get Started →
            </a>

        </div>

        <div class="hero-card">

            <div class="money-icon">₹</div>

            <h3>Track Your Money</h3>

            <p>
                Record your income and expenses
                in one simple place.
            </p>

        </div>

    </section>

</div>

</body>
</html>