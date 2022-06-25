<h2>клиенты</h2>
<div id="blockNewClient">
    Новый Клиент:
    <input type="text" name="newClientName" id="newClientName" value="">
    <br />

    является подкатегорией для
    <select name="generalSpeciesId">
        <option value="0">Клиент
            {foreach $rsMainClients as $item}
        <option value="{$item['id']}">{$item['name']}
            {/foreach}
    </select>
    <br />
    <input type="button" onclick="newClient();" value="добавить вид товара" />
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
        {foreach $rsClients as $item name=species}
            <tr>
                <td>{$smarty.foreach.species.iteration}</td>

                <td>{$item['id']}</td>
                <td>
                    <input size="30px" type="edit" id="itemNameClient_{$item['id']}" value="{$item['name']}" />
                </td>
                <td>
                    <select id="parentClientId_{$item['id']}">
                        <option value="0">Клиент
                            {foreach $rsMainClients as $mainItem}
                        <option value="{$mainItem['id']}"
                                {if $item['parent_id'] == $mainItem['id']}selected{/if}>
                            {$mainItem['name']}</option>
                        {/foreach}
                    </select>
                </td>
                <td>
                    <input type="button" value="сохранить" onclick="updateClient({$item['id']});" />
                </td>
            </tr>

        {/foreach}
    </table>
</div>
<hr>


