<a href="f.php">Ajouter une Course</a> <br><br>

<?php
include "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = (int)$_POST['id'];
    $nom = trim($_POST['nom']);
    $pays = strtoupper(trim($_POST['pays']));
    $course = trim($_POST['course']);
    $temps = trim($_POST['temps']);

    $sql = "UPDATE `100` SET nom=:nom, pays=:pays, course=:course, temps=:temps WHERE id=:id";
    $stmt = $mysqlClient->prepare($sql);
    $stmt->execute([
        ':nom' => $nom,
        ':pays' => $pays,
        ':course' => $course,
        ':temps' => $temps,
        ':id' => $id
    ]);

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$searchNom = $_GET['search_nom'] ?? '';
$searchPays = $_GET['search_pays'] ?? '';
$searchCourse = $_GET['search_course'] ?? '';

$allowedSort = ['nom','pays','course','temps'];
$allowedOrder = ['asc','desc'];

$sort = in_array($_GET['sort'] ?? '', $allowedSort, true) ? $_GET['sort'] : 'nom';
$order = in_array(strtolower($_GET['order'] ?? ''), $allowedOrder, true) ? strtolower($_GET['order']) : 'desc';

$sql = "SELECT * FROM `100` WHERE 1";
$params = [];

if ($searchNom !== '') {
    $sql .= " AND nom LIKE :nom";
    $params[':nom'] = "%$searchNom%";
}
if ($searchPays !== '') {
    $sql .= " AND pays LIKE :pays";
    $params[':pays'] = "%$searchPays%";
}
if ($searchCourse !== '') {
    $sql .= " AND course LIKE :course";
    $params[':course'] = "%$searchCourse%";
}

$sql .= " ORDER BY $sort $order";
$stmt = $mysqlClient->prepare($sql);
$stmt->execute($params);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Rechercher</h2>
<form method="get">
    Nom: <input type="text" name="search_nom" value="<?= htmlspecialchars($searchNom) ?>">
    Pays: <input type="text" name="search_pays" value="<?= htmlspecialchars($searchPays) ?>">
    Course: <input type="text" name="search_course" value="<?= htmlspecialchars($searchCourse) ?>">
    <button type="submit">Rechercher</button>
    <a href="<?= $_SERVER['PHP_SELF'] ?>">Réinitialiser</a>
</form>

<h2>Résultats</h2>
<table border="1" style="border-collapse: collapse; width: 100%;">
<thead>
<tr>
    <th>Nom</th>
    <th>Pays</th>
    <th>Course</th>
    <th>Temps</th>
    <th>Actions</th>
</tr>
</thead>
<tbody>
<?php foreach ($data as $row): ?>
<tr>
    <form method="post">
        <td><input type="text" name="nom" value="<?= htmlspecialchars($row['nom']) ?>"></td>
        <td><input type="text" name="pays" value="<?= htmlspecialchars($row['pays']) ?>" oninput="this.value = this.value.toUpperCase();"></td>
        <td><input type="text" name="course" value="<?= htmlspecialchars($row['course']) ?>"></td>
        <td><input type="text" name="temps" value="<?= htmlspecialchars($row['temps']) ?>"></td>
        <td>
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <button type="submit" name="update">Modifier</button>
        </td>
    </form>
</tr>
<?php endforeach; ?>
</tbody>
</table>
