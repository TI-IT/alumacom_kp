    <h2>Вид товара</h2>
    <div id="blockNewSpecies">
        Новый вид товара:
        <input type="text" name="newSpeciesName" id="newSpeciesName" value="">
        <br />

        является подкатегорией для
        <select name="generalSpeciesId">
            <option value="0">Главная категория
                {foreach $rsMainSpecies as $item}
            <option value="{$item['id']}">{$item['name']}
                {/foreach}
        </select>
        <br />
        <input type="button" onclick="newSpecies();" value="добавить вид товара" />
    </div>

<div id="blockUpdateSpecies">
    <table border="1" cellpadding="1" cellspacing="1">
        <tr>
            <th>№</th>
            <th>ID</th>
            <th>Название</th>
            <th>Родительская категория</th>
            <th>Действие</th>
        </tr>
        {foreach $rsSpecies as $item name=species}
            <tr>
                <td>{$smarty.foreach.species.iteration}</td>

                <td>{$item['id']}</td>
                <td>
                    <input size="30px" type="edit" id="itemNameSpe_{$item['id']}" value="{$item['name']}" />
                </td>
                <td>
                    <select id="parentIdSpe_{$item['id']}">
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
    </table>
</div>
    <hr>

