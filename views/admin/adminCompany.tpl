<h2>Добавление Организации</h2>

<h3>Заполнить по ИНН</h3>
<div id="blogGetApiInn">
    <input type="number" id="getApiInn" name="getApiInn" value="">
    <input type="button" value="Найти" onclick="getApiInnData();">
</div>
<br>

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
                <input size="30px" type="number" name="newOkved" id="newOkved" value=""
                       style="background-color: darkseagreen">
            </td>
            <td>
                <input size="30px" type="button" onclick="newCompany();" value="добавить организацию"/>
            </td>
        </tr>
    </table>
</div>

<br>
<h3>Найдено</h3>
{if $rstest}
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
<h2>Изменение Организации</h2>
<div id="blockUpdatePersons">
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
        {foreach $rsPersons as $item name=persons}
            <tr>
                <td>
                    {$smarty.foreach.persons.iteration}
                </td>
                <td>
                    {$item['id']}
                </td>
                <td>
                    <input size="30px" type="edit" id="itemSurname_{$item['id']}" value="{$item['surname']}"/>
                </td>
                <td>
                    <input size="30px" type="edit" id="itemName_{$item['id']}" value="{$item['name']}"/>
                </td>
                <td>
                    <input size="30px" type="edit" id="itemPatronymic_{$item['id']}" value="{$item['patronymic']}"/>
                </td>
                <td>
                    {foreach $rsPhone as $itemPhone}
                        <div>
                            {if $item['id'] == $itemPhone['person_id']}
                                {$itemPhone['phone']}
                            {/if}
                        </div>
                    {/foreach}
                </td>
                <td>
                    <input size="30px" type="edit" id="itemDate_of_birth_{$item['id']}"
                           value="{$item['date_of_birth']}"/>
                </td>
                <td>
                    <input size="30px" type="edit" id="itemPassport_number_{$item['id']}"
                           value="{$item['passport_number']}"/>
                </td>
                <td>
                    <input size="30px" type="edit" id="itemResidential_address_{$item['id']}"
                           value="{$item['residential_address']}"/>
                </td>
                <td>
                    <input type="button" value="сохранить" onclick="updatePersons({$item['id']});"/>
                </td>
            </tr>
        {/foreach}
    </table>
</div>
<hr>