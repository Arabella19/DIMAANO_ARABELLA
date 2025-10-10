<?php $session = load_class('Session', 'libraries'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

  <style>
    body {
      margin: 0;
      font-family: 'Inter', sans-serif;
      background: #ffe6f0;
      color: #880e4f;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
    }

    .container {
      width: 100%;
      max-width: 450px;
      background: #ffccdd;
      padding: 30px;
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(216,27,96,0.25);
      text-align: center;
      animation: slideUp 0.5s ease-out;
    }

    @keyframes slideUp {
      from { transform: translateY(50px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }

    h2 {
      margin-bottom: 10px;
      font-size: 2rem;
      color: #d81b60;
    }

    .welcome {
      font-size: 1.2rem;
      font-weight: 600;
      margin-bottom: 20px;
      color: #880e4f;
    }

    .flash {
      padding: 12px;
      border-radius: 10px;
      margin-bottom: 20px;
      font-weight: 600;
      text-align: center;
    }
    .success { background: #f8bbd0; color: #880e4f; }
    .error { background: #f48fb1; color: #b71c1c; }

    .actions {
      display: flex;
      flex-direction: column;
      gap: 15px;
      margin-top: 10px;
    }

    .btn {
      display: block;
      padding: 12px;
      border-radius: 12px;
      background: linear-gradient(135deg, #d81b60, #f06292);
      color: #fff;
      font-weight: 600;
      text-decoration: none;
      transition: 0.3s;
      box-shadow: 0 5px 15px rgba(216,27,96,0.3);
    }
    .btn:hover {
      background: linear-gradient(135deg, #f06292, #d81b60);
      transform: translateY(-2px) scale(1.02);
    }

    .logout {
      background: #f48fb1;
    }
    .logout:hover {
      background: #d81b60;
    }

    @media (max-width: 480px) {
      .container { padding: 20px; }
      h2 { font-size: 1.6rem; }
    }
  </style>
</head>
<body>

  <div class="container">
    <h2>User Dashboard</h2>
    <p class="welcome">Welcome!</p>

    <?php if ($session->flashdata('success')): ?>
      <div class="flash success"><?= htmlspecialchars($session->flashdata('success')) ?></div>
    <?php endif; ?>

    <div class="actions">
      <a class="btn" href="/user/profile">Profile</a>
      <a class="btn logout" href="/auth/logout">Logout</a>
    </div>
  </div>

</body>
</html>
