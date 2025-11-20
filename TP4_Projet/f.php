<?php 
    include "insert.php";

   
    $sqlCourses = "SELECT DISTINCT course FROM `100` ORDER BY course ASC";
    $stmtCourses = $mysqlClient->prepare($sqlCourses);
    $stmtCourses->execute();
    $courses = $stmtCourses->fetchAll(PDO::FETCH_COLUMN);

?>
<h1>Ajouter un résultat :</h1>

<form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8') ?>">
    <input type="hidden" name="action" value="add">

    <label>Nom :</label>
    <input type="text" name="nom"><br><br>

    <label>Pays :</label>
    <input type="text" name="pays" value="<?= htmlspecialchars($_POST['pays'] ?? '') ?>" oninput="this.value = this.value.toUpperCase();" style="text-transform: uppercase;"><br><br>

    <div>
        <label>Course :</label>
        <select name="course">
        <option value="">-- Choisir une course --</option>

        <?php foreach ($courses as $c): ?>
            <option value="<?= htmlspecialchars($c) ?>"><?= htmlspecialchars($c) ?></option>
        <?php endforeach; ?>
        </select>
        <input type="text" name="course_new" placeholder="Nouvelle course">
    </div><br>

    <label>Temps :</label>
    <input type="text" name="temps"><br><br>

    <button type="submit">Enregistrer</button>
</form>
