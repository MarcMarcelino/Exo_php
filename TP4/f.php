<?php
include "config.php";
// Requetes et affichage sécurisé côté serveur
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

// Construire la requête (les identifiants sont validés ci-dessus)
$sql = 'SELECT * FROM `100` ORDER BY ' . $sort . ' ' . $order;
$query = $mysqlClient->prepare($sql);
$query->execute();
$data = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- HTML rendu côté serveur : la classe 'active' est ajoutée par PHP selon la condition -->
<style>
    th a { text-decoration: none; color: black; font-size: 18px; padding: 2px; }
    th a.active { color: red; font-weight: bold; }
</style>

<table border="1">
<thead>
    <tr>
        <th>Nom <a class="<?= ($sort=='nom' && $order=='asc') ? 'active' : '' ?>" href="?sort=nom&order=asc">▲</a> <a class="<?= ($sort=='nom' && $order=='desc') ? 'active' : '' ?>" href="?sort=nom&order=desc">▼</a></th>
        <th>Pays <a class="<?= ($sort=='pays' && $order=='asc') ? 'active' : '' ?>" href="?sort=pays&order=asc">▲</a> <a class="<?= ($sort=='pays' && $order=='desc') ? 'active' : '' ?>" href="?sort=pays&order=desc">▼</a></th>
        <th>Course <a class="<?= ($sort=='course' && $order=='asc') ? 'active' : '' ?>" href="?sort=course&order=asc">▲</a> <a class="<?= ($sort=='course' && $order=='desc') ? 'active' : '' ?>" href="?sort=course&order=desc">▼</a></th>
        <th>Temps 
            <a class="<?= ($sort=='temps' && $order=='asc') ? 'active' : '' ?>" href="?sort=temps&order=asc">▲</a> 
            <a class="<?= ($sort=='temps' && $order=='desc') ? 'active' : '' ?>" href="?sort=temps&order=desc">▼</a>
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

<h1>Ajouter un résultat :</h1>

<form method="post" action="/">
    
    <label>Nom :</label>
    <input type="text" name="nom"><br><br>

    <label>Pays :</label>
    <input type="text" name="pays"><br><br>

    <label>Course :</label>
    <input type="text" name="course"><br><br>

    <label>Temps :</label>
    <input type="text" name="temps"><br><br>

    <button type="submit">Enregistrer</button>

</form>
