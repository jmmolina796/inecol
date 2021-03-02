export const contentDisabled = () => $("#webContent").addClass("disabled");

export const contentEnabled = () => $("#webContent").removeClass("disabled");

export const loadingSection = (element) => element.show();

export const loadedSection = (element) => element.hide();

export const loadingContent = () => {
    $("#loader-content").show();
    $("#webContent>").hide();
};

export const loadedContent = () => {
    $("#loader-content").hide();
    $("#webContent>").show();
};

export const loadingPage = () => {
    $('#loader-principal').addClass("color").show();
    $("body").css("overflow", "hidden");
};

export const loadedPage = () => {
    $('#loader-principal').hide().removeClass("color");
    $("body").css("overflow", "auto");
};