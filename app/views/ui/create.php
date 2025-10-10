<?php $session = load_class('Session', 'libraries'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Student</title>
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
      align-items: flex-start;
      min-height: 100vh;
      padding: 30px;
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

    .top-actions {
      display: flex;
      justify-content: flex-start;
      margin-bottom: 15px;
    }

    .back-btn {
      background: #d81b60;
      color: #fff;
      padding: 8px 14px;
      border: none;
      border-radius: 8px;
      font-size: 0.9rem;
      font-weight: 500;
      text-decoration: none;
      transition: 0.3s;
    }

    .back-btn:hover {
      background: #ad1457;
    }

    h2 {
      text-align: center;
      margin-bottom: 15px;
      font-size: 1.8rem;
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
      margin-bottom: 15px;
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
      font-size: 0.95rem;
      color: #880e4f;
    }

    input, select {
      width: 100%;
      padding: 12px;
      border-radius: 12px;
      border: none;
      outline: none;
      background: #ffd6e8;
      color: #880e4f;
      font-size: 0.95rem;
      transition: 0.3s;
    }

    input:focus, select:focus {
      box-shadow: 0 0 0 3px #d81b60;
      outline: none;
      transform: scale(1.02);
    }

    input[type="file"] {
      padding: 8px;
      cursor: pointer;
    }

    button {
      background: linear-gradient(135deg, #d81b60, #f06292);
      color: #fff;
      padding: 12px;
      border: none;
      border-radius: 12px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      box-shadow: 0 5px 15px rgba(216,27,96,0.3);
      transition: 0.3s;
    }

    button:hover {
      background: linear-gradient(135deg, #f06292, #d81b60);
      transform: translateY(-2px) scale(1.02);
    }

    button:focus { box-shadow: 0 0 0 3px #d81b60; outline: none; }

    @media (max-width: 480px) {
      .container { padding: 20px; }
      h2 { font-size: 1.6rem; }
    }
  </style>
</head>
<body>
  <div class="container">

    <div class="top-actions">
      <a href="/students" class="back-btn">⬅ Back to List</a>
    </div>

    <h2>Add Student</h2>
    <p class="sub">Fill out the form below to register a new student</p>

    <?php if ($session->flashdata('success')): ?>
      <div class="flash success"><?= htmlspecialchars($session->flashdata('success')) ?></div>
    <?php endif; ?>
    <?php if ($session->flashdata('error')): ?>
      <div class="flash error"><?= htmlspecialchars($session->flashdata('error')) ?></div>
    <?php endif; ?>

    <form method="post" action="/students/create" enctype="multipart/form-data">
      <div>
        <label>First Name</label>
        <input type="text" name="first_name" required>
      </div>

      <div>
        <label>Last Name</label>
        <input type="text" name="last_name" required>
      </div>

      <div>
        <label>Email</label>
        <input type="email" name="email" required>
      </div>

      <div>
        <label>Password</label>
        <input type="password" name="password" required>
      </div>

      <div>
        <label>Role</label>
        <select name="role" required>
          <option value="user" selected>User</option>
          <option value="admin">Admin</option>
        </select>
      </div>

      <button type="submit">Save Student</button>
    </form>

  </div>
</body>
</html>
