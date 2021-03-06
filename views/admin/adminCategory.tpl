
<h2>Категории</h2>
<div id="blockNewCategory">
    Новая категория:
    <input type="text" name="newCategoryName" id="newCategoryName" value="">
    <br />

    является подкатегорией для
    <select name="generalCatId">
        <option value="0">Главная категория
            {foreach $rsMainCategories as $item}
        <option value="{$item['id']}">{$item['name']}
            {/foreach}
    </select>
    <br />
    <input type="button" onclick="newCategory();" value="добавить категорию" />

</div>
<hr>
<div id="blockUpdateCategory">
    <table border="1" cellpadding="1" cellspacing="1">
        <tr>
            <th>№</th>
            <th>ID</th>
            <th>Название</th>
            <th>Родительская категория</th>
            <th>Действие</th>
        </tr>
        {foreach $rsCategories as $item name=categories}
            <tr>
                <td>{$smarty.foreach.categories.iteration}</td>

                <td>{$item['id']}</td>
                <td>
                    <input size="30px" type="edit" id="itemName_{$item['id']}" value="{$item['name']}"/>
                </td>
                <td>
                    <select id="parentId_{$item['id']}">
                        <option value="0">Главная категория
                            {foreach $rsMainCategories as $mainItem}
                        <option value="{$mainItem['id']}"
                                {if $item['parent_id'] == $mainItem['id']}selected{/if}>
                            {$mainItem['name']}</option>
                        {/foreach}
                    </select>
                </td>
                <td>
                    <input type="button" value="сохранить" onclick="updateCat({$item['id']});" />
                </td>
            </tr>
        {/foreach}
    </table>
</div>
