<div class="user-head">
    <h3>Détail : <?= $teacher['teaFirstname'] . ' ' . $teacher['teaName'] ?>
        <img style="margin-left: 1vw;" height="20em" src="resources/img/<?= $genre ?>'.png" alt="male symbole"></h3>
    <p> <?= $teacher['secName'] ?> </p>
    <div class="actions">
        <a href="edit.php?idTeacher=<?= $teacher['idTeacher'] ?>">
            <img height="20em" src="resources/img/edit.png" alt="edit icon"></a>
        <a href="delete.php?idTeacher=<?= $teacher['idTeacher'] ?>">
            <img height="20em" src="resources/img/delete.png" alt="delete icon"> </a>
    </div>
</div>
<div class="user-body">
    <p>Surnom :<?= $teacher['teaNickname'] ?></p>
    <p><?= $teacher['teaOrigine'] ?></p>
</div>
<div class="user-footer">
    <a href="index.php">Retour à la page d'accueil</a>
</div>