<?php require 'config.php';require_login();$title='Overview';
$recent=$pdo->query('SELECT e.name,e.position,d.name department,e.email FROM employees e LEFT JOIN departments d ON d.id=e.department_id ORDER BY e.id DESC LIMIT 5')->fetchAll();
$today=$pdo->prepare('SELECT COUNT(*) FROM attendance WHERE attendance_date=? AND status="Present"');$today->execute([date('Y-m-d')]);$present=(int)$today->fetchColumn();
require 'partials/header.php';?>
<div class="pagehead"><div><div class="eyebrow">OVERVIEW</div><h1>Good day, <?=h($_SESSION['admin_name'])?> 👋</h1><p class="sub">Here is what's happening across your office today.</p></div><a class="btn" href="employees.php">＋ Add employee</a></div>
<div class="grid">
<div class="stat"><span class="symbol">♙</span><div class="label">Total employees</div><div class="num"><?=count_rows($pdo,'employees')?></div><div class="hint">Registered team members</div></div>
<div class="stat"><span class="symbol">▤</span><div class="label">Departments</div><div class="num"><?=count_rows($pdo,'departments')?></div><div class="hint">Organizational units</div></div>
<div class="stat"><span class="symbol">◷</span><div class="label">Present today</div><div class="num"><?=$present?></div><div class="hint"><?=date('d M Y')?></div></div>
<div class="stat"><span class="symbol">✓</span><div class="label">Open tasks</div><div class="num"><?=(int)$pdo->query("SELECT COUNT(*) FROM tasks WHERE status!='Completed'")->fetchColumn()?></div><div class="hint">Tasks to follow up</div></div>
</div>
<div class="card"><div class="cardhead"><h2>Recently added employees</h2><a class="btn secondary small" href="employees.php">View all →</a></div><div class="tablewrap"><table><thead><tr><th>Name</th><th>Position</th><th>Department</th><th>Email</th></tr></thead><tbody><?php foreach($recent as $r):?><tr><td><strong><?=h($r['name'])?></strong></td><td><?=h($r['position'])?></td><td><?=h($r['department']??'—')?></td><td><?=h($r['email'])?></td></tr><?php endforeach?><?php if(!$recent):?><tr><td colspan="4" class="empty">No employees yet. Add your first employee to get started.</td></tr><?php endif?></tbody></table></div></div>
<?php require 'partials/footer.php';?>
