<h2>Добавление Организации</h2>

<h3>Заполнить по ИНН</h3>
<div id="blogGetApiInn">
    <input type="number" id="getApiInn" name="getApiInn" value="">
    <input type="button" value="Найти" onclick="getApiInnData();">
</div>
<br>

<h3>Заполнить данные организации</h3>
<div id="blockNewCompany">
    <table border="1" cellpadding="1" cellspacing="1">
        <tr>
            <th>Название Организации</th>
            <th>ОГРН</th>
            <th>ИНН</th>
            <th>КПП</th>
            <th>Адрес</th>
            <th>ОКПО</th>
            <th>ОКВЕД</th>
        </tr>
        <tr>
            <td>
                <input size="30px" type="text" name="newNameCompany" id="newNameCompany" value=""
                       style="background-color: darkseagreen">
            </td>
            <td>
                <input size="30px" type="number" name="newOgrn" id="newOgrn" value=""
                       style="background-color: pink">
            </td>
            <td>
                <input size="30px" type="number" name="newInn" id="newInn" value=""
                       style="background-color: darkseagreen">
            </td>
            <td>
                <input size="30px" type="number" name="newKpp" id="newKpp" value=""
                       style="background-color: darkseagreen">
            </td>
            <td>
                <input size="30px" type="text" name="newAddress" id="newAddress" value=""
                       style="background-color: darkseagreen">
            </td>
            <td>
                <input size="30px" type="number" name="newOkpo" id="newOkpo" value=""
                       style="background-color: darkseagreen">
            </td>
            <td>
                <input size="30px" type="еуче" name="newOkved" id="newOkved" value=""
                       style="background-color: darkseagreen">
            </td>
            <td>
                <input size="30px" type="button" onclick="newCompany();" value="добавить организацию"/>
            </td>
        </tr>
    </table>
</div>

<br>
<h3>Найденные организации</h3>
{if $rsSessionCompany}
    <div id="blockNewCompanySession">
        <table border="1" cellpadding="1" cellspacing="1">
            <tr>
                <th>Название Организации</th>
                <th>ОГРН</th>
                <th>ИНН</th>
                <th>КПП</th>
                <th>Адрес</th>
                <th>ОКПО</th>
                <th>ОКВЕД</th>
            </tr>
            <tr>
                <td>
                    {$rsSessionCompany['suggestions'][0]['value']}
                </td>
                <td>
                    {$rsSessionCompany['suggestions'][0]['data']['ogrn']}
                </td>
                <td>
                    {$rsSessionCompany['suggestions'][0]['data']['inn']}
                </td>
                <td>
                    {$rsSessionCompany['suggestions'][0]['data']['kpp']}
                </td>
                <td>
                    {$rsSessionCompany['suggestions'][0]['data']['address']['unrestricted_value']}
                </td>
                <td>
                    {$rsSessionCompany['suggestions'][0]['data']['okpo']}
                </td>
                <td>
                    {$rsSessionCompany['suggestions'][0]['data']['okved']}
                </td>
                <td>
                    <input size="30px" type="button" onclick="newCompanySession({$rsSessionCompany['suggestions'][0]['data']['inn']});" value="добавить организацию"/>
                </td>
            </tr>
        </table>
    </div>
{/if}
<br>

{if $rsCompanies}
    <h2>Изменение Организации</h2>
    <div id="blockUpdateCompany">
        <table border="1" cellpadding="1" cellspacing="1">
            <tr>
                <th>№</th>
                <th>ID</th>
                <th>Название Организации</th>
                <th>ОГРН</th>
                <th>ИНН</th>
                <th>КПП</th>
                <th>Адрес</th>
                <th>ОКПО</th>
                <th>ОКВЕД</th>
            </tr>
            {foreach $rsCompanies as $item name=company}
                <tr>
                    <td>
                        {$smarty.foreach.company.iteration}
                    </td>
                    <td>
                        {$item['id']}
                    </td>
                    <td>
                        <input size="30px" type="edit" name="newNameCompany_{$item['id']}" id="newNameCompany_{$item['id']}" value="" required/>
                        {$item['name_company']}
                    </td>
                    <td>
                        <input size="30px" type="edit" name="newOgrn_{$item['id']}" id="newOgrn_{$item['id']}" value="{$item['ogrn']}">
                    </td>
                    <td>
                        <input size="30px" type="edit" name="newInn_{$item['id']}" id="newInn_{$item['id']}" value="{$item['inn']}">
                    </td>
                    <td>
                        <input size="30px" type="edit" name="newKpp_{$item['id']}" id="newKpp_{$item['id']}" value="{$item['kpp']}">
                    </td>
                    <td>
                        <textarea name="newAddress_{$item['id']}" id="newAddress_{$item['id']}" cols="50%" rows="auto">{$item['address']}</textarea>
                    </td>
                    <td>
                        <input size="30px" type="edit" name="newOkpo_{$item['id']}" id="newOkpo_{$item['id']}" value="{$item['okpo']}">
                    </td>
                    <td>
                        <input size="30px" type="edit" name="newOkved_{$item['id']}" id="newOkved_{$item['id']}" value="{$item['okved_type']}">
                    </td>
                    <td>
                        <input type="button" value="Изменить" onclick="updateCompany({$item['id']});"/>
                    </td>
                </tr>
            {/foreach}
        </table>
    </div>
    <hr>
{/if}
