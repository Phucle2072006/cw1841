<form action="" method="post">
    <input type="hidden" name="id" value="<?=$joke['id']?>">

    <label for="joketext">Edit your joke here:</label>
    <textarea name="joketext" rows="3" cols="40"><?=htmlspecialchars($joke['joketext'], ENT_QUOTES, 'UTF-8')?></textarea>

    <label for="authors">Author:</label>
    <select name="authors">
        <?php foreach ($authors as $author): ?>
            <option value="<?=$author['id']?>" 
                <?=($author['id'] == $joke['authorid']) ? 'selected' : ''?>>
                <?=htmlspecialchars($author['name'], ENT_QUOTES, 'UTF-8')?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="categories">Category:</label>
    <select name="categories">
        <?php foreach ($categories as $category): ?>
            <option value="<?=$category['id']?>" 
                <?=($category['id'] == $joke['categoryid']) ? 'selected' : ''?>>
                <?=htmlspecialchars($category['categoryName'], ENT_QUOTES, 'UTF-8')?>
            </option>
        <?php endforeach; ?>
    </select>

    <input type="submit" name="submit" value="Save changes">
</form>