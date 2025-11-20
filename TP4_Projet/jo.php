<a href="f.php">Ajouter une Course</a> <br> <br>

<?php
include "config.php";

$allowedSort = ['nom','pays','course','temps'];
$allowedOrder = ['asc','desc'];

$sort = 'nom';
if (isset($_GET['sort']) && in_array($_GET['sort'], $allowedSort, true)) {
    $sort = $_GET['sort'];
}

$order = 'desc';
if (isset($_GET['order']) && in_array(strtolower($_GET['order']), $allowedOrder, true)) {
    $order = strtolower($_GET['order']);
}
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

$total = $mysqlClient->query("SELECT COUNT(*) FROM `100`")->fetchColumn();
$totalPages = ceil($total / $limit);

$sql = "SELECT * FROM `100` ORDER BY $sort $order LIMIT $limit OFFSET $offset";
$query = $mysqlClient->prepare($sql);
$query->execute();
$data = $query->fetchAll(PDO::FETCH_ASSOC);


?>


<style>
    th a { text-decoration: none; color: black; font-size: 18px; padding: 2px; }
    th a.active { color: red; font-weight: bold; }
</style>

<table border="1">
<thead>
    <tr>
        <th>Nom 
            <a class="<?= ($sort=='nom' && $order=='asc') ? 'active' : '' ?>" href="?sort=nom&order=asc&page=<?= $page ?>">▲</a> 
            <a class="<?= ($sort=='nom' && $order=='desc') ? 'active' : '' ?>" href="?sort=nom&order=desc&page=<?= $page ?>">▼</a>
        </th>
        <th>Pays 
            <a class="<?= ($sort=='pays' && $order=='&page=<?= $page ?>') ? 'active' : '' ?>" href="?sort=pays&order=asc&page=<?= $page ?>">▲</a> 
            <a class="<?= ($sort=='pays' && $order=='desc') ? 'active' : '' ?>" href="?sort=pays&order=desc&page=<?= $page ?>">▼</a>
        </th>
        <th>Course 
            <a class="<?= ($sort=='course' && $order=='asc') ? 'active' : '' ?>" href="?sort=course&order=asc&page=<?= $page ?>">▲</a> 
            <a class="<?= ($sort=='course' && $order=='desc') ? 'active' : '' ?>" href="?sort=course&order=desc&page=<?= $page ?>">▼</a>
        </th>
        <th>Temps 
            <a class="<?= ($sort=='temps' && $order=='asc') ? 'active' : '' ?>" href="?sort=temps&order=asc&page=<?= $page ?>">▲</a> 
            <a class="<?= ($sort=='temps' && $order=='desc') ? 'active' : '' ?>" href="?sort=temps&order=desc&page=<?= $page ?>">▼</a>
        </th>
    </tr>
</thead>
<tbody>
<?php foreach ($data as $value): ?>
    <tr>
        <td><?= htmlspecialchars($value['nom']) ?></td>
        <td><?= htmlspecialchars($value['pays']) ?></td>
        <td><?= htmlspecialchars($value['course']) ?></td>
        <td><?= htmlspecialchars($value['temps']) ?></td>
    </tr>
<?php endforeach; ?>

</tbody>
</table>
<br><br>
<div class="pagination">
    <?php if ($page > 1): ?>
        <a href="?page=<?= $page - 1 ?>&sort=<?= $sort ?>&order=<?= $order ?>">Précédent</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a class="<?= ($i == $page) ? 'active' : '' ?>"
           href="?page=<?= $i ?>&sort=<?= $sort ?>&order=<?= $order ?>">
           <?= $i ?>
        </a>
    <?php endfor; ?>

    <?php if ($page < $totalPages): ?>
        <a href="?page=<?= $page + 1 ?>&sort=<?= $sort ?>&order=<?= $order ?>">Suivant</a>
    <?php endif; ?>
</div>



