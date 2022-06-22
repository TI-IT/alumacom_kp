
<a href="https://www.youtube.com/watch?v=zFJF4j6MjUQ&list=PLoonZ8wII66iZSicLNXhE4bxUYaKhIc-L&index=73">Lesson</a>
<hr>
<div id="blockNewSpecies">
    Новый вид товара:
    <input type="text" name="newSpeciesName" id="newSpeciesName" value="">
    <br />

    является подкатегорией для
    <select name="generalSpeciesId">
        <option value="0">Главная категория
            {foreach $rsSpecies as $item}
        <option value="{$item['id']}">{$item['name']}
            {/foreach}
    </select>
    <br />
    <input type="button" onclick="newSpecies();" value="добавить вид товара" />

</div>

<hr>

<div id="blockNewCategory">
    Новая категория:
    <input type="text" name="newCategoryName" id="newCategoryName" value="">
    <br />

    является подкатегорией для
    <select name="generalCatId">
        <option value="0">Главная категория
            {foreach $rsCategories as $item}
                <option value="{$item['id']}">{$item['name']}
            {/foreach}
    </select>
    <br />
    <input type="button" onclick="newCategory();" value="добавить категорию" />

</div>
