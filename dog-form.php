<?php require_once "include/header.php";?>

<main>
    <nav>
        <a href="index.php">Home</a>
    </nav>

    <?php if(is_array($model->errors)): ?>
        <?php if(count($model->errors) > 0):?>
            <ul class="error">
                <?php foreach ($model->errors as $error): ?>
                    <li><?=$error?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    <?php endif;?>
    

    <form action="" method="post">
        <fieldset>
            <legend>Dogs Form</legend>
            
            <input type="hidden" name="dog_id" value="<?=$model->dog ? $model->dog->dog_id: ''?>">
            <div class="input-row">
                <label for="dog_name">Name:</label>
                <input type="text" name="dog_name" id="dog_name" value="<?=$model->dog ? $model->dog->dog_name : ''?>">
            </div>

            <div class="input-row">
                <label for="breed_name">Breed:</label>
                <select name="breed_name" id="breed_name">
                <!--options from database -->
                <option value=""></option>
                <?php foreach($model->breeds as $breed): ?>
                    <option value="<?=$breed['breed_id']?>"
                    <?=$model->dog && $model->dog->breed_id === $breed['breed_id'] ?
                    'selected' : ''?>
                    ><?=$breed['breed_name']?></option>
                <?php endforeach; ?>
                </select>
            </div>

            <div class="input-row">
                <label for="age">Age:</label>
                <input type="number" name="age" id="age" value="<?=$model->dog ? $model->dog->age : ''?>">
            </div>

            <div class="input-row">
                <label for="is_fixed">Is fixed:</label>
                <input type="checkbox" name="is_fixed" id="is_fixed" <?=$model->dog && $model->dog->is_vaccinated ? 'checked': ''?>>
            </div>

            <div class="input-row">
                <label for="is_vaccinated">Is vaccinated:</label>
                <input type="checkbox" name="is_vaccinated" id="is_vaccinated" <?=$model->dog && $model->dog->is_vaccinated ? 'checked': ''?>>
            </div>

            <div class="input-row">
                <button type="submit">Create record</button>
            </div>

        </fieldset>
    </form>
</main>

<?php require_once "include/footer.php";?>