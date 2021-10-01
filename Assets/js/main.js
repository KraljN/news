$(document).ready(function () {
    const rootPath = $("#rootPath").val();
    $("#update").on("click", updatePost);
    $(".delete").on("click", deletePost);
    function sendData(method, url, data){
        $.ajax({
            method, 
            url,
            data,
            success: function(response) {
                document.location.reload();
            },
            error: function(error){
                document.location.reload();
            }
        });
    }
    function updatePost(e){
        e.preventDefault();
        let data = fetchData("postDetails");
        sendData("PUT", rootPath + "/admin/posts/update/" + $("#id").val(), data);

    }
    function fetchData(className){
        let data = {};
        $.each($("." + className), function (indexInArray, valueOfElement) { 
            data[$(valueOfElement).attr("id")] = $(valueOfElement).val();
        });
        return data;
    }
    function deletePost(){
        let id =  $(this).data("id");
        let data = {};
        data.id = id;
        sendData("DELETE", rootPath + "/admin/posts/destroy/" + id, data);
    }
});
