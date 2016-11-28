function deleteQuestion($id)
{
    if (!confirm("Do you want to delete")) {
        return false;
    }
    else {
        data = {'id': $id};
        var params = new Object();
        params.data = data;
        var callback_urgencyAdminJdReport = $.Callbacks();
        callback_urgencyAdminJdReport.add(function takeAction(response)
        {
            if (response['status'] == 1) {
                $("#question-" + response['id']).remove();
            }
        });
        var response = AjaxModule.postRequestReturnResponse('/question/delete', 'POST', params, callback_urgencyAdminJdReport);
        return false;
    }
}
function deleteComment($id)
{
    if (!confirm("Do you want to delete")) {
        return false;
    }
    else {
        data = {'id': $id};
        var params = new Object();
        params.data = data;
        var callback_urgencyAdminJdReport = $.Callbacks();
        callback_urgencyAdminJdReport.add(function takeAction(response)
        {
            if (response['status'] == 1) {
                $("#questionComment-" + response['id']).remove();
            }
        });
        var response = AjaxModule.postRequestReturnResponse('/question/comment/delete', 'POST', params, callback_urgencyAdminJdReport);
        return false;
    }
}
function editComment(id, comment)
{
    var divElem = $(this);
    $("#dialog-form input").val(comment);
    dialog = $("#dialog-form").dialog({
        height: 300,
        width: 350,
        modal: true,
        buttons: {
            "Save": function () {
                dialog.dialog("close");
                editCommentStore(id, $("#dialog-form input").val());
            },
            Cancel: function () {
                dialog.dialog("close");
            }
        }
    });
}

function editCommentStore(id, comment)
{
    data = {'id': id, 'comment': comment};
    var params = new Object();
    params.data = data;
    var callback_urgencyAdminJdReport = $.Callbacks();
    callback_urgencyAdminJdReport.add(function takeAction(response)
    {
        if (response['status'] == 1) {
            $('#questionCommentTile-' + response['id']).text(comment);
        } else {
            alert("Something went Wrong");
        }
    });
    var response = AjaxModule.postRequestReturnResponse('/question/comment/edit', 'POST', params, callback_urgencyAdminJdReport);
    return false;
}
function editQuestion(id)
{
    window.location.replace('/question/edit/' + id);
}

function editLibrary(id)
{
    window.location.replace('/library/edit/' + id);
}


function deleteLibrary($id)
{
    if (!confirm("Do you want to delete")) {
        return false;
    }
    else {
        data = {'id': $id};
        var params = new Object();
        params.data = data;
        var callback_urgencyAdminJdReport = $.Callbacks();
        callback_urgencyAdminJdReport.add(function takeAction(response)
        {
            if (response['status'] == 1) {
                $("#libray-" + response['id']).remove();
                $("#question-" + response['id']).remove();
            }
        });
        var response = AjaxModule.postRequestReturnResponse('/library/delete', 'POST', params, callback_urgencyAdminJdReport);
        return false;
    }
}

function deleteLibraryComment($id)
{
    if (!confirm("Do you want to delete")) {
        return false;
    }
    else {
        data = {'id': $id};
        var params = new Object();
        params.data = data;
        var callback_urgencyAdminJdReport = $.Callbacks();
        callback_urgencyAdminJdReport.add(function takeAction(response)
        {
            if (response['status'] == 1) {
                $("#libraryComment-" + response['id']).remove();
            }
        });
        var response = AjaxModule.postRequestReturnResponse('/library/comment/delete', 'POST', params, callback_urgencyAdminJdReport);
        return false;
    }
}
function editLibraryComment(id, comment)
{
    var divElem = $(this);
    $("#dialog-form input").val(comment);
    dialog = $("#dialog-form").dialog({
        height: 300,
        width: 350,
        modal: true,
        buttons: {
            "Save": function () {
                dialog.dialog("close");
                editLibraryCommentStore(id, $("#dialog-form input").val());
            },
            Cancel: function () {
                dialog.dialog("close");
            }
        }
    });
}
function editLibraryCommentStore(id, comment)
{
    data = {'id': id, 'comment': comment};
    var params = new Object();
    params.data = data;
    var callback_urgencyAdminJdReport = $.Callbacks();
    callback_urgencyAdminJdReport.add(function takeAction(response)
    {
        if (response['status'] == 1) {
            $('#libraryCommentTile-' + response['id']).text(comment);
        } else {
            alert("Something went Wrong");
        }
    });
    var response = AjaxModule.postRequestReturnResponse('/library/comment/edit', 'POST', params, callback_urgencyAdminJdReport);
    return false;
}
function deleteNotice($id)
{
    if (!confirm("Do you want to delete")) {
        return false;
    }
    else {
        data = {'id': $id};
        var params = new Object();
        params.data = data;
        var callback_urgencyAdminJdReport = $.Callbacks();
        callback_urgencyAdminJdReport.add(function takeAction(response)
        {
            if (response['status'] == 1) {
                location.reload();
            }
            else {
                alert("Something went wrong");
            }
        });
        var response = AjaxModule.postRequestReturnResponse('/notice/delete', 'POST', params, callback_urgencyAdminJdReport);
        return false;
    }
}
function getLibrariesPaginator(page)
{
    var data = {};
    var params = new Object();
    params.data = data;
    var callback_listPlan = $.Callbacks();
    callback_listPlan.add(function takeAction(response)
    {
        if (response['status'] == 1)
        {
            $(".tab_2_Content").html(response['data']);
        }
        else if (response['response'] == "error")
        {
            alert("Some thing Went Wrong");
        }
    });
    var response = AjaxModule.postRequestReturnResponse('/user/getLibrariesForHomePage?sort=created_at&page=' + page, 'POST', params, callback_listPlan);

}