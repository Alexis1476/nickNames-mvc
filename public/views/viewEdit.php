<?php $this->_title = "Liste des enseignants"; ?>
<div class="user-body">
    <form action="#" method="post">
        <h3>Ajout d'un enseignant</h3>
        <p>
            <input type="hidden" id="id" name="id" value="<?= $_GET['idTeacher'] ?>">
            <input type="radio" id="genre1" name="genre"
                   value="M" <?= $teacher['teaGender'] == "M" ? "checked" : "" ?>>
            <label for="genre1">Homme</label>
            <input type="radio" id="genre2" name="genre" value="F"
                   value="M" <?= $teacher['teaGender'] == "F" ? "checked" : "" ?>>
            <label for="genre2">Femme</label>
            <input type="radio" id="genre3" name="genre"
                   value="A" <?= $teacher['teaGender'] == "A" ? "checked" : "" ?>>
            <label for="genre3">Autre</label>
        </p>
        <p>
            <label for="firstName">Nom :</label>
            <input type="text" name="firstName" id="firstName" value="<?= $teacher['teaFirstname'] ?: "" ?>">
        </p>
        <p>
            <label for="name">Prénom :</label>
            <input type="text" name="name" id="name" value="<?= $teacher['teaName'] ?: "" ?>">
        </p>
        <p>
            <label for="nickName">Surnom :</label>
            <input type="text" name="nickName" id="nickName" value="<?= $teacher['teaNickname'] ?: "" ?>">
        </p>
        <p>
            <label for="origin">Origine :</label>
            <textarea name="origin" id="origin"><?= $teacher['teaOrigine'] ?: "" ?></textarea>
        </p>
        <p>
            <select name="section" id="section">
                <option value="">Section</option>
                <?php
                foreach ($sections as $section) {
                    $selected = "";
                    $section['idSection'] != $teacher['fkSection'] ?: $selected = "selected";
                    echo '<option value="' . $section['idSection'] . '"' . $selected . '>' . $section['secName'] . '</option>';
                }
                ?>
            </select>
        </p>
        <p>
            <input type="submit" value="Modifier">
        </p>
    </form>
</div>
<div class="user-footer">
    <a href="index.php">Retour à la page d'accueil</a>
</div>