import {
    deleteImage2
} from '../api';

const setImageDeleteEvent = (element, type) => element.one("click", function() {
    debugger;
    var element = $(this);
    var callback = function (data) {};
    deleteImage2(element, type, callback); //NEW
    $(this).closest(".content-file").find("input[type='file']").attr("data-color", "default");
});

export default setImageDeleteEvent;