<p>
    <input type="hidden" id="id" name="id" value="<?= !isset($_GET['idTeacher']) ? "" : $_GET['idTeacher'] ?>">
    <input type="radio" id="genre1" name="genre"
           value="M" <?= !isset($teacher) ? "" : ($teacher['teaGender'] == "M" ? "checked" : "") ?>>
    <label for="genre1">Homme</label>
    <input type="radio" id="genre2" name="genre" value="F"
           value="M" <?= !isset($teacher) ? "" : ($teacher['teaGender'] == "F" ? "checked" : "") ?>>
    <label for="genre2">Femme</label>
    <input type="radio" id="genre3" name="genre"
           value="A" <?= !isset($teacher) ? "" : ($teacher['teaGender'] == "A" ? "checked" : "") ?>>
    <label for="genre3">Autre</label>
</p>
<p>
    <label for="firstName">Nom :</label>
    <input type="text" name="firstName" id="firstName"
           value="<?= !isset($teacher) ? "" : ($teacher['teaFirstname'] ?: "") ?>">
</p>
<p>
    <label for="name">Prénom :</label>
    <input type="text" name="name" id="name" value="<?= !isset($teacher) ? "" : ($teacher['teaName'] ?: "") ?>">
</p>
<p>
    <label for="nickName">Surnom :</label>
    <input type="text" name="nickName" id="nickName"
           value="<?= !isset($teacher) ? "" : ($teacher['teaNickname'] ?: "") ?>">
</p>
<p>
    <label for="origin">Origine :</label>
    <textarea name="origin" id="origin"><?= !isset($teacher) ? "" : ($teacher['teaOrigine'] ?: "") ?></textarea>
</p>
<p>
    <select name="section" id="section">
        <option value="">Section</option>
        <?php
        foreach ($sections as $section) {
            $selected = "";
            if (isset($teacher)) {
                $section['idSection'] != $teacher['fkSection'] ?: $selected = "selected";
            }
            echo '<option value="' . $section['idSection'] . '"' . $selected . '>' . $section['secName'] . '</option>';
        }
        ?>
    </select>
</p>