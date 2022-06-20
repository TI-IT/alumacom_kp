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

    <a href="https://www.youtube.com/watch?v=llaqoGp3yuM&list=PLoonZ8wII66iZSicLNXhE4bxUYaKhIc-L&index=67">Lesson</a>
</div>