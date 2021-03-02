import velocity from 'velocity-animate';
import 'velocity-ui-pack';

export const openMessage = (backgroundColor, textColor, message) => {
    $(".message-alert .bodyMessage").css({
        "background-color": backgroundColor,
        "color": textColor
    });
    $(".message-alert .content").empty().prepend(message);
    $(".message-alert").show();
    const $el = $(".message-alert .bodyMessage");
    velocity($el, "transition.expandIn");
};

export const closeMessage = () => {
    $(".message-alert").hide();
    const $el = $(".message-alert .bodyMessage")
    velocity($el, "transition.expandOut", 1);
};