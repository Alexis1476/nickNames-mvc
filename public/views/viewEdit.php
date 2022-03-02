<?php $this->_title = "Liste des enseignants"; ?>
<div class="user-body">
    <form action="index.php?controller=teacher&action=submitEdit&idTeacher=<?= $teacher['idTeacher'] ?>" method="post">
        <h3>Modification d'un enseignant</h3>
        <?php include_once 'templateFormTeacher.php' ?>
        <p>
            <input type="submit" value="Modifier">
        </p>
    </form>
</div>
<div class="user-footer">
    <a href="index.php">Retour à la page d'accueil</a>
</div>