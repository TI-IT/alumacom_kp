<h2>Вид товара</h2>
<table border="1" cellpadding="1" cellspacing="1">
    <tr>
        <th>№</th>
        <th>ID</th>
        <th>Название</th>
        <th>Родительская категория</th>
        <th>Действие</th>
    </tr>
    {foreach $rsSpecies as $item name=categories}
        <tr>
            <td>{$smarty.foreach.categories.iteration}</td>

            <td>{$item['id']}</td>
            <td>
                <input type="edit" id="itemName_{$item['id']}" value="{$item['name']}" />
            </td>
            <td>
                <select id="parentId_{$item['id']}">
                    <option value="0">Главная категория
                        {foreach $rsMainSpecies as $mainItem}
                    <option value="{$mainItem['id']}"
                            {if $item['parent_id'] == $mainItem['id']}selected{/if}>
                        {$mainItem['name']}</option>
                    {/foreach}
                </select>
            </td>
            <td>
                <input type="button" value="сохранить" onclick="updateSpecies({$item['id']});" />
            </td>
        </tr>

    {/foreach}
