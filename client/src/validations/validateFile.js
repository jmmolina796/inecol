const validateFile = (element) => {
    var error = true;
    if (element.val() != "") {
        var txt = element.val();
        var formt = element.data().type.split(",");
        var str, type;

        str = txt.split("\\")[(txt.split("\\").length - 1)];
        type = str.substring((str.lastIndexOf(".") + 1), (str.length));

        for (var x = 0; x < formt.length; x++) {
            if (type.trim().toLowerCase() == formt[x].trim().toLowerCase()) {
                error = false;
                break;
            }
        }
    }
    return error;
};

export default validateFile;