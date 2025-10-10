<?php $session = load_class('Session', 'libraries'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Students List</title>
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
      align-items: flex-start;
      min-height: 100vh;
      padding: 30px;
    }

    .container {
      width: 100%;
      max-width: 1100px;
      background: #ffccdd;
      padding: 30px;
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(216,27,96,0.25);
    }

    h2 {
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
      margin-bottom: 15px;
      font-weight: 600;
      text-align: center;
    }
    .success { background: #f8bbd0; color: #880e4f; }
    .error { background: #f48fb1; color: #b71c1c; }

    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      margin-bottom: 20px;
      gap: 15px;
    }

    .btn {
      background: linear-gradient(135deg, #d81b60, #f06292);
      color: #fff;
      padding: 8px 14px;
      border-radius: 12px;
      text-decoration: none;
      font-size: 0.9rem;
      font-weight: 600;
      transition: 0.3s;
      box-shadow: 0 5px 15px rgba(216,27,96,0.3);
    }
    .btn:hover { 
      background: linear-gradient(135deg, #f06292, #d81b60);
      transform: translateY(-2px) scale(1.02);
    }
    .btn.logout { background: #f48fb1; }
    .btn.logout:hover { background: #d81b60; }
    .btn.secondary { background: #ffd6e8; color: #880e4f; }
    .btn.secondary:hover { background: #ffb6c1; }

    .search-bar input {
      padding: 10px 12px;
      border: none;
      border-radius: 12px;
      background: #ffd6e8;
      color: #880e4f;
      outline: none;
      width: 220px;
      font-size: 0.95rem;
      transition: 0.3s;
    }
    .search-bar input:focus {
      box-shadow: 0 0 0 3px #d81b60;
      transform: scale(1.02);
    }

    table.list {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }
    table.list thead {
      background: #ffb6c1;
    }
    table.list th, table.list td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid #ff99bb;
    }
    table.list th {
      font-weight: 700;
      color: #880e4f;
      text-transform: uppercase;
      font-size: 0.85rem;
    }
    table.list td {
      font-size: 0.95rem;
      color: #880e4f;
    }

    .actions-col { white-space: nowrap; }

    .pagination {
      margin-top: 25px;
      text-align: center;
    }
    .pagination ul {
      list-style: none;
      padding: 0;
      margin: 0;
      display: inline-flex;
      gap: 8px;
    }
    .pagination a {
      display: inline-block;
      padding: 8px 14px;
      border-radius: 12px;
      background: #ffd6e8;
      color: #880e4f;
      text-decoration: none;
      font-weight: 600;
      transition: 0.3s;
    }
    .pagination a:hover { 
      background: linear-gradient(135deg, #d81b60, #f06292);
      color: #fff;
    }

    @media (max-width: 480px) {
      .container { padding: 20px; }
      h2 { font-size: 1.6rem; }
      .search-bar input { width: 100%; margin-top: 10px; }
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Students List</h2>
    <p class="sub">Manage and view all registered students</p>

    <?php if ($session->flashdata('success')): ?>
      <div class="flash success"><?= htmlspecialchars($session->flashdata('success')) ?></div>
    <?php endif; ?>
    <?php if ($session->flashdata('error')): ?>
      <div class="flash error"><?= htmlspecialchars($session->flashdata('error')) ?></div>
    <?php endif; ?>

    <div class="top-bar">
      <div class="actions">
        <a class="btn" href="/students/create">Add New</a>
        <a class="btn logout" href="/auth/logout">Logout</a>
        <?php if (!empty($show_deleted)): ?>
          <a class="btn secondary" href="/students/get-all">Show Active</a>
        <?php else: ?>
          <a class="btn secondary" href="/students/get-all?show=deleted">Show Deleted</a>
        <?php endif; ?>
      </div>

      <div class="search-bar">
        <form method="get" action="/students/get-all">
          <?php if (!empty($show_deleted)): ?>
            <input type="hidden" name="show" value="deleted">
          <?php endif; ?>
          <input type="text" name="search" placeholder="Search students..." value="<?= htmlspecialchars($search ?? '') ?>">
          <button type="submit" class="btn">Search</button>
        </form>
      </div>
    </div>

    <?php if (!empty($records)): ?>
      <table class="list">
        <thead>
          <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($records as $r): ?>
            <tr>
              <td><?= htmlspecialchars($r['id']) ?></td>
              <td><?= htmlspecialchars($r['first_name']) ?></td>
              <td><?= htmlspecialchars($r['last_name']) ?></td>
              <td><?= htmlspecialchars($r['email']) ?></td>
              <td class="actions-col">
                <?php if (empty($show_deleted)): ?>
                  <a class="btn" href="/students/update/<?= $r['id'] ?>">Edit</a>
                  <a class="btn secondary" href="/students/delete/<?= $r['id'] ?>" onclick="return confirm('Delete this student?')">Delete</a>
                <?php else: ?>
                  <a class="btn" href="/students/restore/<?= $r['id'] ?>">Restore</a>
                  <a class="btn secondary" href="/students/hard_delete/<?= $r['id'] ?>" onclick="return confirm('Permanently delete?')">Hard Delete</a>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <div class="pagination">
        <?php
          if (!empty($pagination_links)) {
            echo "<ul>" . str_replace(
                ['<ul>', '</ul>', '<li>', '</li>'],
                ['', '', '<li>', '</li>'], 
                $pagination_links
            ) . "</ul>";
          }
        ?>
      </div>
    <?php else: ?>
      <p style="text-align:center; margin-top:20px;">No students found.</p>
    <?php endif; ?>
  </div>
</body>
</html>
