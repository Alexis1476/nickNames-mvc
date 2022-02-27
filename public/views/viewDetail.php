<?php $this->_title = "Liste des enseignants"; ?>
<div class="user-head">
    <p><?= var_dump($this); ?></p>
    <h3>Détail : <?= $teacher['teaFirstname'] . ' ' . $teacher['teaName'] ?>
        <img style="margin-left: 1vw;" height="20em" src="./public/resources/img/<?= $genre ?>.png" alt="male symbole">
    </h3>
    <p> <?= $teacher['secName'] ?> </p>
    <div class="actions">
        <a href="index.php?controller=teacher&action=edit&idTeacher=<?= $teacher['idTeacher'] ?>">
            <img height="20em" src="./public/resources/img/edit.png" alt="edit icon"></a>
        <a href="index.php?controller=teacher&action=delete&idTeacher=<?= $teacher['idTeacher'] ?>">
            <img height="20em" src="./public/resources/img/delete.png" alt="delete icon"> </a>
    </div>
</div>
<div class="user-body">
    <p>Surnom : <?= $teacher['teaNickname'] ?></p>
    <p><?= $teacher['teaOrigine'] ?></p>
</div>
<div class="user-footer">
    <a href="index.php">Retour à la page d'accueil</a>
</div>