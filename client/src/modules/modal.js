import {
    closeModal
} from '../shared/modal';

$(window).on("keydown", (e) => {
    if (e.keyCode == 27) {
        closeModal();
        $(window).off("keydown");
        e.preventDefault(); //Safari
    }
});

$(".window-modal").on("click",".cancelarModal, .helpMessage",function(){
    $("#loader-content").hide();
    if($(this).hasClass("helpMessage"))
    {
        closeModal("help");
    }
    else
    {
        closeModal();
    }
});

$(".window-modal").on("click",function(e){
    if (e.target !== this)
    {
        return;
    }
    closeModal();
});

$(".window-modal").on("click",".close-modal-prev, .previewMul .ytb",function(e){
    if (e.target !== this)
    {
        return;
    }
    closeModal();
});

$("#loader-modal").on("click",function(e){
    if (e.target !== this)
    {
        return;
    }
    closeModal();
});