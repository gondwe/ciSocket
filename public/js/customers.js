
'use strict';

$(document).ready(function(){
    //checkDocumentVisibility(checkLogin);//check document visibility in order to confirm user's log in status

    //load all items once the page is ready
    lilt();



    //WHEN USE BARCODE SCANNER IS CLICKED
    $("#useBarcodeScanner").click(function(e){
        e.preventDefault();

        $("#itemCode").focus();
    });


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * Toggle the form to add a new item
     */
    $("#createItem").click(function(){
        $("#itemsListDiv").toggleClass("col-sm-8", "col-sm-12");
        $("#createNewItemDiv").toggleClass('hidden');
        $("#itemName").focus();

        //$(".selectedItemDefault").addClass("selectedItem").val("");

        //loop through the currentItems variable to add the items to the select input
		return new Promise((resolve, reject)=>{
			//if an item has been selected (i.e. added to the current transaction), do not add it to the list. This way, an item will appear just once.
			//We start by forming an array of all selected items, then skip that item in the loop appending items to select dropdown
			var selectedGroupsArr = [];
            var selectedPrioritysArr = [];

			return new Promise((res, rej)=>{
				//$(".selectedItem").each(function(){
				//	//push the selected value (which is the item code [a key in currentItems object]) to the array
				//	$(this).val() ? selectedItemsArr.push($(this).val()) : "";
				//});

				res();
			}).then(()=>{
                $(".selectedGroupDefault").empty();
				for(let key in currentRegions){
					//if the current key in the loop is in our 'selectedItemsArr' array
					if(!inArray(key, selectedGroupsArr)){
						//if the item has not been selected, append it to the select list
						$(".selectedGroupDefault").append("<option value='"+key+"'>"+currentRegions[key]+"</option>");
					}
				}

				//prepend 'select item' to the select option
				$(".selectedGroupDefault").prepend("<option value='' selected>Select Region</option>");

                $(".selectedPriorityDefault").empty();
                for(let key in currentPriorities){
					//if the current key in the loop is in our 'selectedItemsArr' array
					if(!inArray(key, selectedPrioritysArr)){
						//if the item has not been selected, append it to the select list
						$(".selectedPriorityDefault").append("<option value='"+key+"'>"+currentPriorities[key]+"</option>");
					}
				}

				//prepend 'select item' to the select option
				$(".selectedPriorityDefault").prepend("<option value='' selected>Select Priority</option>");

				resolve(selectedGroupsArr, selectedPrioritysArr);
			});
		}).then((selectedGroupsArray, selectedPrioritysArray)=>{
				//add select2 to the 'select input'
			    $('.selectedGroupDefault').select2();
                $('.selectedPriorityDefault').select2();
		}).catch(()=>{
			console.log('outer promise err');
		});

        return false;
    });


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    $(".cancelAddItem").click(function(){
        //reset and hide the form
        document.getElementById("addNewItemForm").reset();//reset the form
        $("#createNewItemDiv").addClass('hidden');//hide the form
        $("#itemsListDiv").attr('class', "col-sm-12");//make the table span the whole div
    });


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //execute when 'auto-generate' checkbox is clicked while trying to add a new item
    $("#gen4me").click(function(){
        //if checked, generate a unique item code for user. Else, clear field
        if($("#gen4me").prop("checked")){
            var codeExist = false;

            do{
                //generate random string, reduce the length to 10 and convert to uppercase
                var rand = Math.random().toString(36).slice(2).substring(0, 10).toUpperCase();
                $("#itemCode").val(rand);//paste the code in input
                $("#itemCodeErr").text('');//remove the error message being displayed (if any)

                //check whether code exist for another item
                $.ajax({
                    type: 'get',
                    url: appRoot+"items/gettablecol/id/code/"+rand,
                    success: function(returnedData){
                        codeExist = returnedData.status;//returnedData.status could be either 1 or 0
                    }
                });
            }

            while(codeExist);

        }

        else{
            $("#itemCode").val("");
        }
    });

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //handles the submission of adding new item
    $("#addNewItem").click(function(e){
        e.preventDefault();

        changeInnerHTML(['customerNameErr', 'customerRegionErr', 'priorityErr', 'addCustErrMsg'], "");

        var customerName = $("#customerName").val();
        var customerRegion = $("#customerRegion").val();
        var priority = $("#priority").val();
        var description = $("#description").val();

        if(!customerName || !customerRegion || !priority){
            !customerName ? $("#customerNameErr").text("required") : "";
            !customerRegion ? $("#customerRegionErr").text("required") : "";
            !priority ? $("#priorityErr").text("required") : "";

            $("#addCustErrMsg").text("One or more required fields are empty");

            return;
        }

        displayFlashMsg("Adding Customer '"+customerName+"'", "fa fa-spinner faa-spin animated", '', '');

        $.ajax({
            type: "post",
            url: appRoot+"customers/add",
            data:{customerName:customerName, customerRegion:customerRegion, priority:priority, description:description},

            success: function(returnedData){
                if(returnedData.status === 1){
                    changeFlashMsgContent(returnedData.msg, "text-success", '', 1500);
                    document.getElementById("addNewItemForm").reset();
                    $("#customerRegion").val(customerRegion);
                    $("#priority").val(priority);
                    //refresh the items list table
                    lilt();

                    //return focus to item code input to allow adding item with barcode scanner
                    $("#customerName").focus();
                }

                else{
                    hideFlashMsg();

                    //display all errors
                    $("#customerRegionErr").text(returnedData.customerRegion);
                    $("#customerNameErr").text(returnedData.customerName);
                    $("#priorityErr").text(returnedData.priority);
                    $("#addCustErrMsg").text(returnedData.msg);
                }
            },

            error: function(){
                if(!navigator.onLine){
                    changeFlashMsgContent("You appear to be offline. Please reconnect to the internet and try again", "", "red", "");
                }

                else{
                    changeFlashMsgContent("Unable to process your request at this time. Pls try again later!", "", "red", "");
                }
            }
        });
    });


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //reload items list table when events occur
    $("#itemsListPerPage, #itemsListSortBy").change(function(){
        displayFlashMsg("Please wait...", spinnerClass, "", "");
        lilt();
    });

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $("#itemSearch").keyup(function(){
        var value = $(this).val();
        //console.log("The Priority NAME value: %s", value);
        if(value){
            $.ajax({
                url: appRoot+"search/customerSearch",
                type: "get",
                data: {v:value},
                success: function(returnedData){
                    $("#itemsListTable").html(returnedData.itemsListTable);
                }
            });
        }

        else{
            //reload the table if all text in search box has been cleared
            displayFlashMsg("Loading page...", spinnerClass, "", "");
            lilt();
        }
    });

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //triggers when an item's "edit" icon is clicked
    $("#itemsListTable").on('click', ".editItem", function(e){
        e.preventDefault();

        //get item info
        var itemId = $(this).attr('id').split("-")[1];
        var itemDesc = $("#itemDesc-"+itemId).attr('title');
        var itemName = $("#itemName-"+itemId).html();
        var itemRegion = $("#itemRegion-"+itemId).html();
        var itemPriority = $("#itemPriority-"+itemId).html();

        //prefill form with info
        $("#itemIdEdit").val(itemId);
        $("#itemNameEdit").val(itemName);
        $("#itemDescriptionEdit").val(itemDesc);

        //remove all error messages that might exist
        $("#editItemFMsg").html("");
        $("#itemNameEditErr").html("");

        //launch modal
        $("#editItemModal").modal('show');

        //$(".selectedItemDefault").addClass("selectedItem").val("");

        //loop through the currentItems variable to add the items to the select input
		return new Promise((resolve, reject)=>{
			//if an item has been selected (i.e. added to the current transaction), do not add it to the list. This way, an item will appear just once.
			//We start by forming an array of all selected items, then skip that item in the loop appending items to select dropdown
			var selectedGroupsArr = [];
            var selectedPrioritysArr = [];

			return new Promise((res, rej)=>{
				//$(".selectedItem").each(function(){
				//	//push the selected value (which is the item code [a key in currentItems object]) to the array
				//	$(this).val() ? selectedItemsArr.push($(this).val()) : "";
				//});

				res();
			}).then(()=>{
                $(".selectedGroupDefault").empty();
				for(let key in currentRegions){
					//if the current key in the loop is in our 'selectedItemsArr' array
					if(!inArray(key, selectedGroupsArr)){
						//if the item has not been selected, append it to the select list
                        if (currentRegions[key] == itemRegion) {
                            $(".selectedGroupDefault").append("<option value='"+key+"' selected>"+currentRegions[key]+"</option>");
                        } else {
                            $(".selectedGroupDefault").append("<option value='"+key+"'>"+currentRegions[key]+"</option>");
                        }
					}
				}

				//prepend 'select item' to the select option
				$(".selectedGroupDefault").prepend("<option value=''>Select Region</option>");

                $(".selectedPriorityDefault").empty();
                for(let key in currentPriorities){
					//if the current key in the loop is in our 'selectedItemsArr' array
					if(!inArray(key, selectedPrioritysArr)){
						//if the item has not been selected, append it to the select list
                        if (currentPriorities[key] == itemPriority) {
	                        $(".selectedPriorityDefault").append("<option value='"+key+"' selected>"+currentPriorities[key]+"</option>");
                        } else {
                            $(".selectedPriorityDefault").append("<option value='"+key+"'>"+currentPriorities[key]+"</option>");
                        }
					}
				}

				//prepend 'select item' to the select option
				$(".selectedPriorityDefault").prepend("<option value=''>Select Priority</option>");

				resolve(selectedGroupsArr, selectedPrioritysArr);
			});
		}).then((selectedGroupsArray, selectedPrioritysArray)=>{
				//add select2 to the 'select input'
			    $('.selectedGroupDefault').select2({dropdownAutoWidth : true, width : "100%"});
                $('.selectedPriorityDefault').select2({dropdownAutoWidth : true, width : "100%"});
		}).catch(()=>{
			console.log('outer promise err');
		});

        return false;
    });

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $("#editItemSubmit").click(function(){
        var itemName = $("#itemNameEdit").val();
        var itemRegion = $("#itemRegionEdit").val();
        var itemPriority = $("#itemPriorityEdit").val();
        var itemDesc = $("#itemDescriptionEdit").val();
        var itemId = $("#itemIdEdit").val();

        if(!itemName || !itemId || !itemRegion || !itemPriority){
            !itemName ? $("#itemNameEditErr").html("Customer name cannot be empty") : "";
            !itemRegion ? $("#itemRegionEditErr").html("Customer region cannot be empty") : "";
            !itemPriority ? $("#itemPriorityEditErr").html("Customer priority cannot be empty") : "";
            !itemId ? $("#editItemFMsg").html("Unknown Customer") : "";
            return;
        }

        var itemRegionID = itemRegion;
        var itemPriorityID = itemPriority;

        $("#editItemFMsg").css('color', 'black').html("<i class='"+spinnerClass+"'></i> Processing your request....");

        $.ajax({
            method: "POST",
            url: appRoot+"customers/edit",
            data: {itemName:itemName, itemRegionID:itemRegionID, itemPriorityID:itemPriorityID, itemDesc:itemDesc, _iId:itemId}
        }).done(function(returnedData){
            if(returnedData.status === 1){
                $("#editItemFMsg").css('color', 'green').html("Product successfully updated");

                setTimeout(function(){
                    $("#editItemModal").modal('hide');
                }, 1000);

                lilt();
            }

            else{
                $("#editItemFMsg").css('color', 'red').html("One or more required fields are empty or not properly filled");

                $("#itemNameEditErr").html(returnedData.itemName);
                $("#itemValueEditErr").html(returnedData.itemValue);
            }
        }).fail(function(){
            $("#editItemFMsg").css('color', 'red').html("Unable to process your request at this time. Please check your internet connection and try again");
        });
    });


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //trigers the modal to update stock
    $("#itemsListTable").on('click', '.updateStock', function(){
        //get item info and fill the form with them
        var itemId = $(this).attr('id').split("-")[1];
        var itemName = $("#itemName-"+itemId).html();
        var itemCurQuantity = $("#itemQuantity-"+itemId).html();
        var itemCode = $("#itemCode-"+itemId).html();

        $("#stockUpdateItemId").val(itemId);
        $("#stockUpdateItemName").val(itemName);
        $("#stockUpdateItemCode").val(itemCode);
        $("#stockUpdateItemQInStock").val(itemCurQuantity);

        $("#updateStockModal").modal('show');
    });

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //PREVENT AUTO-SUBMISSION BY THE BARCODE SCANNER
    $("#itemCode").keypress(function(e){
        if(e.which === 13){
            e.preventDefault();

            //change to next input by triggering the tab keyboard
            $("#itemName").focus();
        }
    });



    //TO DELETE AN ITEM (The item will be marked as "deleted" instead of removing it totally from the db)
    $("#itemsListTable").on('click', '.delItem', function(e){
        e.preventDefault();

        //get the item id
        var itemId = $(this).parents('tr').find('.curItemId').val();
        var itemRow = $(this).closest('tr');//to be used in removing the currently deleted row

        if(itemId){
            var confirm = window.confirm("Are you sure you want to delete item? This cannot be undone.");

            if(confirm){
                displayFlashMsg('Please wait...', spinnerClass, 'black');

                $.ajax({
                    url: appRoot+"customers/delete",
                    method: "POST",
                    data: {i:itemId}
                }).done(function(rd){
                    if(rd.status === 1){
                        //remove item from list, update items' SN, display success msg
                        $(itemRow).remove();

                        //update the SN
                        resetItemSN();

                        //display success message
                        changeFlashMsgContent('Item deleted', '', 'green', 1000);
                    }

                    else{

                    }
                }).fail(function(){
                    console.log('Req Failed');
                });
            }
        }
    });
});



/**
 * "lilt" = "load Items List Table"
 * @param {type} url
 * @returns {undefined}
 */
function lilt(url){
    var orderBy = $("#itemsListSortBy").val().split("-")[0];
    var orderFormat = $("#itemsListSortBy").val().split("-")[1];
    var limit = $("#itemsListPerPage").val();


    $.ajax({
        type:'get',
        url: url ? url : appRoot+"customers/lilt/",
        data: {orderBy:orderBy, orderFormat:orderFormat, limit:limit},

        success: function(returnedData){
            hideFlashMsg();
            $("#itemsListTable").html(returnedData.itemsListTable);
        },

        error: function(){

        }
    });

    return false;
}


/**
 * "vittrhist" = "View item's transaction history"
 * @param {type} itemId
 * @returns {Boolean}
 */
function vittrhist(itemId){
    if(itemId){

    }

    return false;
}



function resetItemSN(){
    $(".itemSN").each(function(i){
        $(this).html(parseInt(i)+1);
    });
}
