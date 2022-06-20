/**
 * получение данных с формы
 */
function getData(obj_form){
    var hData = {};
    $('input, textarea, select', obj_form).each(function(){
        if(this.name && this.name !=''){
            hData[this.name] = this.value;
            console.log('hData[' + this.name + '] = ' + hData[this.name]);
        }
    });
    console.log(hData);
    return hData;
};

/**\
 * добавление новой категории
 */
function newCategory(){
    var postData = getData('#blockNewCategory');

    $.ajax({
        type: "POST",
        async: false,
        url: "/admin/addnewcat/",
        data: postData,
        dataType: "json",
        success: function(data){
            if(data['success']){
                alert(data['message']);
                $('#newCategoryName').val('');
            }else{
                alert(data['message']);
            }
        }
    })
}

function updateCat(itemId){
    var parentId = $('#parentId_' + itemId).val();
    var newName = $('#itemName_' + itemId).val();
    var postData = {
        itemId,
        parentId,
        newName
    };
    console.log(postData);

    $.ajax({
        type: 'POST',
        async: false,
        url: "/admin/updatecategory/",
        data: postData,
        dataType: 'json',
        success: function (data){
            alert(data['message']);
        }
    })
}

function addProduct(){
    var itemName = $('#newItemName').val();
    var itemPrice = $('#newItemPrice').val();
    var itemCatId = $('#newItemCatId').val();
    var itemDesc = $('#newItemDesc').val();

    var postData = {
        itemName,
        itemPrice,
        itemCatId,
        itemDesc
    };

    $.ajax({
        type: 'POST',
        async: false,
        url: "/admin/addproduct/",
        data: postData,
        dataType: 'json',
        success: function (data){
            alert(data['message']);
            if(data['success']){
                $('#newItemName').val('');
                $('#newItemPrice').val('');
                $('#newItemCatId').val('');
                $('#newItemDesc').val('');
            }
        }
    })
}