import {
    deleteImage
} from '../api';

const deleteImage2 = (element, type, callback) => {
    debugger;
    var link = element.parent().find("img").attr("src");
    var content = element.closest(".fl");
    element.parent().find("img").attr("src", "#");
    content.removeClass("fl-loaded");
    content.find("input[type='text']").val("No seleccionado");
    deleteImage(link, type, callback);
};

export default deleteImage2;