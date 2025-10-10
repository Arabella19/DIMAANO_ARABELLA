<?php $session = load_class('Session', 'libraries'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Profile</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    * { box-sizing: border-box; }

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
      animation: bgPulse 6s infinite alternate;
    }

    @keyframes bgPulse {
      0% { background-color: #ffe6f0; }
      50% { background-color: #ffd1e3; }
      100% { background-color: #ffe6f0; }
    }

    .container {
      width: 100%;
      max-width: 500px;
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

    h1 {
      text-align: center;
      margin-bottom: 10px;
      font-size: 2rem;
      color: #d81b60;
    }

    p.sub {
      text-align: center;
      margin-bottom: 25px;
      color: #880e4f;
      font-size: 0.95rem;
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

    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    label {
      font-weight: 600;
      margin-bottom: 5px;
      display: block;
    }

    input, button {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 12px;
      font-size: 1rem;
      outline: none;
    }

    input {
      background: #ffd6e8;
      color: #880e4f;
      transition: 0.3s;
    }

    input:focus {
      box-shadow: 0 0 0 3px #d81b60;
      transform: scale(1.02);
    }

    button {
      background: linear-gradient(135deg, #d81b60, #f06292);
      color: #fff;
      font-weight: 600;
      cursor: pointer;
      box-shadow: 0 5px 15px rgba(216,27,96,0.3);
      transition: 0.3s;
    }

    button:hover {
      background: linear-gradient(135deg, #f06292, #d81b60);
      transform: translateY(-2px) scale(1.02);
    }

    .actions {
      display: flex;
      flex-direction: column;
      gap: 15px;
      margin-top: 20px;
    }

    .btn {
      text-align: center;
      background: linear-gradient(135deg, #d81b60, #f06292);
      padding: 12px;
      border-radius: 12px;
      text-decoration: none;
      color: #fff;
      font-weight: 600;
      transition: 0.3s;
      box-shadow: 0 5px 15px rgba(216,27,96,0.3);
    }

    .btn:hover {
      background: linear-gradient(135deg, #f06292, #d81b60);
    }

    .logout {
      background: #f48fb1;
    }

    .logout:hover {
      background: #d81b60;
    }

    @media (max-width: 480px) {
      .container { padding: 20px; }
      h1 { font-size: 1.6rem; }
    }
  </style>
</head>
<body>

  <div class="container">
    <h1>User Profile</h1>
    <p class="sub">Manage and update your account details</p>

    <?php if ($session->flashdata('success')): ?>
      <div class="flash success"><?= htmlspecialchars($session->flashdata('success')) ?></div>
    <?php endif; ?>
    <?php if ($session->flashdata('error')): ?>
      <div class="flash error"><?= htmlspecialchars($session->flashdata('error')) ?></div>
    <?php endif; ?>

    <form method="post" action="/user/update_profile" enctype="multipart/form-data">
      <label>First Name</label>
      <input type="text" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" required>

      <label>Last Name</label>
      <input type="text" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" required>

      <label>Email</label>
      <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

      <label>New Password (leave blank to keep current)</label>
      <input type="password" name="password">

      <button type="submit">Update Profile</button>
    </form>

    <div class="actions">
      <a class="btn" href="/user/dashboard">Dashboard</a>
      <a class="btn logout" href="/auth/logout">Logout</a>
    </div>
  </div>

</body>
</html>
