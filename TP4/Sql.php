<?php
include "config.php";
// Requetes 
$sort = "nom";
if (isset($_GET['sort'])) {
    $sort = "$_GET[sort]";
}
$order = "desc";
if (isset($_GET['order'])) {
    $order = $_GET['order'];
} 

$query = $mysqlClient->prepare('SELECT * FROM `100` ORDER BY '.$sort.' '.$order);
$query->execute();

$data = $query->fetchAll(PDO::FETCH_ASSOC);
?>
 
<table border="1">
<thead>
    <tr>
        <th>Nom 
            <a class="<?= ($sort=="nom" && $order=="asc")  ? 'active' : '' ?>" href="?sort=nom&order=asc">▲</a> 
            <a class="<?= ($sort=="nom" && $order=="desc")  ? 'active' : '' ?>" href="?sort=nom&order=desc">▼</a>
        </th>
        <th>Pays 
            <a class="<?= ($sort=="pays" && $order=="asc")  ? 'active' : '' ?>" href="?sort=pays&order=asc">▲</a> 
            <a class="<?= ($sort=="pays" && $order=="desc")  ? 'active' : '' ?>" href="?sort=pays&order=desc">▼</a>
        </th>
        <th>Course 
            <a class="<?= ($sort=="course" && $order=="asc")  ? 'active' : '' ?>" href="?sort=course&order=asc">▲</a> 
            <a class="<?= ($sort=="course" && $order=="desc")  ? 'active' : '' ?>" href="?sort=course&order=desc">▼</a>
        </th>
        <th>Temps 
            <a class="<?= ($sort=="temps" && $order=="asc")  ? 'active' : '' ?>" href="?sort=temps&order=asc">▲</a> 
            <a class="<?= ($sort=="temps" && $order=="desc")  ? 'active' : '' ?>" href="?sort=temps&order=desc">▼</a>
        </th>
    </tr>
</thead>
<tbody>
<?php

foreach ($data as $value) {
    echo "<tr>
            <td>".$value['nom']."</td>
            <td>".$value['pays']."</td>
            <td>".$value['course']."</td>
            <td>".$value['temps']."</td>
          </tr>";
}

echo "</tbody></table>";


// Fermeture de la connexion
$mysqlClient = null;
$dBhost = null;
?>
<style>
    th a {
    text-decoration: none;
    color: black;
    font-size: 18px;
    padding: 2px;
}

th a.active {
    color: red;   /* couleur quand la flèche est active */
    font-weight: bold;
}

</style>