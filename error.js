/**
 * Created by CupCakes on 2021/02/28.
 */
$(document).ready(function()
{
    $("#frmCSVImport").on("submit", function ()
    {
        $("#response").attr("class", "");
        $("#response").html("");
        var fileType = ".csv";
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
        if (!regex.test($("#file").val().toLowerCase())) {
            $("#response").addClass("error");
            $("#response").addClass("display-block");
            $("#response").html("Invalid file type or file empty. Upload : <b>" + fileType + "</b> file.");
            return false;
        }
        return true;
    });
});