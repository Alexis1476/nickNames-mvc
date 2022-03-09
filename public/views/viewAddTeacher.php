<?php $this->_title = "Liste des enseignants"; ?>
<div class="user-body">
    <form id="form" action="index.php?controller=teacher&action=submitAdd" method="post">
        <h3>Ajout d'un enseignant</h3>
        <?php include_once 'templateFormTeacher.php' ?>
        <p>
            <input type="submit" value="Ajouter">
            <button type="button" onclick="document.getElementById('form').reset();">Effacer</button>
        </p>
    </form>
</div>
<div class="user-footer">
    <a href="index.php">Retour à la page d'accueil</a>
</div>