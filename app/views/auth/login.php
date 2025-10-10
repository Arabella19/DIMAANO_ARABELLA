<?php 
$session = load_class('Session', 'libraries'); 
$old = $session->flashdata('old') ?? []; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student List Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    * { box-sizing: border-box; }

    body {
      margin: 0;
      font-family: 'Inter', sans-serif;
      background: #ffe6f0;
      color: #333;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
      animation: bgPulse 6s infinite alternate;
    }

    @keyframes bgPulse {
      0% { background-color: #ffe6f0; }
      50% { background-color: #ffd1e3; }
      100% { background-color: #ffe6f0; }
    }

    .container {
      width: 100%;
      max-width: 400px;
      background: #ffccdd;
      padding: 30px;
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(216,27,96,0.25);
      animation: slideUp 0.5s ease-out;
    }

    @keyframes slideUp {
      from { transform: translateY(50px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }

    .container h1 {
      text-align: center;
      margin-bottom: 15px;
      font-size: 2rem;
      color: #d81b60;
    }

    .container p {
      text-align: center;
      margin-bottom: 20px;
      color: #880e4f;
      font-size: 0.95rem;
    }

    .flash {
      padding: 10px;
      border-radius: 10px;
      margin-bottom: 15px;
      text-align: center;
      font-weight: 600;
    }
    .success { background: #f8bbd0; color: #880e4f; }
    .error { background: #f48fb1; color: #b71c1c; }

    form { display: flex; flex-direction: column; gap: 15px; }

    label {
      font-weight: 600;
      margin-bottom: 5px;
      color: #880e4f;
    }

    input, button {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 12px;
      font-size: 1rem;
      transition: 0.3s;
    }

    input {
      background: #ffd6e8;
      color: #880e4f;
      box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
    }

    input:focus {
      box-shadow: 0 0 0 3px #d81b60;
      outline: none;
      transform: scale(1.02);
    }

    button {
      background: linear-gradient(135deg, #d81b60, #f06292);
      color: #fff;
      font-weight: 600;
      cursor: pointer;
      box-shadow: 0 5px 15px rgba(216,27,96,0.3);
    }

    button:hover {
      background: linear-gradient(135deg, #f06292, #d81b60);
      transform: translateY(-2px) scale(1.02);
    }

    button:focus {
      box-shadow: 0 0 0 3px #d81b60;
      outline: none;
    }

    .container a {
      color: #c2185b;
      text-decoration: none;
    }

    @media (max-width: 480px) {
      .container { padding: 20px; }
      .container h1 { font-size: 1.6rem; }
    }
  </style>
</head>
<body>

  <div class="container">
    <h1>STUDENT LIST</h1>
    <p>Manage and view all registered students</p>

    <?php if ($session->flashdata('success')): ?>
      <div class="flash success"><?= htmlspecialchars($session->flashdata('success')) ?></div>
    <?php endif; ?>
    <?php if ($session->flashdata('error')): ?>
      <div class="flash error"><?= htmlspecialchars($session->flashdata('error')) ?></div>
    <?php endif; ?>

    <form method="post" action="/auth/login">
      <div>
        <label>Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($old['email'] ?? '') ?>" required>
      </div>

      <div>
        <label>Password</label>
        <input type="password" name="password" required>
      </div>

      <button type="submit">Login</button>
    </form>

    <p style="text-align:center; margin-top:15px;">No account? <a href="/auth/register">Register here</a></p>
  </div>

</body>
</html>
