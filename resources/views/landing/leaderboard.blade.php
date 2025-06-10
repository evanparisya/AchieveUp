<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Leaderboard</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(180deg, #f6f6fe 0%, #f1f1fa 100%);
    }

    .leaderboard-section {
      padding: 60px 20px;
      max-width: 1100px;
      margin: auto;
    }

    .leaderboard-title {
      font-size: 20px;
      font-weight: 600;
      color: #333;
      margin-bottom: 30px;
    }

    .top-3 {
      display: flex;
      justify-content: space-between;
      gap: 20px;
      margin-bottom: 40px;
      flex-wrap: wrap;
    }

    .top-card {
      flex: 1;
      min-width: 200px;
      background: linear-gradient(145deg, #ffffff, #f0f0f0);
      box-shadow: 0 4px 16px rgba(0,0,0,0.08);
      border-radius: 16px;
      padding: 24px;
      text-align: center;
    }

    .top-card h3 {
      margin-bottom: 8px;
      font-size: 16px;
      color: #222;
    }

    .top-card .accuracy {
      font-size: 14px;
      color: #777;
    }

    .top-card .trades {
      margin-top: 4px;
      font-size: 14px;
      color: #aaa;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      border-radius: 12px;
      overflow: hidden;
    }

    table th, table td {
      padding: 14px;
      text-align: center;
      font-size: 14px;
    }

    table th {
      background: #f8f8f8;
      color: #555;
    }

    table tbody tr {
      border-bottom: 1px solid #eee;
    }

    .rank-1 { color: #FFD700; font-weight: bold; }
    .rank-2 { color: #C0C0C0; font-weight: bold; }
    .rank-3 { color: #CD7F32; font-weight: bold; }

    @media (max-width: 768px) {
      .top-3 {
        flex-direction: column;
        align-items: center;
      }
    }
  </style>
</head>
<body>

<section class="leaderboard-section">
  <h2 class="leaderboard-title">🏆 Champions Leaderboard</h2>

  <!-- Top 3 Cards -->
  <div class="top-3">
    <div class="top-card">
      <h3>Roger Korsgaard</h3>
      <div class="accuracy">1st - 90% Accuracy</div>
      <div class="trades">497 Trades</div>
    </div>
    <div class="top-card">
      <h3>Charlie Horwitz</h3>
      <div class="accuracy">2nd - 85% Accuracy</div>
      <div class="trades">389 Trades</div>
    </div>
    <div class="top-card">
      <h3>Ahmad Mango</h3>
      <div class="accuracy">3rd - 80% Accuracy</div>
      <div class="trades">248 Trades</div>
    </div>
  </div>

  <!-- Full Leaderboard Table -->
  <table>
    <thead>
      <tr>
        <th>Peringkat</th>
        <th>Nama</th>
        <th>Tipe</th>
        <th>Streak</th>
        <th>Alerts</th>
        <th>Trades</th>
        <th>Accuracy</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="rank-1">1</td>
        <td>Roger Korsgaard</td>
        <td>Options</td>
        <td>20</td>
        <td>90%</td>
        <td>497</td>
        <td>90%</td>
      </tr>
      <tr>
        <td class="rank-2">2</td>
        <td>Charlie Horwitz</td>
        <td>Stocks</td>
        <td>18</td>
        <td>85%</td>
        <td>389</td>
        <td>85%</td>
      </tr>
      <tr>
        <td class="rank-3">3</td>
        <td>Ahmad Mango</td>
        <td>Options</td>
        <td>15</td>
        <td>80%</td>
        <td>248</td>
        <td>80%</td>
      </tr>
      <tr>
        <td>4</td>
        <td>Cristofer George</td>
        <td>Stocks</td>
        <td>12</td>
        <td>78%</td>
        <td>310</td>
        <td>78%</td>
      </tr>
      <tr>
        <td>5</td>
        <td>Roger Korsgaard</td>
        <td>Options</td>
        <td>10</td>
        <td>75%</td>
        <td>220</td>
        <td>75%</td>
      </tr>
    </tbody>
  </table>
</section>

</body>
</html>
