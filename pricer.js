var computedGlobalPhysics;
var pipesToDelete = [];


function updateGlobalPhysics(){
    var sums = {thingies:{},delete_pipes:[]};    
    $.ajax({
        type: 'GET',
        url: 'get_sums.php',
        dataType: 'json',
        success: function(result){
            for (let i = 0; i < result.length; i++) {
                sums.thingies[result[i][0]] = result[i][1];                               
            }
        }
    }).done(function(){
        sums.delete_pipes = pipesToDelete;
        $.ajax({
            type: 'POST',
            data: sums,
            url: 'get_computed_global_physics.php',
            success: function(result){
                computedGlobalPhysics = result;
                update(false);
            }
        });
    });
}
function update(newPhysics){
    if(newPhysics){
        updateGlobalPhysics();
    }
    else{
        loadDisp();
        loadBars();
        loadExpenses();
        loadDetails();
        loadPipes();
    }
}
function loadDisp(){
    $.ajax({
        type: 'POST',
        data: { "0":computedGlobalPhysics},
        url: 'get_disp.php',
        success: function(result){
            $(".disp .vp").text(result);
        }
    });
}
function loadExpenses(){
    $.ajax({
        type: 'POST',
        dataType: "json",
        data: {"0": computedGlobalPhysics},
        url: 'get_all_expenses.php',
        beforeSend: function(){
            $(".exp-rows").remove();
        },
        success: function (result) {
            var row;
            for (let i = 0; i < result.length; i++) {
                row = $.parseHTML('<tr class = "exp-rows"></tr>');
                for (let key in result[i]){
                    $(row).append($.parseHTML(`<td>${result[i][key]}</td>`));
                }
                $('#exp-table').append(row);
            }
        }
    });
}
function loadBars(){
    $.ajax({
        type: 'POST',
        dataType: 'json',
        data: {"0": computedGlobalPhysics},
        url: 'get_bars.php',
        success: function (result) {
            var node = $("#bars-vp");
            node.empty();
            var maxTemp = Math.max(...result[0]);
            var minTemp = Math.min(...result[0]);
        
            for (let i = 0; i < result.length; i++) {
                node.append($.parseHTML('<div class="bar-group"></div>'));
                for (let j = 0; j < result[i].length; j++) {
                    var lastNodeChild = node.children(":last-child");
                    lastNodeChild.append($.parseHTML('<div class="bar-actual"></div>'));
                    var LNC_lastNodeChild = lastNodeChild.children(":last-child");

                    var barHeight;
                    if (maxTemp == minTemp) barHeight = "50%";
                    else barHeight = ((result[i][j]-minTemp)/(maxTemp-minTemp)*100)+"%";
                    LNC_lastNodeChild.css("height",barHeight);
                }
            }
        }
    });
}
function loadDetails(){
   $.ajax({
        type: 'POST',
        data: {"0": computedGlobalPhysics},
        url: 'get_details.php',
        dataType: 'json',
        success: function(result){
            $("#details-table").empty();
            $("#details-table").append($.parseHTML(result));
        }
    });
}
function loadPipes(){
    $.ajax({
        type: 'POST',
        url: 'get_pipes.php',
        data: { "0":computedGlobalPhysics},
        dataType: 'json',
        success: function(result){
            $("#pipes-table").empty();
            $("#pipes-table").append($.parseHTML(result));
            /*$("#pipes-table tr").hover(function(){
                console.log($(this).children());
                $(this).children().text("törlés");
            });*/
        }
    });
}
function deletePipe(id){
    pipesToDelete.push(id);
    updateGlobalPhysics();
}
function makeTableHeadersForNames(nameResults){
    $('#details-table').empty();
    $('#details-table').append($.parseHTML('<tr id = "first-row"></tr>'));
    
    $("#first-row").append($.parseHTML('<th style="border-right: 2px solid red;"></th>'));
    for (let i = 0; i < nameResults.length; i++) {
        $('#first-row').append($.parseHTML(`<th>${nameResults[i]}</th>`));        
    }
    for (let i = 0; i < nameResults.length; i++) {
        $('#details-table').append($.parseHTML(`<tr><th class="vertical">${nameResults[i]}</th></tr>`));        
    }
}
function insertExpense(){
    $.ajax({
        type: 'POST',
        data: {
            price: $("#price-input").val(),
            desc: $("#desc-input").val(),
            note: $("#note-input").val(),
            whoName: $("#whoname-input").val(),
        },
        url: 'insert_expense.php',
        success: function(result){
            if (result != "fail"){
                $("#submitted").text("bejegyezve!");
                $("#submitted").toggle();
                update(true);
            }
            else{
                $("#submitted").text("valami nem jó...");
                $("#submitted").toggle();
            }
        }
    });
}
function deleteExpenses(){
    if(confirm("Biztos törlöd az összes mutyit?"))
    {
        $.ajax({
            type: 'GET',
            url: 'delete_expenses.php',
            success: function(){
                update(true);
            }
        });
    }
}
$(document).ready(function (){
    function toggles(){
        $("#desc-input").val("");
        $("#note-input").val("");
        $("#price-input").val("");
        $("#whoname-input").val("");

        $("#whoname-input").toggle();
        $("#submitted").toggle();
    }

    $("#whoname-input").keyup(function(e){
        if(e.key == "Enter")
        {
            $(this).toggle();
            $("#price-input").toggle(0,function(){$("#price-input").focus();});
                //setTimeout(function(){$("#price-input").focus();},1000);
        }
    });

    $("#price-input").keyup(function(e){
        if(e.key == "Enter")
        {
            $(this).toggle();
            $("#desc-input").toggle(0,function(){$("#desc-input").focus();});
        }
    });

    $("#desc-input").keyup(function(e){
        if(e.key == "Enter")
        {
            $(this).toggle();
            $("#note-input").toggle(0,function(){$("#note-input").focus();});
        }
    });

    $("#note-input").keyup(function(e){
        if(e.key == "Enter")
        {
            $(this).toggle();
            insertExpense();
        }
    });

    $("#submitted").click(function(){
        toggles();
    });

    $("#o-colors").click(function(){
        $("#o-o-members").hide();
        $(".o-others").show();
        $("#othersHide").text($(this).text());
    });

    $("#o-colors").click(function(){
        $("#o-o-members").hide();
        $(".o-others").show();
        $("#othersHide").text($(this).text());
    });

    $("#o-colors").click(function(){
        $(".others").hide();
        $(".o-others").show();
        $("#othersHide").text($(this).text());
    });

    $(".topbar-shown").mouseleave(function(){
        $("#othersHide").text("egyebek");
        $(".others").show();
        $(".o-others").hide();
    });

    update(true);
});